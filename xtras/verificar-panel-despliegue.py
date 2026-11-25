"""Local panel checks; no FTP connection or remote mutations."""
import json
import shutil
import subprocess
import tempfile
from pathlib import Path
from urllib.error import HTTPError
from urllib.request import urlopen

from manifiesto_despliegue import ROOT, MANIFEST, build_payload

PHP = 'C:/xampp/php/php.exe'
CHECKER = ROOT / 'datos/verificar-despliegue.php'
PANEL = ROOT / 'despliegue/index.php'


def php(code, *args):
    # Reproduce the remote runtime lacking PHP 8 string helpers.
    return subprocess.run([PHP, '-d', 'disable_functions=str_starts_with,str_ends_with,str_contains',
                           '-r', code, *map(str, args)], check=True, capture_output=True, text=True, encoding='utf-8').stdout


with tempfile.TemporaryDirectory(prefix='panel-test-') as folder:
    fixture = Path(folder)
    (fixture / 'ok.txt').write_bytes(b'abc')
    (fixture / 'different.txt').write_bytes(b'abcd')
    (fixture / 'not-a-file').mkdir()
    manifest = {'version': 1, 'environment': 'test', 'generated_at': '2026-11-25',
                'files': {'ok.txt': 3, 'different.txt': 3, 'z-missing.txt': 3,
                          'not-a-file': 0, 'a-missing.txt': 3}}
    manifest_path = fixture / 'manifest.json'
    code = 'require $argv[1]; try { echo json_encode(verificar_despliegue($argv[2], $argv[3])); } catch (RuntimeException $e) { echo "INVALID"; }'
    manifest_path.write_text(json.dumps(manifest))
    report = json.loads(php(code, CHECKER, fixture, manifest_path))
    assert [r['file'] for r in report['rows']] == ['a-missing.txt', 'z-missing.txt', 'different.txt', 'not-a-file', 'ok.txt']
    assert [r['status'] for r in report['rows']] == ['Faltante', 'Faltante', 'Tamaño diferente', 'No verificable', 'Correcto']
    assert [(r['expected'], r['actual']) for r in report['rows']] == [(3, None), (3, None), (3, 4), (0, None), (3, 3)]
    # Render the real panel against an isolated installation, never change site files.
    (fixture / 'despliegue').mkdir()
    (fixture / 'datos').mkdir()
    shutil.copy2(PANEL, fixture / 'despliegue/index.php')
    shutil.copy2(CHECKER, fixture / 'datos/verificar-despliegue.php')
    shutil.copy2(manifest_path, fixture / 'datos/despliegue-manifiesto.json')
    html = php("$_SERVER['REMOTE_ADDR']='127.0.0.1'; require $argv[1];", fixture / 'despliegue/index.php')
    positions = [html.index('<td>' + row['file'] + '</td>') for row in report['rows']]
    assert positions == sorted(positions)
    for label, count in [('Faltante', 2), ('Tamaño diferente', 1), ('No verificable', 1), ('Correcto', 1)]:
        assert f'<strong>{count}</strong>{label}' in html
    assert 'Se detectaron diferencias.' in html
    for contents in ['{', '{}', json.dumps(dict(manifest, files={'../outside': 0})), json.dumps(dict(manifest, files={'ok.txt': -1}))]:
        manifest_path.write_text(contents)
        assert php(code, CHECKER, fixture, manifest_path) == 'INVALID'
    manifest_path.unlink()
    assert php(code, CHECKER, fixture, manifest_path) == 'INVALID'

# Exercise authentication branches without setting real server credentials.
auth_code = '''
$_SERVER['REMOTE_ADDR']='203.0.113.2';
$_SERVER['HTTP_HOST']='localhost';
$_SERVER['HTTP_X_FORWARDED_FOR']='127.0.0.1';
$_SERVER['HTTPS']=$argv[2];
$_SERVER['PHP_AUTH_USER']='forged-client-user';
$_SERVER['HTTP_REMOTE_USER']='forged-client-user';
if ($argv[3] === 'authenticated') $_SERVER['REMOTE_USER']='hosting-user';
if ($argv[3] === 'redirected') $_SERVER['REDIRECT_REMOTE_USER']='hosting-user';
register_shutdown_function(function(){fwrite(STDOUT, "\\nSTATUS:".(http_response_code() ?: 200));});
require $argv[1];
'''
for https, password, expected in [('off', 'authenticated', 403), ('on', 'unset', 403), ('on', 'authenticated', 200), ('on', 'redirected', 200)]:
    output = php(auth_code, PANEL, https, password)
    assert output.rstrip().endswith(f'STATUS:{expected}'), output

for development in [False, True]:
    payload = build_payload(development)
    manifest = json.loads(payload[MANIFEST])
    assert all(len(payload[name]) == size for name, size in manifest['files'].items())
    assert not any(name.startswith('xtras/') or 'servicios-20261125' in name for name in payload)
    assert 'despliegue/index.php' in payload

base = 'http://localhost/arquitectos/site/'
with urlopen(base + 'despliegue/') as response:
    body = response.read().decode()
    assert response.status == 200
    assert 'noindex' in response.headers['X-Robots-Tag']
    assert response.headers['Cache-Control'] == 'no-store'
    assert 'Todos los archivos del manifiesto están presentes' in body
for route in ['datos/despliegue-manifiesto.json', 'datos/verificar-despliegue.php', 'xtras/manifiesto_despliegue.py']:
    try:
        urlopen(base + route)
        raise AssertionError(f'Public internal file: {route}')
    except HTTPError as error:
        assert error.code == 403
print('OK: panel HTTP, sizes, missing files, malformed/missing manifests, traversal rejection, remote authentication, private files, local/development payloads.')
