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
          <h3 class="cat-card__title"><?= e($card['title']) ?></h3>
          <p class="cat-card__desc"><?= e($category['description']) ?></p>
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
        $path = str_starts_with($m[2], '/') && !str_starts_with($m[2], '//') ? $m[2] : null;
        if ($path === null && str_starts_with($m[2], 'assets/')) $path = '/' . $m[2];
        if ($path === null) return $m[0];
        return $m[1] . '="' . e(url($path)) . '"';
    }, $html);
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
<meta property="og:site_name" content="Arquitectos Trabajando C+S Estudio">
<meta property="og:locale" content="es_MX">
<meta property="og:title" content="<?= e($page['title']) ?>">
<meta property="og:description" content="<?= e($page['description']) ?>">
<meta property="og:url" content="<?= e(canonical($page['path'])) ?>">
<meta property="og:image" content="<?= e(canonical('/assets/logo-og.jpg')) ?>">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="630">
<meta property="og:image:height" content="633">
<meta property="og:image:alt" content="Logotipo de Arquitectos Trabajando C+S Estudio">
<link rel="canonical" href="<?= e(canonical($page['path'])) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@500;600;700&family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@400;500;600&display=swap">
<link rel="stylesheet" href="<?= e(url('/assets/site.css')) ?>">
<link rel="icon" type="image/vnd.microsoft.icon" href="<?= e(url('/favicon.ico')) ?>">
<link rel="image_src" href="<?= e(canonical('/assets/logo-og.jpg')) ?>">
<?php if ($page['section'] === 'trabajos'): ?><script src="<?= e(url('/assets/site.js')) ?>" defer></script><?php endif; ?>
<?php if (http_response_code() === 404): ?><meta name="robots" content="noindex"><?php endif; ?>
</head>
<body>
<a class="skip" href="#contenido">Saltar al contenido</a>


<?php
}

function render_header(array $page): void {
?>
<header class="site-header">
  <div class="wrap header-inner">
    <a class="brand" href="<?= e(url('/')) ?>" aria-label="Arquitectos Trabajando C+S Estudio — Inicio">
      <img src="<?= e(url('/assets/logo-at.png')) ?>" alt="Arquitectos Trabajando C+S Estudio" width="230" height="42">
    </a>
    <nav class="nav" aria-label="Navegación principal">
      <a href="<?= e(url('/')) ?>"<?= nav_current('inicio', $page) ?>>Inicio</a>
      <a href="<?= e(url('/servicios')) ?>"<?= nav_current('servicios', $page) ?>>Servicios</a>
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
        <img src="<?= e(url('/assets/logo-at.png')) ?>" alt="Arquitectos Trabajando C+S Estudio" width="240" height="44">
        <p>Arquitectura, peritajes, valuación y restauración en Querétaro. DRO, proyecto arquitectónico y ejecución de obra.</p>
      </div>
      <div class="footer-col">
        <h3>Servicios</h3>
        <ul>
        <li><a href="<?= e(url('/servicios#perito')) ?>">DRO / PERITO</a></li>
        <li><a href="<?= e(url('/servicios#proyecto')) ?>">Proyecto arquitectónico</a></li>
        <li><a href="<?= e(url('/servicios#construccion')) ?>">Construcción</a></li>
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
      <span>© 2026 Arquitectos Trabajando C+S Estudio</span>
      <span>Querétaro, México · <a href="//efra.biz" rel="noopener">Desarrollado por Efra</a></span>
    </div>
  </div>
</footer>

</body>
</html>

<?php
}
