"""Local SEO regression checks. Python standard library + PHP CLI only.
python -B xtras/verificar-seo.py http://localhost/arquitectos/site [before.json]
"""
import collections
import hashlib
import json
import re
import subprocess
import sys
from html.parser import HTMLParser
from pathlib import Path
from urllib.error import HTTPError
from urllib.parse import urljoin, urlsplit, unquote
from urllib.request import HTTPRedirectHandler, Request, build_opener
import xml.etree.ElementTree as ET

ROOT = Path(__file__).resolve().parents[1]
BASE = sys.argv[1].rstrip('/') if len(sys.argv) > 1 else 'http://localhost/arquitectos/site'
PHP = 'C:/xampp/php/php.exe'

def php(code):
    return subprocess.check_output([PHP, '-r', code], cwd=ROOT).decode('utf-8')

export = php("$config=require 'config.php'; $catalog=require 'datos/servicios.php'; $routing=require 'rutas.php'; echo json_encode(compact('config','catalog','routing'));")
data = json.loads(export)
config, catalog, routing = data['config'], data['catalog'], data['routing']
origin = config['canonical_origin'] + config['canonical_base']
business_id = origin + '/#negocio'

class NoRedirect(HTTPRedirectHandler):
    def redirect_request(self, *args):
        return None

opener = build_opener(NoRedirect)

def get(path, method='GET', headers=None):
    try:
        response = opener.open(Request(BASE + path, method=method, headers=headers or {}), timeout=10)
    except HTTPError as error:
        response = error
    with response:
        return response.status, response.headers, response.read()

class Page(HTMLParser):
    def __init__(self, text):
        super().__init__()
        self.blocks, self.refs, self.ids = [], [], set()
        self.current = None
        self.canonical = None
        self.feed(text)

    def handle_starttag(self, tag, attrs):
        attrs = dict(attrs)
        if tag == 'script' and attrs.get('type') == 'application/ld+json': self.current = ''
        if tag == 'link' and attrs.get('rel') == 'canonical': self.canonical = attrs['href']
        if attrs.get('id'): self.ids.add(attrs['id'])
        for key in ('href', 'src'):
            if attrs.get(key): self.refs.append(attrs[key])

    def handle_data(self, text):
        if self.current is not None: self.current += text

    def handle_endtag(self, tag):
        if tag == 'script' and self.current is not None:
            self.blocks.append(json.loads(self.current))
            self.current = None

pages, counts, business_nodes, service_ids = {}, collections.Counter(), [], set()
for path, route in routing['routes'].items():
    status, headers, raw = get(path)
    assert status == 200, (path, status)
    html = raw.decode('utf-8')
    assert not re.search(r'(?:Warning|Notice|Fatal error|Parse error)</b>', html), path
    page = Page(html)
    assert page.canonical == origin + path
    assert len(page.blocks) == 1, path
    graph = page.blocks[0]
    assert graph['@context'] == 'https://schema.org'
    nodes = {n['@type']: n for n in graph['@graph']}
    expected = {'inicio': {'LocalBusiness', 'WebSite'}, 'contacto': {'LocalBusiness', 'BreadcrumbList'},
                'servicios': {'BreadcrumbList'}, 'trabajos': {'BreadcrumbList'}, 'servicio': {'Service', 'BreadcrumbList'}}[route['view']]
    assert set(nodes) == expected and len(nodes) == len(graph['@graph']), path
    counts.update(nodes.keys())
    for node in nodes.values():
        assert node['@id'].startswith(origin + '/')
        assert not any(k in node for k in ('geo', 'openingHours', 'openingHoursSpecification', 'aggregateRating', 'review', 'priceRange', 'sameAs', 'potentialAction'))
    if 'LocalBusiness' in nodes:
        node = nodes['LocalBusiness']; address = config['address_parts']
        assert node['@id'] == business_id and node['url'] == origin + '/'
        assert node['name'] == config['business_name']
        assert node['telephone'] == config['phone_href'] and node['email'] == config['email']
        assert node['logo'] == origin + config['logo_path'] and node['image'] == origin + config['social_image_path']
        assert node['address'] == {'@type':'PostalAddress', 'streetAddress':address['street']+', '+address['district'],
                                 'addressLocality':address['municipality'], 'addressRegion':address['state'], 'addressCountry':address['country']}
        assert config['address'] in html and config['locality'] in html
        business_nodes.append(node)
    if 'WebSite' in nodes:
        node = nodes['WebSite']
        assert node['url'] == origin + '/' and node['publisher'] == {'@id':business_id}
        assert node['name'] == config['business_name']
    if 'Service' in nodes:
        node = nodes['Service']; service = catalog['services'][route['slug']]
        assert node['name'] == service['heading'] and service['heading'] in html
        assert node['description'] == service['description']
        assert node['url'] == origin + service['path'] == page.canonical
        assert node['provider'] == {'@id':business_id} and node['areaServed'] == 'Querétaro'
        service_ids.add(node['@id'])
    if 'BreadcrumbList' in nodes:
        items = nodes['BreadcrumbList']['itemListElement']
        expected_paths = ['/', '/servicios', path] if route['view'] == 'servicio' else ['/', path]
        assert [n['item'] for n in items] == [origin + p for p in expected_paths]
        assert [n['position'] for n in items] == list(range(1, len(items)+1))
        assert all(n['@type'] == 'ListItem' and n['name'] and '#' not in n['item'] for n in items)
        assert items[0]['name'] == 'Inicio'
        if route['view'] == 'servicio': assert items[-1]['name'] == service['name']
    # Host spoofing must not affect the markup or any output.
    assert get(path, headers={'Host':'untrusted.invalid'})[2] == raw, path
    pages[path] = (page, html)

