# Auditoría y estrategia SEO — Arquitectos Trabajando

Fecha: 23 de noviembre de 2026.

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
| Datos estructurados | Ninguna página contiene JSON-LD, microdatos Schema.org o RDFa identificable en la revisión. | Incorporar negocio, servicios y breadcrumbs de forma centralizada. |
| Sitemap | No existía al iniciar esta tarea. | Implementado en esta entrega, dinámico y accesible como `sitemap.xml`. |
| Robots | No existe `robots.txt` en el proyecto local. | Prepararlo al publicar e incluir la referencia al sitemap; su ausencia por sí sola no bloquea la indexación. |
| Texto de servicios | 16 de 19 cuerpos tienen menos de 100 palabras; Estaciones de servicio no tiene contenido en `body`. | Completar primero servicios prioritarios y la página vacía. El conteo es diagnóstico, no una meta de posicionamiento. |
| Portafolio | Cinco proyectos en una galería, sin páginas individuales ni relatos detallados de cada obra. | Crear casos verificables, asociados a los servicios correspondientes. |
| Imágenes | Fotografías JPG de aproximadamente 120–144 KB entre las mayores; imágenes de categoría reutilizadas en detalles. | Probar formatos modernos, tamaños adaptativos e imágenes propias por servicio cuando existan. |
| Estabilidad visual | Las imágenes de Trabajos no declaran dimensiones HTML; existen estilos que deben evaluarse conjuntamente. | Medir CLS y reservar espacio sin alterar el diseño. No se presume un fallo de CLS por el HTML solamente. |
| Jerarquía | Inicio pasa de H1 a H3 para las tarjetas. | Evaluar H2 para esas categorías conservando sus clases CSS. |

Hay una errata en la descripción de Inicio: “contrucción”. Los títulos de servicios miden entre 64 y 91 caracteres y repiten la marca extensa. Conviene priorizar servicio y ubicación y reducir la parte repetida. No existe una longitud fija que garantice el título mostrado: Google puede recortarlo o elegir otro texto. [Guía de títulos de Google](https://developers.google.com/search/docs/appearance/title-link).

## Datos estructurados: estado y propuesta

**Actualmente no hay marcado Schema.org.** Las etiquetas Open Graph sirven para describir las tarjetas sociales. El bloque `application/json` de Trabajos alimenta la galería y no es JSON-LD semántico para buscadores.

Se propone generar JSON-LD desde PHP utilizando los mismos datos visibles del sitio, sin duplicar manualmente la información:

| Tipo propuesto | Ubicación | Contenido y fuente |
| --- | --- | --- |
| `LocalBusiness` | Inicio y Contacto | Identificador estable `https://arquitectostrabajando.com.mx/#negocio`, nombre comercial, URL, logo, imagen, teléfono, correo y dirección postal. Reutilizar `config.php` y separar los componentes postales verificados. |
| `WebSite` | Inicio | Nombre, URL y referencia al negocio. No declarar buscador interno: no existe. |
| `Service` | Cada detalle | Nombre, descripción, URL, tipo de servicio, área real de atención y referencia al proveedor mediante el mismo `@id`. Reutilizar `datos/servicios.php`. |
| `BreadcrumbList` | Servicios, Trabajos, Contacto y detalles | Lista ordenada coherente con la navegación visible y URLs definitivas. No inventar páginas de categoría que solo existen como anclas. |

Google documenta `LocalBusiness` para comunicar datos del negocio. Antes de añadir horarios, coordenadas, perfiles oficiales o rango de precios, confirmarlos con el despacho. No inventar valoraciones, certificaciones ni reseñas. [Documentación de LocalBusiness](https://developers.google.com/search/docs/appearance/structured-data/local-business).

`Service` describe la prestación, su proveedor y cobertura; no debe presentarse como una promesa de resultado enriquecido. [Definición de Service](https://schema.org/Service). La navegación estructurada se comprobará con las reglas de [BreadcrumbList](https://developers.google.com/search/docs/appearance/structured-data/breadcrumb).

Implementación posterior: función en `includes.php`, salida con `json_encode` y escape seguro para insertar JSON en HTML; exclusión en 404; identificadores coherentes entre páginas. Validar con Schema Markup Validator y, para tipos admitidos por Google, Rich Results Test. Tras publicar, utilizar Inspección de URLs. El marcado no sustituye el contenido ni garantiza una presentación específica en resultados.

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

Revisar, con acceso del propietario, que el Perfil de Empresa de Google tenga nombre, dirección, teléfono, horarios, categoría y URL correctos. Comparar estos datos con Contacto y el futuro JSON-LD. Añadir perfiles oficiales verificados y una presentación del equipo, responsabilidades y acreditaciones demostrables. Solicitar reseñas auténticas de clientes y responderlas; no fabricar testimonios ni calificaciones.

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

Para su publicación posterior, añadir en el `robots.txt` del dominio la línea `Sitemap: https://arquitectostrabajando.com.mx/sitemap.xml` y enviar el mapa en Search Console. Con las reglas actuales habría que permitir expresamente servir `robots.txt`, ya que el ruteador recibe las rutas que no sean recursos previstos. No se creó un robots.txt en esta entrega ni se alteraron directivas de indexación.

### Pruebas de esta entrega

Sintaxis PHP correcta; XML parseable; 23 entradas únicas coincidentes con la tabla de rutas; todos los destinos respondieron 200 localmente; respuesta `application/xml`; HEAD sin cuerpo; 301 de los alias; dominio independiente del encabezado Host.

En un entorno temporal se añadió un servicio al catálogo y el sitemap pasó automáticamente a 24 entradas. Se marcó una ruta como excluida y desapareció correctamente del XML. Los archivos operativos no se modificaron para estas pruebas.

La incorporación de datos estructurados y las mejoras editoriales descritas son propuestas para la siguiente etapa, no cambios ya aplicados. Producción y las cuentas externas permanecen sin modificar.
