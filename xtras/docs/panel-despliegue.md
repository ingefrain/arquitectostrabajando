# Panel de despliegue

Acceso: `/despliegue/` (en XAMPP: `http://localhost/arquitectos/site/despliegue/`). Es una verificación de solo lectura de la instalación que sirve el panel; no consulta otro servidor por FTP ni permite subir archivos.

## Referencia y funcionamiento

`xtras/manifiesto_despliegue.py` centraliza la selección de archivos del paquete, compartida con `xtras/deploy_desarrollo.py`. Incluye PHP de ejecución, vistas, catálogo, recursos, robots, favicon, reglas Apache y el propio panel. Excluye respaldos, accesos FTP, documentación, Git y herramientas locales.

Antes de copiar manualmente la versión local, ejecutar desde la raíz:

```powershell
python -B xtras/manifiesto_despliegue.py
```

Copiar también `datos/despliegue-manifiesto.json`. Regenerarlo tras cualquier cambio en los archivos publicados. Nunca generarlo desde los archivos remotos para validar ese mismo despliegue: se perdería la referencia local. El manifiesto no se incluye a sí mismo en la comparación.

El despliegue automatizado a desarrollo genera el manifiesto en memoria a partir de los bytes que realmente enviará, incluido el añadido de `noindex` en `.htaccess`, y lo sube al final. No es necesario ejecutar el generador antes de usar ese script. La opción manual `--desarrollo` solo debe utilizarse si también se publica la variante de `.htaccess` con ese añadido.

El panel muestra tamaño esperado y real en bytes y los estados Correcto, Faltante, Tamaño diferente y No verificable. Un manifiesto ausente o inválido devuelve 503, nunca un falso resultado correcto. El panel no detecta modificaciones de contenido que conserven el tamaño, archivos adicionales ajenos al manifiesto ni problemas funcionales de PHP o navegación. Las pruebas de funcionamiento siguen siendo necesarias.

## Acceso remoto

En conexiones directas desde `127.0.0.1` o `::1` se permite el acceso local. No se confía en Host ni en X-Forwarded-For. Si se instala detrás de un proxy en loopback, debe restringirse el acceso en el proxy/Apache: no utilizar esa topología con la excepción local sin adaptarla.

En remoto se exige HTTPS y se utiliza la protección HTTP Basic ya configurada en Apache por el propietario. PHP comprueba REMOTE_USER o REDIRECT_REMOTE_USER, valores establecidos por el servidor después de autenticar, y no confía en PHP_AUTH_USER ni en encabezados enviados por el visitante. No se requiere una segunda contraseña ni PANEL_DESPLIEGUE_PASSWORD_HASH. El despliegue conserva intacto despliegue/.htaccess y verifica sus bytes antes y después; este archivo propio del hosting no forma parte del paquete local ni del manifiesto. No se copian ni modifican archivos de contraseñas.

La regla Apache permite exclusivamente este endpoint dentro de `/despliegue`; los archivos internos en `/datos` y `/xtras` siguen bloqueados. Las respuestas del panel incluyen `noindex`, `no-store`, política CSP y protección contra inclusión en marcos.

## Validación local

```powershell
python -B xtras/verificar-panel-despliegue.py
python -B xtras/verificar-seo.py http://localhost/arquitectos/site
C:\xampp\php\php.exe -l despliegue/index.php
C:\xampp\php\php.exe -l datos/verificar-despliegue.php
git diff --check
```

Las pruebas del panel cubren coincidencias, faltantes, diferencias, manifiesto inválido/ausente, rutas que intentan salir de la raíz, autenticación remota y preparación de paquetes local/desarrollo sin conectarse por FTP. Después de publicar quedará comprobar el HTTPS y la autenticación real del alojamiento, además de los tamaños de esa instalación. La sincronización solo se realiza al ejecutar expresamente el script de despliegue autorizado.

Resultado local del 25 de noviembre de 2026: 40 archivos presentes con tamaños coincidentes; todas las pruebas del panel aprobadas. La regresión del sitio aprobó 23 páginas, 38 redirecciones, 8 URLs retiradas con 410 y verificaciones de datos estructurados, navegación, robots, sitemap y 404. Sintaxis PHP de ambos archivos nuevos, sintaxis Python de las tres herramientas y `git diff --check` correctos.


## Sincronización del 25 de noviembre de 2026

Panel trasladado a `/despliegue/`, con entrada `despliegue/index.php` y botón de actualización ajustado. Se sustituyó la autenticación propia por la autenticación Basic de Apache existente. El script conserva y verifica que `despliegue/.htaccess` no cambie.

Se sincronizaron 41 archivos (40 archivos de ejecución y el manifiesto), comprobando su contenido mediante SHA-256 tras la subida. Respaldo previo: `xtras/backups/despliegue-desarrollo-2190cfe3a4ad/remoto-anterior.zip`; comprobante: `resultado.json` en esa carpeta. No hubo escrituras en producción y su página de Inicio conservó el mismo hash.

La comprobación de acceso con las credenciales Basic del propietario queda pendiente: no se solicitaron ni modificaron esas credenciales.

Verificación HTTPS posterior: ambas entradas del panel devuelven 401 con desafío Basic sin autenticación; los archivos internos permanecen privados. Aprobadas las 23 páginas públicas, 38 redirecciones, 8 URLs retiradas, datos estructurados, navegación, robots, sitemap de 23 URLs y respuestas 404. La prueba de independencia del encabezado Host se ejecutó solo en local, pues el hosting selecciona sitios por nombre.

## Corrección de compatibilidad PHP

El servidor remoto informó que str_starts_with no estaba disponible. Se sustituyeron sus usos en datos/verificar-despliegue.php e includes.php por comparaciones con strpos, manteniendo la comprobación de pertenencia a la raíz y el tratamiento de enlaces. La prueba automatizada del panel deshabilita explícitamente las funciones de cadenas de PHP 8 para reproducir esa limitación; no se ha determinado la versión exacta del intérprete remoto. Pasaron las pruebas locales del panel, enlaces editoriales y regresión de las 23 páginas. El intento de inspeccionar la sesión autenticada del navegador integrado falló por timeout del servicio de automatización.

Corrección sincronizada a desarrollo con 41 archivos verificados. Respaldo: xtras/backups/despliegue-desarrollo-4027574898e2/remoto-anterior.zip; comprobante: resultado.json en la misma carpeta. La protección Basic se conservó byte por byte y ambas entradas responden 401 sin autenticación. Sin escrituras en producción y con el mismo hash de su Inicio. Sigue pendiente la comprobación visual de la sesión autenticada porque el navegador integrado agotó el tiempo de espera en dos intentos.

## Prioridad de incidencias

La tabla ordena primero Faltante, después Tamaño diferente, No verificable y finalmente Correcto; cada grupo se ordena por nombre de archivo. Prueba aprobada en una instalación temporal con dos faltantes, un tamaño diferente, un directorio no verificable y un archivo correcto. Se validaron el HTML generado, los tamaños y los cuatro contadores, sin modificar los archivos reales para provocar fallos. La prueba conserva deshabilitadas las funciones de cadenas de PHP 8.
