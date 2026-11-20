/**
 * Count-up animation for stat numbers.
 *
 * Markup: <strong data-count="3000" data-suffix="+">3,000+</strong>
 * The final value stays in the HTML so no-JS visitors and crawlers see it.
 */
(function () {
  var items = document.querySelectorAll('[data-count]');
  if (!items.length) return;

  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduce || !('IntersectionObserver' in window)) return;

  var DURATION = 2200;
  var STAGGER = 180;
  var fmt = new Intl.NumberFormat('en-US');

  // Fast start, long soft landing.
  function easeOutExpo(t) {
    return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
  }

  function render(el, value) {
    el.firstChild.nodeValue = fmt.format(value);
  }

  function prepare(el) {
    var suffix = el.getAttribute('data-suffix') || '';
    el.textContent = '0';
    if (suffix) {
      var s = document.createElement('span');
      s.className = 'count-suffix';
      s.textContent = suffix;
      el.appendChild(s);
    }
    el.classList.add('is-counting');
  }

  function run(el, delay) {
    var target = Number(el.getAttribute('data-count')) || 0;
    var start = null;

    function frame(now) {
      if (start === null) start = now + delay;
      var t = Math.min(1, Math.max(0, (now - start) / DURATION));
      render(el, Math.round(target * easeOutExpo(t)));
      if (t < 1) {
        requestAnimationFrame(frame);
      } else {
        el.classList.add('is-counted');
      }
    }
    requestAnimationFrame(frame);
  }

  items.forEach(prepare);

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (!entry.isIntersecting) return;
      var el = entry.target;
      observer.unobserve(el);
      var siblings = el.closest('ul, ol') ? el.closest('ul, ol').querySelectorAll('[data-count]') : [el];
      var index = Array.prototype.indexOf.call(siblings, el);
      run(el, Math.max(0, index) * STAGGER);
    });
  }, { threshold: 0.4 });

  items.forEach(function (el) { observer.observe(el); });
})();
