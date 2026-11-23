#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Arquitectos Trabajando C+S Estudio · Rediseño 2026
Generador del sitio: escribe las páginas HTML a partir del contenido del sitio
actual (textos de servicios-info.php y páginas publicadas) y de la plantilla
compartida. Ejecutar:  python build_site.py
"""

from pathlib import Path

OUT = Path(__file__).parent
BASE = "https://arquitectostrabajando.com.mx/"
EMAIL = "arquitectos_trabajando@yahoo.com.mx"
TEL = "442 239 5018"
TEL_HREF = "+524422395018"
ADDRESS_1 = "Paseo de Ankara No. 273"
ADDRESS_2 = "Col. Tejeda, Corregidora, Querétaro, México"
MAPS = ("https://www.google.com/maps/search/?api=1&query="
        "Paseo+de+Ankara+273+Tejeda+Corregidora+Queretaro")

MAIL_SUBJECT = "Solicitud%20de%20informaci%C3%B3n"

NAV = [
    ("inicio", "Inicio", "index.php"),
    ("servicios", "Servicios", "5_Servicios-Arquitectonicos-Queretaro.html"),
    ("trabajos", "Trabajos", "3_Trabajos-Arquitectonicos.html"),
    ("contacto", "Contacto", "4_Arquitectos-en-Queretaro.html"),
]

# --------------------------------------------------------------------------
# Contenido: categorías y servicios (textos del sitio actual)
# --------------------------------------------------------------------------
CATEGORIES = [
    {
        "key": "perito",
        "num": "01",
        "name": "DRO / PERITO",
        "desc": "Responsiva, dictámenes y valuación",
        "img": "assets/img/cat-perito.jpg",
        "alt": "Fachada de bodega industrial construida por el estudio",
        "services": ["dro", "dictamen", "corresponsable", "valuacion"],
    },
    {
        "key": "proyecto",
        "num": "02",
        "name": "Proyecto arquitectónico",
        "desc": "Diseño y proyecto ejecutivo",
        "img": "assets/img/cat-proyecto.jpg",
        "alt": "Residencia de dos niveles con pórtico y ventanales",
        "services": ["estaciones", "residencial", "industrial", "comercial", "centros", "ecologicas"],
    },
    {
        "key": "construccion",
        "num": "03",
        "name": "Construcción",
        "desc": "Ejecución y supervisión de obra",
        "img": "assets/img/cat-construccion.jpg",
        "alt": "Estructura metálica de cubierta en obra",
        "services": ["obra", "remodelaciones", "ampliaciones"],
    },
    {
        "key": "complementarios",
        "num": "04",
        "name": "Servicios complementarios",
        "desc": "Presupuestos, planos y topografía",
        "img": "assets/img/cat-complementarios.jpg",
        "alt": "Edificio de departamentos en Querétaro",
        "services": ["presupuesto", "planos", "topografia"],
    },
]

SERVICES = {
    "dro": {
        "num": "1.1",
        "name": "DRO",
        "h1": "DRO y corresponsable en seguridad estructural",
        "file": "24_dro-y-corresponsable-en-seguridad-estructural-queretaro.php",
        "title": "DRO y corresponsable en seguridad estructural | Arquitectos Trabajando C+S Estudio",
        "desc": "Director Responsable de Obra avalado por el CAEQ Colegio de Arquitectos del Estado de Querétaro. DRO para obra nueva, ampliación, remodelación, fusión o subdivisión de predios, regularización de obras.",
        "body": """<p><strong>Director Responsable de Obra</strong> avalado por el CAEQ Colegio de Arquitectos del Estado de Querétaro.</p>
        <p>DRO para obra nueva, ampliación, remodelación, fusión o subdivisión de predios, regularización de obras.</p>""",
    },
    "dictamen": {
        "num": "1.2",
        "name": "Perito Dictamen Estructural y Eléctrico",
        "h1": "Dictamen estructural",
        "file": "23_Dictamen-estructural-en-Queretaro.php",
        "title": "Perito dictamen estructural y eléctrico en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Estamos avalados ante el Colegio de Arquitectos para realizar los dictámenes estructurales requeridos por Protección Civil.",
        "body": """<p>Estamos avalados ante el Colegio de Arquitectos para realizar los dictámenes estructurales requeridos por Protección Civil para: Escuelas, Industrias, Restaurantes con licencia de alcohol, Centros comerciales, que por su giro lo requieran.</p>""",
    },
    "corresponsable": {
        "num": "1.3",
        "name": "Corresponsable en Seguridad Estructural e Instalaciones",
        "h1": "Revisiones eléctricas",
        "file": "27_Revisiones-electricas-Queretaro.php",
        "title": "Revisiones eléctricas en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Estamos avalados ante el Colegio de Arquitectos para realizar Revisiones Eléctricas para alto y medio riesgo.",
        "body": """<p>Estamos avalados ante el Colegio de Arquitectos para realizar Revisiones Eléctricas para alto y medio riesgo.</p>""",
    },
    "valuacion": {
        "num": "1.4",
        "name": "Valuación Comercial",
        "h1": "Valuación inmobiliaria e industrial",
        "file": "22_Valuacion-Inmobiliaria-Queretaro.php",
        "title": "Valuación inmobiliaria e industrial en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Soporte técnico y asesoría para conocer el avalúo comercial o de mercado de inmuebles, maquinaria y equipo industrial o de oficina.",
        "body": """<p>Brindamos a nuestro cliente soporte técnico y asesoría para que conozca el avalúo comercial o de mercado de los activos:</p>
        <ul>
          <li>Inmuebles como: Terrenos, Casas Habitacionales, Plantas industriales, Oficinas, Hoteles o Construcciones Especializadas.</li>
          <li>Maquinaria y Equipo industrial o de oficina.</li>
        </ul>""",
    },
    "estaciones": {
        "num": "2.1",
        "name": "Estaciones de Servicios",
        "h1": "Diseño Arquitectónico de Estaciones de Servicio",
        "file": "1_Diseno-Arquitectonico-estaciones-de-servicio-Queretaro.php",
        "title": "Diseño de estaciones de servicio en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Diseño arquitectónico y proyecto ejecutivo de estaciones de servicio en Querétaro.",
        "body": "",
    },
    "residencial": {
        "num": "2.2",
        "name": "Residencial",
        "h1": "Diseño Arquitectónico Residencial",
        "file": "2_Diseno-Arquitectonico-Residencial-Queretaro.php",
        "title": "Diseño arquitectónico residencial en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Conocemos las características, gustos y especificaciones del cliente para su hogar y lo asesoramos en distribución, tendencias y tecnologías para el desarrollo de su proyecto.",
        "body": """<p>A través de entrevistas se conocen las características, gustos y especificaciones que el cliente requiere para su hogar y junto con nuestra experiencia brindamos y asesoramos al cliente con la distribución del espacio, tendencias y tecnologías para el desarrollo de su proyecto. Nuestro compromiso es desarrollar un proyecto que cumpla con sus expectativas de funcionamiento, diseño y presupuesto destinado.</p>""",
    },
    "industrial": {
        "num": "2.3",
        "name": "Industrial",
        "h1": "Diseño Arquitectónico Industrial",
        "file": "3_Diseno-Arquitectonico-Industrial-Queretaro.php",
        "title": "Diseño arquitectónico industrial en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Proyectos que cumplen las especificaciones para el desarrollo de funciones comerciales o industriales, respetando el presupuesto autorizado.",
        "body": """<p>Nuestro compromiso es desarrollar un proyecto que cumpla con las especificaciones para el desarrollo de sus funciones comerciales o industriales, respetando en el desarrollo del proyecto el presupuesto autorizado. El proyecto se desarrollará de tal forma que resuelva aspectos de distribución, funcionalidad, diseño y normativa que le aplique.</p>""",
    },
    "comercial": {
        "num": "2.4",
        "name": "Comercial",
        "h1": "Diseño Arquitectónico Comercial",
        "file": "4_Diseno-Arquitectonico-Comercial-Queretaro.php",
        "title": "Diseño arquitectónico comercial en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Proyectos constructivos con destino comercial que consideran funcionalidad, seguridad y costo, además de la normativa que dicta la autoridad.",
        "body": """<p>Para el desarrollo de proyectos constructivos con un destino comercial se deben tomar en cuenta aspectos como la funcionalidad, seguridad y costo, además de que debe cumplir con la normativa que dicta la autoridad.</p>""",
    },
    "centros": {
        "num": "2.5",
        "name": "Centros escolares",
        "h1": "Diseño Arquitectónico Centros Escolares",
        "file": "6_Diseno-Arquitectonico-Centros-Escolares-Queretaro.php",
        "title": "Diseño de centros escolares en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Asesoría en la definición de espacios para la educación de acuerdo al nivel educativo y sistema de aprendizaje, con experiencia en normativa de infraestructura educativa.",
        "body": """<p>Asesoramos en la definición del desarrollo de espacios para la educación de acuerdo al nivel educativo y sistema de aprendizaje que utilicen; se cuenta con una amplia experiencia en la normativa de infraestructura para la educación.</p>""",
    },
    "ecologicas": {
        "num": "2.6",
        "name": "Casas ecológicas",
        "h1": "Diseño Arquitectónico Casas Ecológicas",
        "file": "5_Diseno-Arquitectonico-Casas-Ecologicas-Queretaro.php",
        "title": "Diseño arquitectónico de casas ecológicas en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Proyectos de casas ecológicas que cuidan orientación, captación de aguas pluviales y manejo de aguas grises y negras, con tecnologías de confort pasivo.",
        "body": """<p>Para el desarrollo de proyectos de casas ecológicas, además de cuidar los aspectos de orientación, captación de aguas pluviales y manejo de las grises y negras, incluimos tecnologías que ayudan a tener espacios confortables sin utilizar climas, además de aprovechar al máximo la iluminación natural y la energía del sol.</p>""",
    },
    "obra": {
        "num": "3.1",
        "name": "Obra nueva",
        "h1": "Construcción de Obra Nueva",
        "file": "11_Construccion-Obra-Nueva-Queretaro.php",
        "title": "Construcción de obra nueva en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Construcción respetando el diseño arquitectónico autorizado, con programa de obra, materiales de primera, mano de obra calificada y normas de seguridad e higiene.",
        "body": """<p>Se construye respetando el diseño arquitectónico autorizado, apoyado de un programa de obra en el que se establecen los plazos de ejecución; se utilizan materiales de primera, mano de obra calificada, se respetan las normas de seguridad e higiene y se optimizan los costos.</p>""",
    },
    "remodelaciones": {
        "num": "3.2",
        "name": "Remodelaciones",
        "h1": "Remodelación de Obra",
        "file": "12_Construccion-Remodelaciones-Queretaro.php",
        "title": "Remodelaciones en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Asesoría para las modificaciones que se puedan realizar en oficina o vivienda, cuidando no afectar estructuralmente lo ya existente.",
        "body": """<p>Si cuentas con un espacio para oficina o vivienda y no se adapta a tus requerimientos, te asesoramos para las modificaciones que se puedan realizar, cuidando no afectar estructuralmente lo ya existente.</p>""",
    },
    "ampliaciones": {
        "num": "3.3",
        "name": "Ampliaciones",
        "h1": "Ampliación de Construcciones",
        "file": "13_Construccion-Ampliaciones-Queretaro.php",
        "title": "Ampliaciones de construcciones en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Asesoría para ampliar tu casa, hacer un piso más o techar tu patio con la seguridad de no afectar estructuralmente lo ya existente.",
        "body": """<p>¿Creció la familia, deseas hacer un piso más en tu casa o techar tu patio?</p>
        <p>Nosotros te asesoramos para que tengas la seguridad de que las modificaciones se pueden realizar sin afectar estructuralmente lo ya existente.</p>""",
    },
    "presupuesto": {
        "num": "4.1",
        "name": "Presupuesto de obra",
        "h1": "Presupuesto de obra",
        "file": "21_Presupuestos-Construccion-Queretaro.php",
        "title": "Presupuesto de obra en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Presupuestos de obra para construcción nueva, remodelación o ampliación, con catálogo de conceptos cotizado de acuerdo al proyecto ejecutivo.",
        "body": """<p>Se elaboran presupuestos de obra ya sea para construcción nueva, remodelación o ampliación de casa, oficina o industria. Con este servicio el cliente puede darse una idea muy aproximada de la inversión que requiere para la ejecución de su proyecto, ya que se genera un catálogo de conceptos correspondiente cotizando este de acuerdo a lo especificado en el proyecto ejecutivo, contribuyendo con el cliente a una planeación de la construcción de su proyecto.</p>""",
    },
    "planos": {
        "num": "4.2",
        "name": "Maquila de planos",
        "h1": "Maquila de planos",
        "file": "25_Planos-Construccion-Queretaro.php",
        "title": "Maquila de planos en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Digitalización de planos de proyectos arquitectónicos o detalles de obra para la construcción, con el software Autocad.",
        "body": """<p>Ofrecemos la digitalización de planos de proyectos arquitectónicos o detalles de obra para la construcción, con el software <strong>Autocad</strong>.</p>""",
    },
    "topografia": {
        "num": "4.3",
        "name": "Levantamientos topográficos",
        "h1": "Levantamientos topográficos",
        "file": "26_Adminstracion-Construccion-Queretaro.php",
        "title": "Levantamientos topográficos en Querétaro | Arquitectos Trabajando C+S Estudio",
        "desc": "Personal y equipo especializado para realizar la planimetría y altimetría necesaria para cualquier proceso constructivo.",
        "body": """<p>Contamos con personal y equipo especializado para realizar la planimetría y altimetría necesaria para cualquier proceso constructivo.</p>""",
    },
}

CATEGORY_OF = {s: c["key"] for c in CATEGORIES for s in c["services"]}
CAT_BY_KEY = {c["key"]: c for c in CATEGORIES}

FILTERS = [
    ("all", "Todos"),
    ("educacion", "Educación"),
    ("vivienda", "Vivienda"),
    ("industria", "Industria"),
    ("comercial", "Comercial"),
]

PROJECTS = [
    {
        "name": "Escuela Aguazarca",
        "place": "Landa de Matamoros, Qro.",
        "types": ["educacion"],
        "photos": [("trabajo-escuela-1.jpg", "Patio y edificio escolar de la Escuela Aguazarca"),
                   ("trabajo-escuela-2.jpg", "Cancha y accesos de la Escuela Aguazarca")],
    },
    {
        "name": "Arco techo",
        "place": "Landa de Matamoros, Qro.",
        "types": ["educacion"],
        "photos": [("trabajo-arco-1.jpg", "Cubierta metálica del arco techo"),
                   ("trabajo-arco-2.jpg", "Vista interior de la cubierta metálica")],
    },
    {
        "name": "Edificio Centro Sur",
        "place": "Querétaro, Qro.",
        "types": ["comercial"],
        "photos": [("trabajo-centro-sur.jpg", "Interior y herrería del Edificio Centro Sur")],
    },
    {
        "name": "Residencia Balvanera",
        "place": "Corregidora, Qro.",
        "types": ["vivienda"],
        "photos": [("trabajo-balvanera.jpg", "Fachada de la Residencia Balvanera")],
    },
    {
        "name": "Bodega Miranda",
        "place": "Querétaro, Qro.",
        "types": ["industria"],
        "photos": [("trabajo-miranda-1.jpg", "Fachada de la Bodega Miranda"),
                   ("trabajo-miranda-2.jpg", "Nave industrial al interior de la Bodega Miranda"),
                   ("trabajo-miranda-3.jpg", "Andador interior de la Bodega Miranda")],
    },
]

# --------------------------------------------------------------------------
# Fragmentos compartidos
# --------------------------------------------------------------------------
ARROW = ('<svg viewBox="0 0 24 24" fill="none" aria-hidden="true">'
         '<path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" '
         'stroke-linecap="round" stroke-linejoin="round"/></svg>')

LOGO = "assets/logo-at.png"


def head(title, desc, canonical, extra=""):
    return f"""<!DOCTYPE html>
