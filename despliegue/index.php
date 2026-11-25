<?php
declare(strict_types=1);

header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-store');
header('X-Robots-Tag: noindex, nofollow');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');
header("Content-Security-Policy: default-src 'none'; style-src 'unsafe-inline'; base-uri 'none'; frame-ancestors 'none'; form-action 'self'");

// Trust the actual connection address, never Host or forwarded visitor headers.
$local = in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1'], true);
if (!$local) {
    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
        http_response_code(403);
        exit('El panel requiere HTTPS.');
    }
    // Apache authenticates users using the hosting's existing Basic protection.
    // PHP_AUTH_USER alone is untrusted: it can come from an unchecked request.
    $authenticatedUser = $_SERVER['REMOTE_USER'] ?? $_SERVER['REDIRECT_REMOTE_USER'] ?? '';
    if (!is_string($authenticatedUser) || $authenticatedUser === '') {
        http_response_code(403);
        exit('Se requiere la autenticación Basic configurada en el servidor.');
    }
}

require dirname(__DIR__) . '/datos/verificar-despliegue.php';
function escape_panel(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
$error = null;
$report = null;
try {
    $report = verificar_despliegue(dirname(__DIR__), dirname(__DIR__) . '/datos/despliegue-manifiesto.json');
} catch (RuntimeException $exception) {
    http_response_code(503);
    $error = $exception->getMessage();
}
$counts = ['Correcto' => 0, 'Faltante' => 0, 'Tamaño diferente' => 0, 'No verificable' => 0];
foreach ($report['rows'] ?? [] as $row) {
    $counts[$row['status']]++;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel de despliegue | Arquitectos Trabajando</title>
  <style>
    *{box-sizing:border-box}body{margin:0;background:#f7f6f2;color:#252525;font:16px/1.5 system-ui,sans-serif}main{max-width:1120px;margin:auto;padding:32px 20px}h1{line-height:1.2}a{color:#a33313}.summary{display:flex;flex-wrap:wrap;gap:12px;margin:24px 0}.summary p{background:white;border:1px solid #ddd;padding:16px;margin:0;flex:1;min-width:180px}.summary strong{display:block;font-size:26px}.table-wrap{overflow-x:auto;background:white}table{border-collapse:collapse;width:100%;text-align:left}th,td{padding:12px;border-bottom:1px solid #ddd}td:first-child{overflow-wrap:anywhere}th{background:#eceae4}.ok{color:#17612e}.issue{color:#9b2816;font-weight:600}.notice{padding:16px;background:#fff;border-left:4px solid #c34820}.muted{color:#555}a.refresh{display:inline-block;padding:10px 18px;background:#b93e1d;color:white;text-decoration:none}caption{text-align:left;padding:12px;font-weight:600}
  </style>
</head>
<body><main>
  <h1>Panel de despliegue</h1>
  <p>Compara los archivos de esta instalación con los tamaños esperados de la copia local.</p>
  <a class="refresh" href="./">Volver a verificar</a>
  <?php if ($error !== null): ?>
    <p class="notice issue" role="alert"><?= escape_panel($error) ?></p>
  <?php else: ?>
    <p class="muted">Manifiesto: <?= escape_panel($report['manifest']['environment']) ?> · Generado: <?= escape_panel($report['manifest']['generated_at']) ?></p>
    <p class="notice"><?= $counts['Correcto'] === count($report['rows']) ? 'Todos los archivos del manifiesto están presentes y coinciden en tamaño.' : 'Se detectaron diferencias. Revise los archivos indicados antes de dar el despliegue por terminado.' ?></p>
    <section class="summary" aria-label="Resumen">
      <?php foreach ($counts as $label => $count): ?><p><strong><?= $count ?></strong><?= escape_panel($label) ?></p><?php endforeach; ?>
    </section>
    <div class="table-wrap"><table>
      <caption><?= count($report['rows']) ?> archivos verificados · Incidencias primero · Tamaños en bytes</caption>
      <thead><tr><th scope="col">Archivo</th><th scope="col">Esperado</th><th scope="col">Servidor</th><th scope="col">Estado</th></tr></thead>
      <tbody><?php foreach ($report['rows'] as $row): ?>
        <tr><td><?= escape_panel($row['file']) ?></td><td><?= $row['expected'] ?></td><td><?= $row['actual'] ?? '—' ?></td><td class="<?= $row['status'] === 'Correcto' ? 'ok' : 'issue' ?>"><?= escape_panel($row['status']) ?></td></tr>
      <?php endforeach; ?></tbody>
    </table></div>
  <?php endif; ?>
  <p class="muted">Solo lectura: este panel no sube ni modifica archivos. La coincidencia de tamaños no garantiza que el contenido sea idéntico. El manifiesto no se compara consigo mismo; no se revisan archivos ajenos al paquete.</p>
</main></body></html>
