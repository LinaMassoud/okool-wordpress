/**
 * Hero actions: scroll up with the page until their bottom edge reaches the
 * floating spot near the bottom of the window, then stay pinned there.
 * Scrolling back up hands them back to the hero bar at the same spot.
 */
(function () {
  var el = document.querySelector('.hero__bar-actions:not([data-pinned])');
  if (!el) return;

  var CLASS = 'is-floating';
  var trigger = 0; // scrollY at which the in-bar spot lines up with the floating spot
  var ticking = false;

  function measure() {
    var wasFloating = el.classList.contains(CLASS);

    // Where the floating spot sits (its bottom, from the top of the window).
    el.classList.add(CLASS);
    var floatBottom = el.getBoundingClientRect().bottom;

    // Where the buttons sit in the hero bar.
    el.classList.remove(CLASS);
    var inBarBottom = el.getBoundingClientRect().bottom + window.scrollY;

    trigger = inBarBottom - floatBottom;
    el.classList.toggle(CLASS, wasFloating);
  }

  function update() {
    ticking = false;
    el.classList.toggle(CLASS, window.scrollY >= trigger);
  }

  function onScroll() {
    if (!ticking) {
      ticking = true;
      requestAnimationFrame(update);
    }
  }

  measure();
  update();
  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', function () { measure(); update(); });
  window.addEventListener('load', function () { measure(); update(); });
})();
