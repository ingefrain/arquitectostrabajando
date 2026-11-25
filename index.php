<?php
declare(strict_types=1);

$config = require __DIR__ . '/config.php';
$catalog = require __DIR__ . '/datos/servicios.php';
$routing = require __DIR__ . '/rutas.php';
require __DIR__ . '/includes.php';

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$rawPath = explode('?', $uri, 2)[0];
$base = $config['base_path'];
$relative = $base === '' ? $rawPath : substr($rawPath, strlen($base));
$path = rawurldecode($relative);
// No traversal, control characters or filesystem paths are accepted as routes.
$validPath = !preg_match('~[\x00-\x20\x7f\\\\]|(?:^|/)\.{1,2}(?:/|$)~', $path);
$normalized = '/' . trim($path, '/');
$destination = $routing['legacy'][$normalized] ?? $normalized;
$page = $validPath ? ($routing['routes'][$destination] ?? null) : null;

if ($page !== null && $relative !== $destination) {
    $query = explode('?', $uri, 2)[1] ?? '';
    header('Location: ' . url($destination) . ($query !== '' ? '?' . $query : ''), true, 301);
    exit;
}
if ($validPath && in_array($normalized, $routing['retired'], true)) {
    http_response_code(410);
    $page = [
        'view' => '410', 'section' => '', 'path' => $normalized,
        'title' => 'Contenido retirado | Arquitectos Trabajando C+S Estudio',
        'description' => 'Esta página fue retirada del catálogo. Consulta los servicios actuales de Arquitectos Trabajando.',
    ];
} elseif ($page === null) {
    http_response_code(404);
    $page = [
        'view' => '404', 'section' => '', 'path' => $normalized,
        'title' => 'Página no encontrada | Arquitectos Trabajando C+S Estudio',
        'description' => 'La página solicitada no está disponible. Consulta nuestros servicios o regresa al inicio.',
    ];
} else {
    http_response_code(200);
    $page['path'] = $destination;
}
header('Content-Type: text/html; charset=UTF-8');
render_head($page);
render_header($page);
// The filename comes only from our closed route table, never from the request.
require __DIR__ . '/vistas/' . $page['view'] . '.php';
render_footer($page);