<html lang="es-MX">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{title}</title>
<meta name="description" content="{desc}">
<meta name="theme-color" content="#24221F">
<meta property="og:type" content="website">
<meta property="og:site_name" content="Arquitectos Trabajando C+S Estudio">
<meta property="og:locale" content="es_MX">
<meta property="og:title" content="{title}">
<meta property="og:description" content="{desc}">
<link rel="canonical" href="{BASE}{canonical}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@500;600;700&family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@400;500;600&display=swap">
<link rel="stylesheet" href="assets/site.css">
<link rel="icon" type="image/png" href="{LOGO}">
{extra}</head>
<body>
<a class="skip" href="#contenido">Saltar al contenido</a>

<header class="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="index.php" aria-label="Arquitectos Trabajando C+S Estudio — Inicio">
      <img src="{LOGO}" alt="Arquitectos Trabajando C+S Estudio" width="230" height="42">
    </a>
    <nav class="nav" aria-label="Navegación principal">
{nav_links()}
    </nav>
  </div>
</header>
"""


CURRENT = {"key": ""}


def nav_links():
    out = []
    for key, label, href in NAV:
        active = ' aria-current="page"' if CURRENT["key"] == key else ""
        out.append(f'      <a href="{href}"{active}>{label}</a>')
    return "\n".join(out)


def crumbs(items):
    parts = []
    for i, (label, href) in enumerate(items):
        last = i == len(items) - 1
        if last:
            parts.append(f'<span aria-current="page">{label}</span>')
        else:
            parts.append(f'<a href="{href}">{label}</a>')
            parts.append('<span class="sep" aria-hidden="true">/</span>')
    return f'    <nav class="crumbs" aria-label="Ruta de navegación">\n      {" ".join(parts)}\n    </nav>\n'


def footer():
    cats = "\n".join(
        f'        <li><a href="5_Servicios-Arquitectonicos-Queretaro.html#{c["key"]}">{c["name"]}</a></li>'
        for c in CATEGORIES
    )
    nav = "\n".join(f'        <li><a href="{href}">{label}</a></li>' for _, label, href in NAV)
    return f"""
