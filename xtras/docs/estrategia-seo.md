# Auditoría y estrategia SEO — Arquitectos Trabajando

Fecha: 23 de noviembre de 2026.

### Actualización autorizada: 25 de noviembre de 2026

La tercera categoría pasa de Construcción a **Restauración** y sustituye sus cuatro servicios por **Escultura, Pintura, Murales y Retablos**. No se trasladaron los servicios retirados a otra categoría. El sitio conserva cuatro categorías, 19 servicios activos y 23 páginas públicas indexables.

Nuevas rutas: `/servicios/restauracion-escultura`, `/servicios/restauracion-pintura`, `/servicios/restauracion-murales` y `/servicios/restauracion-retablos`. Cada página tiene texto descriptivo provisional, título y descripción propios e ilustración SVG de referencia identificada como tal. La imagen de categoría sigue siendo `assets/img/cat-construccion.jpg`. Cuando se reciban materiales aprobados, actualizar `body`, `image`, `alt` e `image_caption` en el catálogo; retirar la leyenda provisional cuando corresponda.

Las cuatro rutas limpias anteriores (`obra-nueva`, `construccion-remodelaciones`, `ampliaciones` y `murales-pintura-escultura`, bajo `/servicios/`) y sus cuatro URLs PHP históricas responden **410**, con una vista que permite consultar los servicios actuales. No redirigen a prestaciones diferentes, no publican JSON-LD y llevan `noindex`. No forman parte del catálogo, de las rutas públicas activas ni del sitemap. Se retiró el enlace editorial que apuntaba a construcción de remodelaciones. El ancla histórica `#construccion` queda como alias de ubicación para la nueva categoría del catálogo, sin crear una página indexable adicional.

El respaldo previo completo y verificado está en `xtras/backups/antes-sustitucion-restauracion-20261125.zip`. `datos/servicios-20261125.php`, creado por el usuario, permanece intacto. El ZIP de la intervención anterior revertida también se conserva; solo se reutilizaron de él los textos e ilustraciones provisionales de los cuatro servicios nuevos, no la reorganización rechazada.

Cambios en catálogo, rutas, controlador (410), funciones compartidas, vistas de servicios, estilos de ilustraciones y pruebas. Sitemap y robots mantienen sus generadores y configuración; el mapa incorpora automáticamente las cuatro rutas nuevas y excluye las retiradas. Validación local: 23 páginas activas, 19 Service, 22 BreadcrumbList, 38 redirecciones de rutas conservadas, 8 URLs retiradas con 410 (incluyendo variantes y HEAD), navegación, imágenes, anclas, sitemap, robots, ausencia de JSON-LD en errores, sintaxis PHP y `git diff --check`. No se realizó despliegue, commit ni push. Los hallazgos y planes de la auditoría inicial que siguen se conservan como historial; las páginas retiradas ya no son objetivos editoriales activos.

## Alcance y conclusión

Se analizaron el código PHP, las 23 páginas renderizadas por Apache local, el catálogo de 19 servicios, metadatos, imágenes, navegación y reglas de reescritura. La estructura técnica permite rastrear las páginas; las mayores oportunidades están en contenido útil por servicio, evidencia de experiencia y descripción estructurada del negocio.

La herramienta web no pudo acceder al dominio público ni a sus rutas `robots.txt` y `sitemap.xml`. Esto no demuestra que el servidor esté caído. No se comprobó que producción contenga esta versión, ni se tuvo acceso a Search Console, datos de tráfico, conversiones, enlaces externos o métricas de campo. Por ello, este informe no asigna una puntuación SEO ni afirma posiciones, penalizaciones o mejoras de tráfico.

## Hallazgos verificados

