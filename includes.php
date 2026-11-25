<?php
declare(strict_types=1);

function site_value(string $key): string { global $config; return $config[$key]; }
function contact_url(): string { return 'mailto:' . site_value('email') . '?subject=Solicitud%20de%20informaci%C3%B3n'; }
function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
function render_arrow(): void {
    echo '<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>';
}
function render_service_rows(array $slugs, array $catalog, ?string $active = null, bool $arrows = true): void {
    foreach ($slugs as $slug) {
        $service = $catalog['services'][$slug];
        echo '<li><a href="' . e(url($service['path'])) . '"' . ($slug === $active ? ' aria-current="page"' : '') . '>';
        echo '<span class="n">' . e($service['number']) . '</span><span>' . e($service['name']) . '</span>';
        if ($arrows) { echo '<span class="arrow">'; render_arrow(); echo '</span>'; }
        echo '</a></li>';
    }
}
function render_home_card(array $card, array $catalog): void {
    $category = $catalog['categories'][$card['category']];
?>
      <article class="cat-card">
        <div class="cat-card__media">
          <img src="<?= e(url('/' . $card['image'])) ?>" alt="<?= e($card['alt']) ?>" loading="lazy" decoding="async">
          <span class="cat-card__num"><?= e($category['number']) ?></span>
        </div>
        <div class="cat-card__body">
          <div class="cat-card__heading">
            <h3 class="cat-card__title"><?= e($card['title']) ?></h3>
            <p class="cat-card__desc"><?= e($category['description']) ?></p>
          </div>
          <ul class="cat-list">
            <?php render_service_rows($card['services'], $catalog); ?>
          </ul>
        </div>
      </article>
<?php
}
function render_catalog(array $catalog): void {
    foreach ($catalog['categories'] as $key => $category):
?>
    <section class="section" id="<?= e($key) ?>">
      <?php if ($key === 'restauracion'): ?><span id="construccion" aria-hidden="true"></span><?php endif; ?>
      <div class="cat-index">
        <div class="cat-index__head">
          <p class="eyebrow"><?= e($category['number'] . ' · ' . $category['name']) ?></p>
          <h2><?= e($category['description']) ?></h2>
        </div>
        <ul class="cat-list">
          <?php render_service_rows($category['services'], $catalog); ?>
        </ul>
      </div>
    </section>
<?php
    endforeach;
}
function url(string $path = '/'): string { global $config; return $config['base_path'] . '/' . ltrim($path, '/'); }
function canonical(string $path): string { global $config; return $config['canonical_origin'] . $config['canonical_base'] . $path; }
function nav_current(string $section, array $page): string {
    if ($page['section'] !== $section) return '';
    return $page['view'] === 'servicio' ? ' aria-current="location"' : ' aria-current="page"';
}
// Only trusted, repository-owned editorial HTML reaches this function.
function editorial_html(string $html): string {
    return preg_replace_callback('~(href|src)="([^"]*)"~', static function (array $m): string {
        $path = strpos($m[2], '/') === 0 && strpos($m[2], '//') !== 0 ? $m[2] : null;
        if ($path === null && strpos($m[2], 'assets/') === 0) $path = '/' . $m[2];
        if ($path === null) return $m[0];
        return $m[1] . '="' . e(url($path)) . '"';
    }, $html);
}

function structured_data(array $page): array {
    global $config, $catalog;
    if (in_array($page['view'], ['404', '410'], true) || http_response_code() >= 400) {
        return [];
    }

    $businessId = canonical('/#negocio');
    $graph = [];
    if (in_array($page['view'], ['inicio', 'contacto'], true)) {
        $address = $config['address_parts'];
        $graph[] = [
            '@type' => 'LocalBusiness',
            '@id' => $businessId,
            'name' => $config['business_name'],
            'url' => canonical('/'),
            'telephone' => $config['phone_href'],
            'email' => $config['email'],
            'logo' => canonical($config['logo_path']),
            'image' => canonical($config['social_image_path']),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $address['street'] . ', ' . $address['district'],
                'addressLocality' => $address['municipality'],
                'addressRegion' => $address['state'],
                'addressCountry' => $address['country'],
            ],
        ];
    }
    if ($page['view'] === 'inicio') {
        $graph[] = [
            '@type' => 'WebSite',
            '@id' => canonical('/#sitio'),
            'url' => canonical('/'),
            'name' => $config['business_name'],
            'publisher' => ['@id' => $businessId],
        ];
    }
    if ($page['view'] === 'servicio') {
        $service = $catalog['services'][$page['slug']];
        $graph[] = [
            '@type' => 'Service',
            '@id' => canonical($service['path']) . '#servicio',
            'name' => $service['heading'],
            'description' => $service['description'],
            'url' => canonical($service['path']),
            'provider' => ['@id' => $businessId],
            // Published coverage is Querétaro; do not infer a national service area.
            'areaServed' => $config['address_parts']['state'],
        ];
    }

    $labels = ['servicios' => 'Servicios', 'trabajos' => 'Trabajos', 'contacto' => 'Contacto'];
    if (isset($labels[$page['view']]) || $page['view'] === 'servicio') {
        $items = [['@type' => 'ListItem', 'position' => 1, 'name' => 'Inicio', 'item' => canonical('/')]];
        if ($page['view'] === 'servicio') {
            $items[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Servicios', 'item' => canonical('/servicios')];
        }
        $items[] = [
            '@type' => 'ListItem',
            'position' => count($items) + 1,
            'name' => $page['view'] === 'servicio' ? $service['name'] : $labels[$page['view']],
            'item' => canonical($page['path']),
        ];
        $graph[] = ['@type' => 'BreadcrumbList', '@id' => canonical($page['path']) . '#breadcrumbs', 'itemListElement' => $items];
    }
    return $graph === [] ? [] : ['@context' => 'https://schema.org', '@graph' => $graph];
}