<footer class="site-footer">
  <div class="wrap">
    <div class="footer-top">
      <div class="footer-brand">
        <img src="{LOGO}" alt="Arquitectos Trabajando C+S Estudio" width="240" height="44">
        <p>Arquitectura, peritajes, valuación y construcción en Querétaro. DRO, proyecto arquitectónico y ejecución de obra.</p>
      </div>
      <div class="footer-col">
        <h3>Servicios</h3>
        <ul>
{cats}
        </ul>
      </div>
      <div class="footer-col">
        <h3>Sitio</h3>
        <ul>
{nav}
        </ul>
      </div>
      <div class="footer-col">
        <h3>Contacto</h3>
        <p><a href="tel:{TEL_HREF}">{TEL}</a></p>
        <p><a href="mailto:{EMAIL}">{EMAIL}</a></p>
        <p>{ADDRESS_1}<br>{ADDRESS_2}</p>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 Arquitectos Trabajando C+S Estudio</span>
      <span>Querétaro, México · <a href="//efra.biz" rel="noopener">Desarrollado por Efra</a></span>
    </div>
  </div>
</footer>

</body>
</html>
"""


def mailto(subject=MAIL_SUBJECT):
    return f"mailto:{EMAIL}?subject={subject}"


def cat_card(cat):
    rows = []
    for key in cat["services"]:
        s = SERVICES[key]
        rows.append(
            f'            <li><a href="{s["file"]}">'
            f'<span class="n">{s["num"]}</span>'
            f'<span>{s["name"]}</span>'
            f'<span class="arrow">{ARROW}</span></a></li>'
        )
    return f"""      <article class="cat-card">
        <div class="cat-card__media">
          <img src="{cat["img"]}" alt="{cat["alt"]}" loading="lazy" decoding="async">
          <span class="cat-card__num">{cat["num"]}</span>
        </div>
        <div class="cat-card__body">
          <h3 class="cat-card__title">{cat["name"]}</h3>
          <p class="cat-card__desc">{cat["desc"]}</p>
          <ul class="cat-list">
{chr(10).join(rows)}
          </ul>
        </div>
      </article>"""


def cta_block(title="¿Tienes un proyecto o necesitas un dictamen?",
              text="Llámanos, escríbenos o solicita una visita al sitio."):
    return f"""    <section class="cta">
      <div>
        <h2>{title}</h2>
        <p>{text}</p>
      </div>
      <div class="actions" style="margin-top:0">
        <a class="btn btn-primary" href="{mailto()}">Solicitar información {ARROW}</a>
        <a class="btn btn-ghost" href="tel:{TEL_HREF}">Llamar · {TEL}</a>
      </div>
    </section>
