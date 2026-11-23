<main id="contenido">
  <div class="wrap">
    <nav class="crumbs" aria-label="Ruta de navegación">
      <a href="<?= e(url('/')) ?>">Inicio</a> <span class="sep" aria-hidden="true">/</span> <span aria-current="page">Contacto</span>
    </nav>

    <p class="eyebrow">Despacho de arquitectos · Querétaro, México</p>
    <h1>Contacto</h1>
    <p class="lead">Escríbenos o visítanos en la oficina. Atendemos proyectos, dictámenes y trámites en Querétaro y la región.</p>

    <div class="contact-grid">
      <div class="info-block">
        <div class="info-row">
          <svg class="ico" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11Z" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.6"/></svg>
          <div>
            <span class="k">Dirección</span>
            <span class="v"><?= e(site_value('address')) ?><br><?= e(site_value('locality')) ?></span>
          </div>
        </div>
        <div class="info-row">
          <svg class="ico" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6.5 3.5 9 8l-2 2c1.2 3 3 4.8 6 6l2-2 4.5 2.5V20c0 1-1 1.7-2 1.5C9.5 20 4 14.5 3 6.5 2.8 5.5 3.5 4.5 4.5 4.5h2Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
          <div>
            <span class="k">Teléfono</span>
            <a class="v" href="<?= e('tel:' . site_value('phone_href')) ?>"><?= e(site_value('phone')) ?></a>
          </div>
        </div>
        <div class="info-row">
          <svg class="ico" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
          <div>
            <span class="k">Correo</span>
            <a class="v" href="<?= e(contact_url()) ?>"><?= e(site_value('email')) ?></a>
          </div>
        </div>
      </div>

      <div class="map-card">
        <h2>Cómo llegar</h2>
        <p><?= e(site_value('address')) ?><br><?= e(site_value('locality')) ?></p>
        <a class="btn btn-primary btn-sm" href="<?= e(site_value('maps_url')) ?>" target="_blank" rel="noopener">Abrir en Google Maps</a>
        <p style="font-family:var(--mono);font-size:10.5px;letter-spacing:.1em;text-transform:uppercase;color:var(--ink-muted)">Querétaro, México</p>
      </div>
    </div>

    <section class="cta">
      <div>
        <h2>¿Tienes un proyecto o necesitas un dictamen?</h2>
        <p>Envíanos los datos de tu proyecto y te contactamos.</p>
      </div>
      <div class="actions" style="margin-top:0">
        <a class="btn btn-primary" href="<?= e(contact_url()) ?>">Enviar correo <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        <a class="btn btn-ghost" href="<?= e('tel:' . site_value('phone_href')) ?>">Llamar · <?= e(site_value('phone')) ?></a>
      </div>
    </section>
  </div>
</main>