assert counts == {'LocalBusiness':2, 'WebSite':1, 'Service':19, 'BreadcrumbList':22}, counts
assert len(service_ids) == 19 and business_nodes[0] == business_nodes[1]

checked = set()
for path, (page, _) in pages.items():
    for ref in page.refs:
        parts = urlsplit(urljoin(BASE + path, ref))
        if parts.netloc != urlsplit(BASE).netloc: continue
        local = parts.path.removeprefix(urlsplit(BASE).path)
        if local not in checked:
            assert get(local)[0] == 200, (path, ref)
            checked.add(local)
        if parts.fragment and local in pages:
            assert unquote(parts.fragment) in pages[local][0].ids, (path, ref)

for old, new in routing['legacy'].items():
    for suffix in ('', '?utm_source=seo'):
        status, headers, _ = get(old + suffix)
        assert status == 301 and headers['Location'] == urlsplit(BASE).path + new + suffix, old
for path in ('/no-existe', '/servicios/no-existe', '/assets/inexistente.png'):
    status, _, body = get(path)
    assert status == 404 and not Page(body.decode('utf-8')).blocks, path

status, headers, robots = get('/robots.txt')
assert status == 200 and headers.get_content_type() == 'text/plain'
assert robots == (ROOT / 'robots.txt').read_bytes()
assert 'X-Powered-By' not in headers, 'robots.txt must not be served by PHP'
assert b'Sitemap: https://arquitectostrabajando.com.mx/sitemap.xml' in robots
assert not re.search(rb'^Disallow:', robots, re.M)
assert get('/robots.txt', method='HEAD')[0] == 200
status, headers, xml = get('/sitemap.xml')
assert status == 200 and headers.get_content_type() == 'application/xml'
locs = [n.text for n in ET.fromstring(xml).findall('{*}url/{*}loc')]
assert len(locs) == len(set(locs)) == 23 and set(locs) == {origin+p for p in routing['routes']}

# Simulate an editorial string capable of closing a script: decoded JSON must
# retain it, but the generated HTML must contain exactly one inert script block.
probe = php("$config=require 'config.php'; $catalog=require 'datos/servicios.php'; require 'includes.php'; "
            "$config['business_name']='</script><script>alert(1)</script> & '.chr(34).chr(39); "
            "http_response_code(200); render_structured_data(['view'=>'inicio','path'=>'/']);")
assert probe.count('<script') == 1 and probe.count('</script>') == 1 and '\\u003C' in probe
assert Page(probe).blocks[0]['@graph'][0]['name'].startswith('</script><script>')

if len(sys.argv) > 2:
    before = json.loads(Path(sys.argv[2]).read_text(encoding='utf-8'))
    for path, (_, html) in pages.items():
        stripped = re.sub(r'<script type="application/ld\+json">.*?</script>\s*', '', html, flags=re.S)
        assert ' '.join(stripped.split()) == ' '.join(before['html'][path].split()), path
    assert xml.decode('utf-8') == before['sitemap']
    for name, digest in before['hashes'].items():
        if name in ('config.php', 'includes.php', '.htaccess'): continue
        assert hashlib.sha256((ROOT / name).read_bytes()).hexdigest() == digest, name
    print('OK: previous HTML unchanged except JSON-LD; sitemap and out-of-scope source files unchanged.')
print('OK: 23 pages; LocalBusiness 2, WebSite 1, Service 19, BreadcrumbList 22; schema fields, canonical URLs, navigation, 46 redirects, robots, sitemap, 404, Host independence and JSON escaping.')