"""


def close_page():
    return footer()


# --------------------------------------------------------------------------
# Páginas
# --------------------------------------------------------------------------
def build_home():
    CURRENT["key"] = "inicio"
    cards = "\n".join(cat_card(c) for c in CATEGORIES[:3])
    html = head(
        "Arquitectos Trabajando C+S Estudio | Arquitectura, peritajes y construcción en Querétaro",
        "Empresa de Querétaro dedicada al diseño arquitectónico, construcción de obra nueva, remodelaciones, presupuestos, valuación, maquila de planos y asesoría.",
        "",
    )
    html += f"""
<main id="contenido">
  <div class="wrap home">
    <div class="home-hero">
      <div>
        <p class="eyebrow">Querétaro, México · Colegio de Arquitectos de Querétaro</p>
        <h1>Arquitectura, peritajes, valuación y construcción</h1>
        <p class="lead">Si piensas construir tu casa o negocio, en Arquitectos Trabajando nos ponemos a tus órdenes con un grupo de trabajo especializado.</p>
      </div>
      <div class="actions">
        <a class="btn btn-primary" href="{mailto()}">Solicitar información {ARROW}</a>
        <a class="btn btn-ghost" href="3_Trabajos-Arquitectonicos.html">Ver trabajos</a>
      </div>
    </div>

    <div class="cat-grid">
{cards}
    </div>
  </div>
