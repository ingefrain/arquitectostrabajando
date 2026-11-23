/* Arquitectos Trabajando C+S Estudio · Rediseño 2026
   Galería de trabajos: filtros por tipo y lightbox con navegación. */
(function () {
  'use strict';

  var dataEl = document.getElementById('projects-data');
  if (!dataEl) return;

  var projects = [];
  try {
    projects = JSON.parse(dataEl.textContent);
  } catch (err) {
    return;
  }

  var cards = Array.prototype.slice.call(document.querySelectorAll('.work'));
  var chips = Array.prototype.slice.call(document.querySelectorAll('.chip'));
  var empty = document.querySelector('.works-empty');
  var lightbox = document.getElementById('lightbox');
  if (!lightbox) return;

  var img = lightbox.querySelector('img');
  var titleEl = lightbox.querySelector('.lightbox__title');
  var placeEl = lightbox.querySelector('.lightbox__place');
  var countEl = lightbox.querySelector('.lightbox__count');
  var btnClose = lightbox.querySelector('.lightbox__close');
  var btnPrev = lightbox.querySelector('.lightbox__prev');
  var btnNext = lightbox.querySelector('.lightbox__next');

  var current = null;
  var lastFocus = null;

  /* ---------------------------------------------------------- Filtros */
  chips.forEach(function (chip) {
    chip.addEventListener('click', function () {
      var filter = chip.dataset.filter;

      chips.forEach(function (c) {
        var active = c === chip;
        c.classList.toggle('is-active', active);
        c.setAttribute('aria-pressed', active ? 'true' : 'false');
      });

      var visible = 0;
      cards.forEach(function (card) {
        var types = (card.dataset.types || '').split(/\s+/);
        var show = filter === 'all' || types.indexOf(filter) !== -1;
        card.hidden = !show;
        if (show) visible += 1;
      });

      if (empty) empty.hidden = visible !== 0;
    });
  });

  /* --------------------------------------------------------- Lightbox */
  function render() {
    if (!current) return;
    var project = projects[current.project];
    var photo = project.photos[current.photo];

    img.src = photo.src;
    img.alt = photo.alt;
    titleEl.textContent = project.name;
    placeEl.textContent = project.place;
    countEl.textContent = (current.photo + 1) + ' / ' + project.photos.length;

    var single = project.photos.length < 2;
    btnPrev.hidden = single;
    btnNext.hidden = single;
  }

  function open(projectIndex, photoIndex) {
    if (!projects[projectIndex]) return;
    current = { project: projectIndex, photo: photoIndex || 0 };
    lastFocus = document.activeElement;
    lightbox.hidden = false;
    document.body.classList.add('is-locked');
    render();
    btnClose.focus();
  }

  function close() {
    lightbox.hidden = true;
    document.body.classList.remove('is-locked');
    current = null;
    if (lastFocus && typeof lastFocus.focus === 'function') lastFocus.focus();
  }

  function step(delta) {
    if (!current) return;
    var total = projects[current.project].photos.length;
    current.photo = (current.photo + delta + total) % total;
    render();
  }

  cards.forEach(function (card) {
    card.addEventListener('click', function (event) {
      event.preventDefault();
      open(Number(card.dataset.project), 0);
    });
  });

  btnClose.addEventListener('click', close);
  btnPrev.addEventListener('click', function () { step(-1); });
  btnNext.addEventListener('click', function () { step(1); });

  lightbox.addEventListener('click', function (event) {
    if (event.target === lightbox) close();
  });

  document.addEventListener('keydown', function (event) {
    if (lightbox.hidden) return;
    if (event.key === 'Escape') {
      event.preventDefault();
      close();
    } else if (event.key === 'ArrowLeft') {
      event.preventDefault();
      step(-1);
    } else if (event.key === 'ArrowRight') {
      event.preventDefault();
      step(1);
    }
  });
})();
