<main id="contenido">
  <div class="wrap home">
    <div class="home-hero">
      <div>
        <p class="eyebrow">Querétaro, México · Colegio de Arquitectos de Querétaro</p>
        <h1>Arquitectura, peritajes, valuación y restauración</h1>
      </div>
      <div class="actions">
        <a class="btn btn-primary" href="<?= e(contact_url()) ?>">Solicitar información <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        <a class="btn btn-ghost" href="<?= e(url('/trabajos')) ?>">Ver trabajos</a>
      </div>
    </div>

    <div class="cat-grid">
      <?php foreach ($catalog['home'] as $card) { render_home_card($card, $catalog); } ?>
    </div>
  </div>
</main>