</main>
""" + close_page()
    (OUT / "index.php").write_text(html, encoding="utf-8")


def build_servicios():
    CURRENT["key"] = "servicios"
    html = head(
        "Servicios arquitectónicos en Querétaro | Arquitectos Trabajando C+S Estudio",
        "DRO y peritajes, proyecto arquitectónico, construcción, presupuestos, planos y levantamientos topográficos en Querétaro.",
        "5_Servicios-Arquitectonicos-Queretaro.html",
    )
    html += """
<main id="contenido">
  <div class="wrap">
""" + crumbs([("Inicio", "index.php"), ("Servicios", "")]) + """
    <div class="home-hero">
      <div>
        <p class="eyebrow">Querétaro, México · Servicios</p>
        <h1>Servicios de arquitectura, peritaje y construcción</h1>
        <p class="lead">DRO y peritajes, proyecto arquitectónico y ejecución de obra, además de presupuestos, planos y levantamientos topográficos.</p>
      </div>
      <div class="actions">
        <a class="btn btn-primary" href="mailto:arquitectos_trabajando@yahoo.com.mx?subject=Solicitud%20de%20informaci%C3%B3n">Solicitar información
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>
    </div>
"""
    for cat in CATEGORIES:
        rows = []
        for key in cat["services"]:
            s = SERVICES[key]
            rows.append(
                f'          <li><a href="{s["file"]}"><span class="n">{s["num"]}</span>'
                f'<span>{s["name"]}</span><span class="arrow">{ARROW}</span></a></li>'
            )
        html += f"""
    <section class="section" id="{cat["key"]}">
      <div class="cat-index">
        <div class="cat-index__head">
          <p class="eyebrow">{cat["num"]} · {cat["name"]}</p>
          <h2>{cat["desc"]}</h2>
        </div>
        <ul class="cat-list">
{chr(10).join(rows)}
        </ul>
      </div>
    </section>