| Área | Evidencia local | Acción |
| --- | --- | --- |
| Páginas públicas | 4 principales y 19 detalles de servicio; HTML generado en servidor. | Conservar la arquitectura y la navegación HTML. |
| Títulos y descripciones | 23 títulos distintos y 23 descripciones distintas. | Revisar claridad e intención, no duplicación. |
| Canonical y Open Graph | URLs absolutas con dominio configurado; imagen social, título y descripción compartidos correctamente. | Comprobar equivalencia con HTTPS/dominio definitivo en producción. |
| Redirecciones | Tabla de equivalencias desde las URLs antiguas. | Mantenerlas tras publicar y revisar errores de rastreo. |
| Datos estructurados | En la auditoría inicial no había JSON-LD, microdatos Schema.org ni RDFa. | Implementados ahora LocalBusiness, WebSite, Service y BreadcrumbList; ver validación técnica al final. |
| Sitemap | No existía al iniciar esta tarea. | Implementado en esta entrega, dinámico y accesible como `sitemap.xml`. |
| Robots | No existía `robots.txt` en la auditoría inicial. | Creado y servido directamente por Apache, con referencia al sitemap y sin bloqueos de páginas o recursos. |
| Texto de servicios | 16 de 19 cuerpos tienen menos de 100 palabras; Estaciones de servicio no tiene contenido en `body`. | Completar primero servicios prioritarios y la página vacía. El conteo es diagnóstico, no una meta de posicionamiento. |
| Portafolio | Cinco proyectos en una galería, sin páginas individuales ni relatos detallados de cada obra. | Crear casos verificables, asociados a los servicios correspondientes. |
| Imágenes | Fotografías JPG de aproximadamente 120–144 KB entre las mayores; imágenes de categoría reutilizadas en detalles. | Probar formatos modernos, tamaños adaptativos e imágenes propias por servicio cuando existan. |
| Estabilidad visual | Las imágenes de Trabajos no declaran dimensiones HTML; existen estilos que deben evaluarse conjuntamente. | Medir CLS y reservar espacio sin alterar el diseño. No se presume un fallo de CLS por el HTML solamente. |
| Jerarquía | Inicio pasa de H1 a H3 para las tarjetas. | Evaluar H2 para esas categorías conservando sus clases CSS. |

