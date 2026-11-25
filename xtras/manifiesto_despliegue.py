"""Build the runtime payload and its size manifest without connecting to a server."""
import argparse
import json
from datetime import datetime, timezone
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
MANIFEST = 'datos/despliegue-manifiesto.json'
DEVELOPMENT_HEADERS = b'\n# Development copy only: keep out of search results.\n<IfModule mod_headers.c>\nHeader always set X-Robots-Tag "noindex"\n</IfModule>\n'


def build_payload(development=False):
    names = ['config.php', 'includes.php', 'rutas.php', 'sitemap.php', 'robots.txt',
             'favicon.ico', 'datos/servicios.php', 'datos/verificar-despliegue.php',
             'despliegue/index.php', 'index.php', '.htaccess']
    names += [p.relative_to(ROOT).as_posix() for p in sorted((ROOT / 'assets').rglob('*')) if p.is_file()]
    names += [p.relative_to(ROOT).as_posix() for p in sorted((ROOT / 'vistas').glob('*.php'))]
    payload = {name: (ROOT / name).read_bytes() for name in names}
    if development:
        payload['.htaccess'] += DEVELOPMENT_HEADERS
    manifest = {
        'version': 1,
        'generated_at': datetime.now(timezone.utc).isoformat(),
        'environment': 'desarrollo' if development else 'local',
        'files': {name: len(body) for name, body in sorted(payload.items())},
    }
    payload[MANIFEST] = (json.dumps(manifest, ensure_ascii=False, indent=2) + '\n').encode('utf-8')
    return payload


if __name__ == '__main__':
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument('--desarrollo', action='store_true')
    args = parser.parse_args()
    payload = build_payload(args.desarrollo)
    (ROOT / MANIFEST).write_bytes(payload[MANIFEST])
    print(f'Manifiesto generado: {len(payload) - 1} archivos; {MANIFEST}')