"""
    html += cta_block() + """
  </div>
</main>
""" + close_page()
    (OUT / "5_Servicios-Arquitectonicos-Queretaro.html").write_text(html, encoding="utf-8")


def build_detail(key):
    s = SERVICES[key]
    cat = CAT_BY_KEY[CATEGORY_OF[key]]
    CURRENT["key"] = "servicios"

    side_rows = []
    for k in cat["services"]:
        o = SERVICES[k]
        active = ' aria-current="page"' if k == key else ""
        side_rows.append(
            f'          <li><a href="{o["file"]}"{active}><span class="n">{o["num"]}</span>'
            f'<span>{o["name"]}</span></a></li>'
        )

    body = s["body"] if s["body"] else ""
    html = head(s["title"], s["desc"], s["file"])
    html += """
<main id="contenido">
  <div class="wrap">
""" + crumbs([("Inicio", "index.php"), ("Servicios", "5_Servicios-Arquitectonicos-Queretaro.html"),
              (cat["name"],
               "5_Servicios-Arquitectonicos-Queretaro.html#" + cat["key"]),
              (s["name"], "")]) + f"""
    <div class="detail">
      <div>
        <p class="eyebrow">{s["num"]} · {cat["name"]}</p>
        <h1>{s["h1"]}</h1>
        <p class="lead">{cat["desc"]}</p>

        <figure class="detail__media">
          <img src="{cat["img"]}" alt="{cat["alt"]}" loading="lazy" decoding="async">
        </figure>

        <div class="detail__body">
{body}
        </div>

        <div class="actions">
          <a class="btn btn-primary" href="{mailto()}">Solicitar información {ARROW}</a>
          <a class="btn btn-ghost" href="3_Trabajos-Arquitectonicos.html">Ver trabajos</a>
        </div>
      </div>

      <aside class="side" aria-label="Servicios relacionados">
        <div class="side-card">
          <p class="side-card__head">{cat["num"]} · {cat["name"]}</p>
          <ul class="side-list">
{chr(10).join(side_rows)}
          </ul>
        </div>
        <div class="side-card side-contact">
          <p class="side-card__head">Contacto directo</p>
          <a href="tel:{TEL_HREF}"><span class="label">Teléfono</span><span class="value">{TEL}</span></a>
          <a href="{mailto()}"><span class="label">Correo</span><span class="value">{EMAIL}</span></a>
        </div>
      </aside>
    </div>
  </div>
