<?php
$service = $catalog['services'][$page['slug']];
$category = $catalog['categories'][$service['category']];
?>
<main id="contenido">
  <div class="wrap">
    <nav class="crumbs" aria-label="Ruta de navegación">
      <a href="<?= e(url('/')) ?>">Inicio</a> <span class="sep" aria-hidden="true">/</span>
      <a href="<?= e(url('/servicios')) ?>">Servicios</a> <span class="sep" aria-hidden="true">/</span>
      <a href="<?= e(url('/servicios#' . $service['category'])) ?>"><?= e($category['name']) ?></a> <span class="sep" aria-hidden="true">/</span>
      <span aria-current="page"><?= e($service['name']) ?></span>
    </nav>
    <div class="detail">
      <div>
        <p class="eyebrow"><?= e($service['number'] . ' · ' . $category['name']) ?></p>
        <h1><?= e($service['heading']) ?></h1>
        <p class="lead"><?= e($category['description']) ?></p>
        <figure class="detail__media<?= isset($service['image_caption']) ? ' detail__media--reference' : '' ?>">
          <img src="<?= e(url('/' . $service['image'])) ?>" alt="<?= e($service['alt']) ?>" loading="lazy" decoding="async">
          <?php if (isset($service['image_caption'])): ?><figcaption><?= e($service['image_caption']) ?></figcaption><?php endif; ?>
        </figure>
        <div class="detail__body">
          <?= editorial_html($service['body']) ?>
        </div>
        <div class="actions">
          <a class="btn btn-primary" href="<?= e(contact_url()) ?>">Solicitar información <?php render_arrow(); ?></a>
          <a class="btn btn-ghost" href="<?= e(url('/trabajos')) ?>">Ver trabajos</a>
        </div>
      </div>
      <aside class="side" aria-label="Servicios relacionados">
        <div class="side-card">
          <p class="side-card__head"><?= e($category['number'] . ' · ' . $category['name']) ?></p>
          <ul class="side-list">
            <?php render_service_rows($category['services'], $catalog, $page['slug'], false); ?>
          </ul>
        </div>
        <div class="side-card side-contact">
          <p class="side-card__head">Contacto directo</p>
          <a href="<?= e('tel:' . site_value('phone_href')) ?>"><span class="label">Teléfono</span><span class="value"><?= e(site_value('phone')) ?></span></a>
          <a href="<?= e(contact_url()) ?>"><span class="label">Correo</span><span class="value"><?= e(site_value('email')) ?></span></a>
        </div>
      </aside>
    </div>
  </div>
</main>
