<main id="contenido">
  <div class="wrap">
    <nav class="crumbs" aria-label="Ruta de navegación">
      <a href="<?= e(url('/')) ?>">Inicio</a> <span class="sep" aria-hidden="true">/</span> <span aria-current="page">Servicios</span>
    </nav>

    <div class="home-hero">
      <div>
        <p class="eyebrow">Querétaro, México · Servicios</p>
        <h1>Servicios de arquitectura, peritaje y construcción</h1>
        <p class="lead">DRO y peritajes, proyecto arquitectónico y ejecución de obra, además de presupuestos, planos y levantamientos topográficos.</p>
      </div>
      <div class="actions">
        <a class="btn btn-primary" href="<?= e(contact_url()) ?>">Solicitar información
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
      </div>
    </div>

    <?php render_catalog($catalog); ?>
    <section class="cta">
      <div>
        <h2>¿Tienes un proyecto o necesitas un dictamen?</h2>
        <p>Llámanos, escríbenos o solicita una visita al sitio.</p>
      </div>
      <div class="actions" style="margin-top:0">
        <a class="btn btn-primary" href="<?= e(contact_url()) ?>">Solicitar información <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        <a class="btn btn-ghost" href="<?= e('tel:' . site_value('phone_href')) ?>">Llamar · <?= e(site_value('phone')) ?></a>
      </div>
    </section>

  </div>
</main>