Hay una errata en la descripción de Inicio: “contrucción”. Los títulos de servicios miden entre 64 y 91 caracteres y repiten la marca extensa. Conviene priorizar servicio y ubicación y reducir la parte repetida. No existe una longitud fija que garantice el título mostrado: Google puede recortarlo o elegir otro texto. [Guía de títulos de Google](https://developers.google.com/search/docs/appearance/title-link).

## Datos estructurados: diagnóstico inicial e implementación

**En la auditoría inicial no había marcado Schema.org; ahora está implementado y validado localmente.** Las etiquetas Open Graph sirven para describir las tarjetas sociales. El bloque `application/json` de Trabajos alimenta la galería y no es JSON-LD semántico para buscadores.

Se genera JSON-LD desde funciones centralizadas de PHP, reutilizando la configuración y el catálogo. La implementación respeta la distribución propuesta originalmente:

| Tipo implementado | Ubicación | Contenido y fuente |
| --- | --- | --- |
| `LocalBusiness` | Inicio y Contacto | Identificador estable `https://arquitectostrabajando.com.mx/#negocio`, nombre comercial, URL, logo, imagen, teléfono, correo y dirección postal. Reutilizar `config.php` y separar los componentes postales verificados. |
| `WebSite` | Inicio | Nombre, URL y referencia al negocio. No declarar buscador interno: no existe. |
| `Service` | Cada detalle | Nombre, descripción, URL, tipo de servicio, área real de atención y referencia al proveedor mediante el mismo `@id`. Reutilizar `datos/servicios.php`. |
| `BreadcrumbList` | Servicios, Trabajos, Contacto y detalles | Lista ordenada coherente con la navegación visible y URLs definitivas. No inventar páginas de categoría que solo existen como anclas. |

Google documenta `LocalBusiness` para comunicar datos del negocio. Antes de añadir horarios, coordenadas, perfiles oficiales o rango de precios, confirmarlos con el despacho. No inventar valoraciones, certificaciones ni reseñas. [Documentación de LocalBusiness](https://developers.google.com/search/docs/appearance/structured-data/local-business).

`Service` describe la prestación, su proveedor y cobertura; no debe presentarse como una promesa de resultado enriquecido. [Definición de Service](https://schema.org/Service). La navegación estructurada se comprobará con las reglas de [BreadcrumbList](https://developers.google.com/search/docs/appearance/structured-data/breadcrumb).

Implementación realizada: funciones `structured_data()` y `render_structured_data()` en `includes.php`, salida con `json_encode` y escape seguro para HTML, exclusión en 404 e identificadores coherentes entre páginas. Validar con Schema Markup Validator y, para tipos admitidos por Google, Rich Results Test. Tras publicar, utilizar Inspección de URLs. El marcado no sustituye el contenido ni garantiza una presentación específica en resultados.

## Estrategia de contenido y búsqueda local

### Una intención principal por página

Las siguientes consultas son hipótesis editoriales basadas en los servicios actuales, no estimaciones de volumen. Validar prioridad comercial con el despacho y demanda con Search Console cuando haya datos.

| Página | Intención objetivo | Desarrollo recomendado |
| --- | --- | --- |
| Inicio | Arquitectos en Querétaro / despacho de arquitectura | Propuesta del estudio, cobertura real, especialidades, equipo y acceso a casos. Conservar el diseño aprobado. |
| DRO y corresponsable | DRO en Querétaro | Alcance, situaciones en que se solicita, proceso, documentación y credenciales verificadas. |
| Dictamen estructural | Dictamen estructural en Querétaro | Diferenciar inspección, evaluación y entregables; casos y límites del servicio. |
| Diseño residencial | Diseño de casas en Querétaro | Etapas, decisiones del cliente, entregables y proyectos residenciales reales. |
| Diseño de remodelaciones | Proyecto de remodelación | Diagnóstico y diseño previo; enlazar a ejecución de obra. |
| Construcción de remodelaciones | Ejecución de remodelaciones | Programación, coordinación y ejecución según proyecto. Diferenciar de la página de diseño. |
| Valuación inmobiliaria / arte | Valuación según tipo de activo | Mantener separadas sus metodologías, documentos y objetivos. |
| Estaciones de servicio | Proyecto arquitectónico de estaciones | Completar la página vacía con alcance confirmado y experiencia demostrable. |

Cada servicio debería explicar qué problema resuelve, para quién es, qué incluye y qué no, etapas, información inicial requerida, entregables, factores que influyen en plazo/costo y un caso pertinente. Añadir preguntas frecuentes reales sin relleno ni una cuota artificial de palabras. Someter afirmaciones normativas o de acreditaciones a revisión del responsable del despacho.

Convertir las obras mejor documentadas en casos con URL propia: ubicación autorizada, tipo de proyecto, necesidad inicial, trabajo realizado, soluciones, imágenes y relación con el servicio. No publicar datos privados de clientes. La galería actual se conservaría como índice.

Incorporar enlaces contextuales servicio → caso → contacto y entre prestaciones complementarias. Evitar crear múltiples páginas casi idénticas por colonia o municipio; ampliar cobertura únicamente donde exista actividad real y contenido propio.

### Presencia local y confianza

Revisar, con acceso del propietario, que el Perfil de Empresa de Google tenga nombre, dirección, teléfono, horarios, categoría y URL correctos. Comparar estos datos con Contacto y el JSON-LD implementado. Añadir perfiles oficiales verificados y una presentación del equipo, responsabilidades y acreditaciones demostrables. Solicitar reseñas auténticas de clientes y responderlas; no fabricar testimonios ni calificaciones.

## Rendimiento y experiencia

Medir Inicio, un detalle, catálogo y Trabajos en móvil antes de optimizar. La revisión de código no equivale a una medición de Core Web Vitals. Objetivos de referencia: LCP en 2.5 s o menos, INP en 200 ms o menos y CLS en 0.1 o menos, comprobados con datos representativos de usuarios. [Core Web Vitals de Google](https://developers.google.com/search/docs/appearance/core-web-vitals).

Acciones a validar mediante medición: WebP/AVIF con alternativa JPG, `srcset` y tamaños adecuados; dimensiones o proporciones reservadas; no diferir con lazy loading una imagen que resulte ser el LCP; revisar tres familias de Google Fonts y pesos utilizados; comprobar compresión y caché en el alojamiento. No se recomienda modificar todo a la vez sin una comparación previa/posterior.

## Plan de ejecución y medición

| Plazo orientativo | Prioridad y responsable | Entregable / criterio |
| --- | --- | --- |
| Entrega actual | Desarrollo | Sitemap dinámico probado, sin cambios al diseño ni despliegue. |
| Semana 1 | Desarrollo + responsable del sitio | Revisar producción, HTTPS y variantes de dominio; publicar el sitemap cuando se autorice; verificar Search Console y enviarlo. Resolver errata y metadatos prioritarios. |
| Semanas 1–2 | Despacho + desarrollo | Confirmar datos del negocio y añadir JSON-LD validado. Completar Estaciones de servicio y 3–5 servicios de mayor valor comercial. |
| Semanas 3–4 | Despacho + contenidos | Publicar al menos dos casos reales, enriquecer perfiles profesionales y revisar presencia local. |
| Mes 2 | Desarrollo | Medir rendimiento real, corregir los principales problemas observados y verificar navegación móvil. |
| Mes 3 y continuo | Responsable SEO + despacho | Revisar consultas, páginas de entrada y solicitudes; ajustar páginas con impresiones relevantes y bajo rendimiento. |

Establecer una línea base antes de los cambios: URLs válidas/indexadas, impresiones y clics orgánicos por página/consulta, CTR, país/dispositivo, contactos orgánicos y errores de rastreo. Comparar periodos de 28 días y, cuando exista historial, el mismo periodo del año anterior. Separar búsquedas de marca y de servicio.

Configurar medición de clics en teléfono y correo si se aprueba la analítica. Un clic no equivale a un cliente potencial confirmado: registrar por separado solicitudes efectivas y calidad comercial. No se establecen porcentajes de crecimiento sin línea base.

## Sitemap implementado

- Archivo: `sitemap.php`.
- URL local: `http://localhost/arquitectos/site/sitemap.xml`.
- URL prevista al publicar: `https://arquitectostrabajando.com.mx/sitemap.xml`.
- Fuente: `rutas.php`, que incorpora los servicios de `datos/servicios.php`.
- Salida: XML UTF-8 con namespace estándar y 23 URLs absolutas del dominio configurado. Sin archivos internos, rutas antiguas, parámetros, anclas ni el propio sitemap.
- Las peticiones a `sitemap.php` y variantes con barra final redirigen mediante 301 a `sitemap.xml`. La regla específica aparece antes de la regla genérica de PHP.
- Un servicio nuevo se incorpora automáticamente a través del catálogo. Una ruta futura puede excluirse con `'sitemap' => false` en sus metadatos de ruta; esto solo excluye del mapa, no añade `noindex` ni bloquea el acceso.
- No se incluyen `lastmod` inventados ni la fecha de cada petición. Se podrán añadir cuando exista un registro fiable por página. No se incluyeron `priority` ni `changefreq`.

Estas decisiones siguen las recomendaciones sobre URLs canónicas absolutas y fechas fiables de [Google para sitemaps](https://developers.google.com/search/docs/crawling-indexing/sitemaps/build-sitemap). El sitemap ayuda al descubrimiento; no garantiza indexación.

La fase técnica posterior ya creó `robots.txt` con `Sitemap: https://arquitectostrabajando.com.mx/sitemap.xml` y la excepción correspondiente en `.htaccess`. Se sirve directamente, sin pasar por PHP. Queda pendiente publicarlo en la raíz del dominio y enviar el mapa en Search Console. En local se comprueba bajo `/arquitectos/site/robots.txt`; esta ubicación de pruebas no sustituye al `/robots.txt` del dominio público.

### Pruebas de esta entrega

Sintaxis PHP correcta; XML parseable; 23 entradas únicas coincidentes con la tabla de rutas; todos los destinos respondieron 200 localmente; respuesta `application/xml`; HEAD sin cuerpo; 301 de los alias; dominio independiente del encabezado Host.

En un entorno temporal se añadió un servicio al catálogo y el sitemap pasó automáticamente a 24 entradas. Se marcó una ruta como excluida y desapareció correctamente del XML. Los archivos operativos no se modificaron para estas pruebas.

Los datos estructurados y robots.txt quedaron implementados en la fase técnica descrita a continuación. Las recomendaciones editoriales y de rendimiento siguen pendientes; no se alteraron contenidos comerciales, diseño, producción ni cuentas externas.

## Fase técnica: JSON-LD y robots.txt implementados

Fecha: 23 de noviembre de 2026. Trabajo exclusivamente local, sin despliegue, commit ni push. Los hallazgos de contenido y las recomendaciones editoriales anteriores permanecen vigentes; esta fase solo implementa marcado y acceso a robots.txt.

### Origen de los datos y archivos modificados

| Archivo | Cambio |
| --- | --- |
| `config.php` | Centraliza el nombre comercial y las rutas de las imágenes que ya se publicaban en `includes.php`. Descompone la dirección publicada en calle, colonia, municipio, estado y país. Los campos visibles `address` y `locality` se derivan de esos componentes sin cambiar su texto. |
| `includes.php` | Construye el grafo JSON-LD según la vista y lo incluye en el head. Reutiliza nombre e imágenes de la configuración también en las etiquetas existentes, conservando su salida. |
| `.htaccess` | Añade una excepción para servir el archivo existente `robots.txt` directamente como `text/plain`, antes de la regla final del ruteador. |
| `robots.txt` | Nuevo archivo con `User-agent: *`, `Allow: /` y la referencia absoluta al sitemap. Sin `Disallow`. |
| `xtras/verificar-seo.py` | Validador local automatizado con biblioteca estándar de Python y PHP CLI. |
| `xtras/docs/estrategia-seo.md` | Actualiza el estado de la implementación y documenta resultados y pendientes. |

`index.php`, `rutas.php`, `datos/servicios.php`, `sitemap.php`, las vistas, estilos, imágenes y JavaScript no se modificaron en esta fase.

El teléfono y correo proceden de `config.php`; se utiliza la forma internacional ya existente en `phone_href`. El nombre comercial procede de las etiquetas y del logotipo que ya se mostraban, y ahora tiene una clave única en la misma configuración. El logo utiliza `/assets/logo-at.png` y la imagen corporativa `/assets/logo-og.jpg`, ambos ya existentes.

La dirección tiene como fuente exclusivamente la cadena antes publicada en `config.php`: Paseo de Ankara No. 273, Col. Tejeda, Corregidora, Querétaro, México. La calle y colonia se guardan por separado en configuración y se combinan en `PostalAddress.streetAddress`; el municipio corresponde a `addressLocality`, el estado a `addressRegion` y el país a `addressCountry`. No se añadieron código postal, coordenadas, horarios, acreditaciones, precios, valoraciones ni perfiles sociales.

### Distribución y coherencia del marcado

- **Inicio:** `LocalBusiness` y `WebSite`. Este último referencia al negocio mediante `publisher`; no declara `SearchAction` ni buscador interno.
- **Contacto:** la misma entidad `LocalBusiness` y `BreadcrumbList` Inicio → Contacto.
- **Servicios y Trabajos:** `BreadcrumbList` Inicio → página actual.
- **19 detalles:** `Service` y `BreadcrumbList` Inicio → Servicios → servicio actual, con tres URLs de páginas reales, sin anclas de categoría.
- **404:** no se genera ningún bloque JSON-LD.

El identificador de negocio es `https://arquitectostrabajando.com.mx/#negocio` en las dos declaraciones y en todos los `provider`. La URL y los identificadores se construyen mediante `canonical()` desde el dominio configurado, nunca desde Host.

Cada `Service` obtiene `name` del campo `heading` del catálogo, que es su H1 visible; `description` del resumen editorial existente que ya alimenta sus metadatos; y `url` de `path`. El breadcrumb usa el nombre corto que ya muestra la navegación del detalle. No se añadieron prestaciones ni afirmaciones nuevas. La página de Estaciones de servicio sigue sin cuerpo descriptivo: el marcado reutiliza su resumen y encabezado existentes, y la mejora editorial continúa pendiente.

La cobertura se limita al texto “Querétaro”, respaldado por las páginas y el footer; se reutiliza el valor publicado de la región en configuración sin inferir cobertura nacional, radios de atención ni municipios adicionales.

El JSON se serializa con `JSON_HEX_TAG`, `JSON_HEX_AMP`, `JSON_HEX_APOS`, `JSON_HEX_QUOT`, `JSON_UNESCAPED_UNICODE`, `JSON_UNESCAPED_SLASHES` y `JSON_THROW_ON_ERROR`. Los datos siguen siendo JSON válido y las cadenas no pueden cerrar el elemento `script` mediante un literal `</script>`.

### Resultados de pruebas locales

Entorno de comprobación: PHP 8.2 y Apache local en `http://localhost/arquitectos/site`.

| Prueba | Resultado |
| --- | --- |
| 23 páginas públicas | Todas responden 200 y publican JSON parseable con distribución correcta. |
| Tipos y atributos | 2 LocalBusiness idénticos, 1 WebSite, 19 Service con identificadores distintos y 22 BreadcrumbList; comprobados campos, relaciones, nombres, dirección, imágenes y orden de navegación. |
| Coherencia con catálogo | Los 19 servicios coinciden con su encabezado, descripción y URL existentes. |
| URLs e identificadores | Absolutos, canónicos y con un único identificador de negocio. Una petición con Host ajeno no modifica el HTML ni el JSON-LD de ninguna de las 23 páginas. |
| Navegación | Enlaces y recursos locales responden 200; anclas existentes. 23 equivalencias antiguas probadas con y sin parámetros: 46 redirecciones 301 correctas. |
| Robots | 200, `text/plain`, cuerpo idéntico al archivo del disco, sin cabecera de PHP y HEAD correcto. Sin bloqueos de páginas o recursos. |
| Sitemap | Continúa respondiendo XML con 23 URLs únicas; contenido idéntico al anterior y archivo fuente sin modificaciones. |
| Errores 404 | Rutas inexistentes y recurso inexistente devuelven 404 y no contienen JSON-LD. |
| Escape seguro | Una cadena de prueba con cierre de script, etiquetas, comillas y ampersand se recupera desde JSON sin generar un segundo script HTML. |
| Conservación | El HTML anterior y posterior coincide al retirar el único bloque JSON-LD y normalizar espacios. Los hashes confirman que archivos fuera del alcance no cambiaron. |
| Sintaxis PHP | Los 12 archivos PHP operativos pasan `php -l` en PHP 8.2. |
| Revisión del diff | `git diff --check` aprobado, sin errores de espacios. No se ejecutó commit ni push. |

Repetir la validación desde la raíz del proyecto:

```powershell
python -B xtras/verificar-seo.py http://localhost/arquitectos/site
```

El tercer argumento opcional acepta la captura JSON previa de HTML y hashes para repetir la comprobación de conservación. Esa captura se guardó temporalmente fuera de la raíz pública durante la implementación.

### Validaciones externas pendientes

No se envió información a validadores externos ni se publicó el sitio. Las pruebas locales verifican sintaxis, coherencia y comportamiento; no equivalen a una certificación de resultados enriquecidos por Google.

Después de una publicación autorizada:

1. Validar Inicio, Contacto y un detalle mediante Schema Markup Validator; comprobar los tipos admitidos en Google con Rich Results Test, especialmente LocalBusiness y BreadcrumbList. `Service` no implica por sí solo un resultado enriquecido de Google.
2. Usar Inspección de URLs en Search Console para verificar renderizado, canonical, acceso al marcado e indexación en el dominio definitivo.
3. Comprobar `/robots.txt` y `/sitemap.xml` en la raíz pública, accesibles por HTTPS y con sus tipos MIME correctos. Enviar el sitemap en Search Console y revisar su procesamiento.
4. Revisar posteriormente los informes de mejoras y los avisos de Google. No completar campos desconocidos con valores inventados para eliminar advertencias opcionales.

Se mantienen las referencias oficiales de Schema.org y Google de las secciones anteriores; para la correspondencia de componentes postales se consultó también [PostalAddress](https://schema.org/PostalAddress).