</main>
""" + close_page()
    (OUT / s["file"]).write_text(html, encoding="utf-8")


def build_trabajos():
    CURRENT["key"] = "trabajos"
    import json as _json

    blocks = []
    for i, p in enumerate(PROJECTS):
        cover, cover_alt = p["photos"][0]
        n = len(p["photos"])
        badge = f'{n} foto' if n == 1 else f'{n} fotos'
        blocks.append(f"""        <a class="work" href="assets/img/{cover}" data-types="{' '.join(p['types'])}" data-project="{i}">
          <figure class="work__cover">
            <img src="assets/img/{cover}" alt="{cover_alt}" loading="lazy" decoding="async">
            <span class="work__badge">{badge}</span>
          </figure>
          <div class="work__info">
            <span class="idx">{i + 1:02d}</span>
            <h2>{p["name"]}</h2>
            <p class="place">{p["place"]}</p>
          </div>
        </a>""")

    chips = []
    for key, label in FILTERS:
        count = len(PROJECTS) if key == "all" else sum(1 for p in PROJECTS if key in p["types"])
        active = key == "all"
        cls = "chip is-active" if active else "chip"
        chips.append(
            f'        <button class="{cls}" type="button" data-filter="{key}" '
            f'aria-pressed="{"true" if active else "false"}">{label} <span>{count}</span></button>'
        )

    gallery = [
        {
            "name": p["name"],
            "place": p["place"],
            "photos": [{"src": f"assets/img/{img}", "alt": alt} for img, alt in p["photos"]],
        }
        for p in PROJECTS
    ]

    html = head(
        "Trabajos arquitectónicos en Querétaro | Arquitectos Trabajando C+S Estudio",
        "Proyectos y obras del estudio en Querétaro: Escuela Aguazarca, Arco techo, Edificio Centro Sur, Residencia Balvanera y Bodega Miranda.",
        "3_Trabajos-Arquitectonicos.html",
        extra='<script src="assets/site.js" defer></script>\n',
    )
    html += """
<main id="contenido">
  <div class="wrap">
""" + crumbs([("Inicio", "index.php"), ("Trabajos", "")]) + """
    <div class="home-hero gallery-head">
      <div>
        <p class="eyebrow">Portafolio</p>
        <h1>Trabajos</h1>
        <p class="lead">Proyectos y obras del estudio en Querétaro. Educación, vivienda, industria y espacios de trabajo.</p>
      </div>
      <div class="actions">
        <a class="btn btn-ghost" href="5_Servicios-Arquitectonicos-Queretaro.html">Ver servicios</a>
      </div>
    </div>

    <div class="filters" role="group" aria-label="Filtrar trabajos por tipo">
""" + "\n".join(chips) + """
    </div>

    <div class="projects" id="proyectos">
""" + "\n".join(blocks) + """
    </div>

    <p class="works-empty" hidden>No hay trabajos en esta categoría por ahora.</p>

    <script type="application/json" id="projects-data">
""" + _json.dumps(gallery, ensure_ascii=False, separators=(",", ":")) + """
    </script>

""" + cta_block("¿Tienes un proyecto en mente?", "Cuéntanos qué necesitas construir, ampliar o regularizar.") + """
  </div>
</main>

