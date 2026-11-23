<?php
declare(strict_types=1);

$config = require __DIR__ . '/config.php';
$catalog = require __DIR__ . '/datos/servicios.php';
$routing = require __DIR__ . '/rutas.php';
require __DIR__ . '/includes.php';

// One public endpoint, including when installed in a local subdirectory.
if (PHP_SAPI !== 'cli') {
    $requestPath = explode('?', $_SERVER['REQUEST_URI'] ?? '', 2)[0];
    $endpoint = url('/sitemap.xml');
    if ($requestPath !== $endpoint) {
        header('Location: ' . $endpoint, true, 301);
        exit;
    }
}

header('Content-Type: application/xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($routing['routes'] as $path => $page) {
    // Optional explicit exclusion for future non-indexable routes.
    if (($page['sitemap'] ?? true) === false) {
        continue;
    }
    $location = htmlspecialchars(canonical($path), ENT_XML1 | ENT_QUOTES, 'UTF-8');
    echo '  <url><loc>' . $location . '</loc></url>' . "\n";
}
// No lastmod until real per-page editorial dates are maintained.
echo '</urlset>' . "\n";
