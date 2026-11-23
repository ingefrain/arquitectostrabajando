<main id="contenido">
  <div class="wrap">
    <nav class="crumbs" aria-label="Ruta de navegación">
      <a href="<?= e(url('/')) ?>">Inicio</a> <span class="sep" aria-hidden="true">/</span> <span aria-current="page">Trabajos</span>
    </nav>

    <div class="home-hero gallery-head">
      <div>
        <p class="eyebrow">Portafolio</p>
        <h1>Trabajos</h1>
        <p class="lead">Proyectos y obras del estudio en Querétaro. Educación, vivienda, industria y espacios de trabajo.</p>
      </div>
      <div class="actions">
        <a class="btn btn-ghost" href="<?= e(url('/servicios')) ?>">Ver servicios</a>
      </div>
    </div>

    <div class="filters" role="group" aria-label="Filtrar trabajos por tipo">
        <button class="chip is-active" type="button" data-filter="all" aria-pressed="true">Todos <span>5</span></button>
        <button class="chip" type="button" data-filter="educacion" aria-pressed="false">Educación <span>2</span></button>
        <button class="chip" type="button" data-filter="vivienda" aria-pressed="false">Vivienda <span>1</span></button>
        <button class="chip" type="button" data-filter="industria" aria-pressed="false">Industria <span>1</span></button>
        <button class="chip" type="button" data-filter="comercial" aria-pressed="false">Comercial <span>1</span></button>
    </div>

    <div class="projects" id="proyectos">
        <a class="work" href="<?= e(url('/assets/img/trabajo-escuela-1.jpg')) ?>" data-types="educacion" data-project="0">
          <figure class="work__cover">
            <img src="<?= e(url('/assets/img/trabajo-escuela-1.jpg')) ?>" alt="Patio y edificio escolar de la Escuela Aguazarca" loading="lazy" decoding="async">
            <span class="work__badge">2 fotos</span>
          </figure>
          <div class="work__info">
            <span class="idx">01</span>
            <h2>Escuela Aguazarca</h2>
            <p class="place">Landa de Matamoros, Qro.</p>
          </div>
        </a>
        <a class="work" href="<?= e(url('/assets/img/trabajo-arco-1.jpg')) ?>" data-types="educacion" data-project="1">
          <figure class="work__cover">
            <img src="<?= e(url('/assets/img/trabajo-arco-1.jpg')) ?>" alt="Cubierta metálica del arco techo" loading="lazy" decoding="async">
            <span class="work__badge">2 fotos</span>
          </figure>
          <div class="work__info">
            <span class="idx">02</span>
            <h2>Arco techo</h2>
            <p class="place">Landa de Matamoros, Qro.</p>
          </div>
        </a>
        <a class="work" href="<?= e(url('/assets/img/trabajo-centro-sur.jpg')) ?>" data-types="comercial" data-project="2">
          <figure class="work__cover">
            <img src="<?= e(url('/assets/img/trabajo-centro-sur.jpg')) ?>" alt="Interior y herrería del Edificio Centro Sur" loading="lazy" decoding="async">
            <span class="work__badge">1 foto</span>
          </figure>
          <div class="work__info">
            <span class="idx">03</span>
            <h2>Edificio Centro Sur</h2>
            <p class="place">Querétaro, Qro.</p>
          </div>
        </a>
        <a class="work" href="<?= e(url('/assets/img/trabajo-balvanera.jpg')) ?>" data-types="vivienda" data-project="3">
          <figure class="work__cover">
            <img src="<?= e(url('/assets/img/trabajo-balvanera.jpg')) ?>" alt="Fachada de la Residencia Balvanera" loading="lazy" decoding="async">
            <span class="work__badge">1 foto</span>
          </figure>
          <div class="work__info">
            <span class="idx">04</span>
            <h2>Residencia Balvanera</h2>
            <p class="place">Corregidora, Qro.</p>
          </div>
        </a>
        <a class="work" href="<?= e(url('/assets/img/trabajo-miranda-1.jpg')) ?>" data-types="industria" data-project="4">
          <figure class="work__cover">
            <img src="<?= e(url('/assets/img/trabajo-miranda-1.jpg')) ?>" alt="Fachada de la Bodega Miranda" loading="lazy" decoding="async">
            <span class="work__badge">3 fotos</span>
          </figure>
          <div class="work__info">
            <span class="idx">05</span>
            <h2>Bodega Miranda</h2>
            <p class="place">Querétaro, Qro.</p>
          </div>
        </a>
    </div>

    <p class="works-empty" hidden>No hay trabajos en esta categoría por ahora.</p>

    <script type="application/json" id="projects-data">
<?php
$projects = [[
        'name' => 'Escuela Aguazarca',
        'place' => 'Landa de Matamoros, Qro.',
        'photos' => [[
                'src' => 'assets/img/trabajo-escuela-1.jpg',
                'alt' => 'Patio y edificio escolar de la Escuela Aguazarca',
            ], [
                'src' => 'assets/img/trabajo-escuela-2.jpg',
                'alt' => 'Cancha y accesos de la Escuela Aguazarca',
            ]],
    ], [
        'name' => 'Arco techo',
        'place' => 'Landa de Matamoros, Qro.',
        'photos' => [[
                'src' => 'assets/img/trabajo-arco-1.jpg',
                'alt' => 'Cubierta metálica del arco techo',
            ], [
                'src' => 'assets/img/trabajo-arco-2.jpg',
                'alt' => 'Vista interior de la cubierta metálica',
            ]],
    ], [
        'name' => 'Edificio Centro Sur',
        'place' => 'Querétaro, Qro.',
        'photos' => [[
                'src' => 'assets/img/trabajo-centro-sur.jpg',
                'alt' => 'Interior y herrería del Edificio Centro Sur',
            ]],
    ], [
        'name' => 'Residencia Balvanera',
        'place' => 'Corregidora, Qro.',
        'photos' => [[
                'src' => 'assets/img/trabajo-balvanera.jpg',
                'alt' => 'Fachada de la Residencia Balvanera',
            ]],
    ], [
        'name' => 'Bodega Miranda',
        'place' => 'Querétaro, Qro.',
        'photos' => [[
                'src' => 'assets/img/trabajo-miranda-1.jpg',
                'alt' => 'Fachada de la Bodega Miranda',
            ], [
                'src' => 'assets/img/trabajo-miranda-2.jpg',
                'alt' => 'Nave industrial al interior de la Bodega Miranda',
            ], [
                'src' => 'assets/img/trabajo-miranda-3.jpg',
                'alt' => 'Andador interior de la Bodega Miranda',
            ]],
    ]];
foreach ($projects as &$project) {
    foreach ($project['photos'] as &$photo) { $photo['src'] = url('/' . $photo['src']); }
    unset($photo);
}
unset($project);
echo json_encode($projects, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>
</script>

    <section class="cta">
      <div>
        <h2>¿Tienes un proyecto en mente?</h2>
        <p>Cuéntanos qué necesitas construir, ampliar o regularizar.</p>
      </div>
      <div class="actions" style="margin-top:0">
        <a class="btn btn-primary" href="<?= e(contact_url()) ?>">Solicitar información <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        <a class="btn btn-ghost" href="<?= e('tel:' . site_value('phone_href')) ?>">Llamar · <?= e(site_value('phone')) ?></a>
      </div>
    </section>

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
