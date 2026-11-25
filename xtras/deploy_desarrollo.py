"""FTPS deployment restricted to the development subdomain; never uploads xtras."""
import ftplib
import hashlib
import io
import json
import re
import ssl
import uuid
import zipfile
from pathlib import Path, PurePosixPath
from urllib.request import urlopen
from manifiesto_despliegue import build_payload

ROOT = Path(__file__).resolve().parents[1]
TARGET = '/domains/desarrollo.arquitectostrabajando.com.mx/public_html'
TOKEN = uuid.uuid4().hex[:12]

def digest(data):
    return hashlib.sha256(data).hexdigest()

def remote(name):
    path = PurePosixPath(TARGET) / name
    assert str(path).startswith(TARGET + '/') and '..' not in path.parts
    return str(path)

def connect():
    access = Path('C:/xampp/htdocs/arquitectos/xtras/ftp_access.txt').read_text(encoding='utf-8-sig')
    credentials = dict(re.split(r'\s*[:=]\s*', line.strip(), maxsplit=1) for line in access.splitlines() if line.strip())
    ftp = ftplib.FTP_TLS(context=ssl.create_default_context(), timeout=30)
    ftp.connect('ftp.arquitectostrabajando.com.mx', 21)
    ftp.login(credentials['user'], credentials['password'])
    ftp.prot_p()
    return ftp

def retrieve(ftp, path):
    out = io.BytesIO()
    ftp.retrbinary('RETR ' + path, out.write)
    return out.getvalue()

def run():
    payload = build_payload(development=True)
    names = list(payload)
    assert all(not n.startswith('xtras/') and 'servicios-20261125' not in n for n in names)
    with urlopen('https://arquitectostrabajando.com.mx/', timeout=20) as response:
        production_before = digest(response.read())
    folder = ROOT / 'xtras/backups' / ('despliegue-desarrollo-' + TOKEN)
    folder.mkdir(parents=True)
    ftp = connect()
    previous, staged, committed = {}, {}, []
    try:
        ftp.cwd(TARGET)
        assert ftp.pwd().rstrip('/') == TARGET
        entries = dict(ftp.mlsd(TARGET))
        assert entries.get('despliegue', {}).get('type') == 'dir', 'Missing protected deployment directory'
        protection_entries = dict(ftp.mlsd(remote('despliegue')))
        assert protection_entries.get('.htaccess', {}).get('type') == 'file', 'Missing Basic protection'
        protection = retrieve(ftp, remote('despliegue/.htaccess'))
        assert re.search(rb'^\s*AuthType\s+Basic\s*$', protection, re.I | re.M), 'Basic protection required'
        assert re.search(rb'^\s*Require\s+(?:valid-user|user|group)\b', protection, re.I | re.M), 'Authenticated users required'
        for parent, children in [(TARGET, ('assets', 'datos', 'vistas')), (remote('assets'), ('img',))]:
            entries = dict(ftp.mlsd(parent))
            assert all(entries[name]['type'] == 'dir' for name in children), 'Refusing a symlink destination'
        # Prove this FTP directory serves the explicitly authorized subdomain.
        logo = retrieve(ftp, remote('assets/logo-at.png'))
        with urlopen('https://desarrollo.arquitectostrabajando.com.mx/assets/logo-at.png', timeout=20) as response:
            assert response.read() == logo
        for n in names:
            parent, filename = str(PurePosixPath(n).parent), PurePosixPath(n).name
            entries = dict(ftp.mlsd(TARGET if parent == '.' else remote(parent)))
            if filename in entries:
                assert entries[filename]['type'] == 'file', 'Refusing to replace a directory or symlink'
                previous[n] = retrieve(ftp, remote(n))
            else:
                previous[n] = None
        backup = folder / 'remoto-anterior.zip'
        with zipfile.ZipFile(backup, 'w', zipfile.ZIP_DEFLATED) as archive:
            for n, body in previous.items():
                if body is not None: archive.writestr(n, body)
            archive.writestr('manifest.json', json.dumps({'target':TARGET, 'new_files':[n for n,v in previous.items() if v is None]}, indent=2))
        with zipfile.ZipFile(backup) as archive:
            assert archive.testzip() is None
            for n, body in previous.items():
                if body is not None: assert archive.read(n) == body
        print('Verified remote backup:', backup, flush=True)
        for i, (n, body) in enumerate(payload.items(), 1):
            p = PurePosixPath(n)
            temp = str(p.with_name('.deploy-' + TOKEN + '-' + p.name))
            staged[n] = temp
            ftp.storbinary('STOR ' + remote(temp), io.BytesIO(body))
            assert digest(retrieve(ftp, remote(temp))) == digest(body)
            if i % 10 == 0: print('Staged and verified:', i, '/', len(names), flush=True)
        for n in names:
            ftp.rename(remote(staged[n]), remote(n))
            committed.append(n)
        for n, body in payload.items():
            assert digest(retrieve(ftp, remote(n))) == digest(body)
        assert retrieve(ftp, remote('despliegue/.htaccess')) == protection, 'Basic protection changed'
        with urlopen('https://arquitectostrabajando.com.mx/', timeout=20) as response:
            production_after = digest(response.read())
        receipt = {'target':TARGET, 'files':{n:digest(v) for n,v in payload.items()},
                   'production_home_before':production_before, 'production_home_after':production_after,
                   'production_home_unchanged':production_before == production_after,
                   'remote_backup':str(backup), 'development_noindex':True,
                   'basic_protection_unchanged':True}
        (folder / 'resultado.json').write_text(json.dumps(receipt, indent=2), encoding='utf-8')
        print('DEPLOYED', len(names), 'files. Production homepage unchanged:', production_before == production_after, flush=True)
        print('Receipt:', folder / 'resultado.json', flush=True)
    except Exception:
        print('Deployment interrupted; restoring committed development files.', flush=True)
        for n in reversed(committed):
            if previous[n] is None:
                ftp.delete(remote(n))
            else:
                ftp.storbinary('STOR ' + remote(n), io.BytesIO(previous[n]))
        raise
    finally:
        for n, temp in staged.items():
            if n not in committed:
                try: ftp.delete(remote(temp))
                except ftplib.error_perm: pass
        ftp.quit()

if __name__ == '__main__':
    try:
        run()
    except Exception as error:
        print('Deployment failed:', type(error).__name__)
        raise SystemExit(1)