function render_structured_data(array $page): void {
    $data = structured_data($page);
    if ($data === []) {
        return;
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_THROW_ON_ERROR);
    echo '<script type="application/ld+json">' . $json . '</script>' . "\n";
}

function render_head(array $page): void {
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page['title']) ?></title>
<meta name="description" content="<?= e($page['description']) ?>">
<meta name="theme-color" content="#24221F">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= e(site_value('business_name')) ?>">
<meta property="og:locale" content="es_MX">
<meta property="og:title" content="<?= e($page['title']) ?>">
<meta property="og:description" content="<?= e($page['description']) ?>">
<meta property="og:url" content="<?= e(canonical($page['path'])) ?>">
<meta property="og:image" content="<?= e(canonical(site_value('social_image_path'))) ?>">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="630">
<meta property="og:image:height" content="633">
<meta property="og:image:alt" content="Logotipo de <?= e(site_value('business_name')) ?>">
<link rel="canonical" href="<?= e(canonical($page['path'])) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@500;600;700&family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@400;500;600&display=swap">
<link rel="stylesheet" href="<?= e(url('/assets/site.css')) ?>">
<link rel="icon" type="image/vnd.microsoft.icon" href="<?= e(url('/favicon.ico')) ?>">
<link rel="image_src" href="<?= e(canonical(site_value('social_image_path'))) ?>">
<?php if ($page['section'] === 'trabajos'): ?><script src="<?= e(url('/assets/site.js')) ?>" defer></script><?php endif; ?>
<?php if (http_response_code() >= 400): ?><meta name="robots" content="noindex"><?php endif; ?>
<?php render_structured_data($page); ?>
</head>
<body>
<a class="skip" href="#contenido">Saltar al contenido</a>


<?php
}

function render_header(array $page): void {
?>
<header class="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="<?= e(url('/')) ?>" aria-label="<?= e(site_value('business_name')) ?> — Inicio">
      <img src="<?= e(url(site_value('logo_path'))) ?>" alt="<?= e(site_value('business_name')) ?>" width="230" height="42">
    </a>
    <nav class="nav" aria-label="Navegación principal">
      <a href="<?= e(url('/')) ?>"<?= nav_current('inicio', $page) ?>>Inicio</a>
      <a href="<?= e(url('/trabajos')) ?>"<?= nav_current('trabajos', $page) ?>>Trabajos</a>
      <a href="<?= e(url('/contacto')) ?>"<?= nav_current('contacto', $page) ?>>Contacto</a>
    </nav>
  </div>
</header>
<?php
}

function render_footer(array $page): void {
?>
<footer class="site-footer">
  <div class="wrap">
    <div class="footer-top">
      <div class="footer-brand">
        <img src="<?= e(url(site_value('logo_path'))) ?>" alt="<?= e(site_value('business_name')) ?>" width="240" height="44">
        <p>Arquitectura, peritajes, valuación y restauración en Querétaro. DRO, proyecto arquitectónico y ejecución de obra.</p>
      </div>
      <div class="footer-col">
        <h3>Servicios</h3>
        <ul>
        <li><a href="<?= e(url('/servicios#perito')) ?>">DRO / PERITO</a></li>
        <li><a href="<?= e(url('/servicios#proyecto')) ?>">Proyecto arquitectónico</a></li>
        <li><a href="<?= e(url('/servicios#restauracion')) ?>">Restauración</a></li>
        <li><a href="<?= e(url('/servicios#complementarios')) ?>">Servicios complementarios</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h3>Sitio</h3>
        <ul>
        <li><a href="<?= e(url('/')) ?>">Inicio</a></li>
        <li><a href="<?= e(url('/servicios')) ?>">Servicios</a></li>
        <li><a href="<?= e(url('/trabajos')) ?>">Trabajos</a></li>
        <li><a href="<?= e(url('/contacto')) ?>">Contacto</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h3>Contacto</h3>
        <p><a href="<?= e('tel:' . site_value('phone_href')) ?>"><?= e(site_value('phone')) ?></a></p>
        <p><a href="<?= e('mailto:' . site_value('email')) ?>"><?= e(site_value('email')) ?></a></p>
        <p><?= e(site_value('address')) ?><br><?= e(site_value('locality')) ?></p>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 <?= e(site_value('business_name')) ?></span>
      <span>Querétaro, México · <a href="//efra.biz" rel="noopener">Desarrollado por Efra</a></span>
    </div>
  </div>
</footer>

</body>
</html>

<?php
}