<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-labelledby="lightbox-title" hidden>
  <button class="lightbox__close" type="button" aria-label="Cerrar galería">
    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m6 6 12 12M18 6 6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
  </button>
  <button class="lightbox__nav lightbox__prev" type="button" aria-label="Fotografía anterior">
    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M15 5 8 12l7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
  </button>
  <figure class="lightbox__figure">
    <img src="" alt="">
    <figcaption>
      <div>
        <h2 class="lightbox__title" id="lightbox-title"></h2>
        <p class="lightbox__place"></p>
      </div>
      <span class="lightbox__count"></span>
    </figcaption>
  </figure>
  <button class="lightbox__nav lightbox__next" type="button" aria-label="Fotografía siguiente">
    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
  </button>
</div>
""" + close_page()
    (OUT / "3_Trabajos-Arquitectonicos.html").write_text(html, encoding="utf-8")


def build_contacto():
    CURRENT["key"] = "contacto"
    html = head(
        "Despacho de arquitectos en Querétaro | Arquitectos Trabajando C+S Estudio",
        "Paseo de Ankara No. 273, Col. Tejeda, Corregidora, Querétaro. Teléfono 442 239 5018 y correo arquitectos_trabajando@yahoo.com.mx.",
        "4_Arquitectos-en-Queretaro.html",
    )
    html += """
<main id="contenido">
  <div class="wrap">
""" + crumbs([("Inicio", "index.php"), ("Contacto", "")]) + """
    <p class="eyebrow">Despacho de arquitectos · Querétaro, México</p>
    <h1>Contacto</h1>
    <p class="lead">Escríbenos o visítanos en la oficina. Atendemos proyectos, dictámenes y trámites en Querétaro y la región.</p>

    <div class="contact-grid">
      <div class="info-block">
        <div class="info-row">
          <svg class="ico" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11Z" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.6"/></svg>
          <div>
            <span class="k">Dirección</span>
            <span class="v">""" + ADDRESS_1 + """<br>""" + ADDRESS_2 + """</span>
          </div>
        </div>
        <div class="info-row">
          <svg class="ico" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6.5 3.5 9 8l-2 2c1.2 3 3 4.8 6 6l2-2 4.5 2.5V20c0 1-1 1.7-2 1.5C9.5 20 4 14.5 3 6.5 2.8 5.5 3.5 4.5 4.5 4.5h2Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
          <div>
            <span class="k">Teléfono</span>
            <a class="v" href="tel:""" + TEL_HREF + """">""" + TEL + """</a>
          </div>
        </div>
        <div class="info-row">
          <svg class="ico" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
          <div>
            <span class="k">Correo</span>
            <a class="v" href="""" + mailto() + """">""" + EMAIL + """</a>
          </div>
        </div>
      </div>

      <div class="map-card">
        <h2>Cómo llegar</h2>
        <p>""" + ADDRESS_1 + """<br>""" + ADDRESS_2 + """</p>
        <a class="btn btn-primary btn-sm" href="""" + MAPS + """" target="_blank" rel="noopener">Abrir en Google Maps</a>
        <p style="font-family:var(--mono);font-size:10.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--ink-muted)">Querétaro, México</p>
      </div>
    </div>

    <section class="cta">
      <div>
        <h2>¿Tienes un proyecto o necesitas un dictamen?</h2>
        <p>Envíanos los datos de tu proyecto y te contactamos.</p>
      </div>
      <div class="actions" style="margin-top:0">
        <a class="btn btn-primary" href="""" + mailto() + """">Enviar correo """ + ARROW + """</a>
        <a class="btn btn-ghost" href="tel:""" + TEL_HREF + """">Llamar · """ + TEL + """</a>
      </div>
    </section>
  </div>
</main>
""" + close_page()
    (OUT / "4_Arquitectos-en-Queretaro.html").write_text(html, encoding="utf-8")


def main():
    build_home()
    build_servicios()
    for key in SERVICES:
        build_detail(key)
    build_trabajos()
    build_contacto()
    pages = ["index.php", "5_Servicios-Arquitectonicos-Queretaro.html",
             "3_Trabajos-Arquitectonicos.html", "4_Arquitectos-en-Queretaro.html"]
    pages += [s["file"] for s in SERVICES.values()]
    print(f"{len(pages)} páginas generadas")
    for p in pages:
        path = OUT / p
        print("  ", p, path.stat().st_size // 1024, "KB")


if __name__ == "__main__":
    main()
