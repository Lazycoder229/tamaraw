function initHeroPage() {
  // ── Hero background slideshow ──
  const slides = document.querySelectorAll('.hero-bg');
  if (slides.length) {
    let current = 0;
    if (window.__heroSlideInterval) clearInterval(window.__heroSlideInterval);
    window.__heroSlideInterval = setInterval(() => {
      slides[current].classList.remove('opacity-100');
      slides[current].classList.add('opacity-0');
      current = (current + 1) % slides.length;
      slides[current].classList.remove('opacity-0');
      slides[current].classList.add('opacity-100');
    }, 4000);
  }

  // ── Mobile menu toggle ──
  const menuBtn = document.getElementById('menuBtn');
  const mobileMenu = document.getElementById('mobileMenu');

  if (menuBtn && mobileMenu) {
    const newMenuBtn = menuBtn.cloneNode(true);
    menuBtn.parentNode.replaceChild(newMenuBtn, menuBtn);

    newMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }

  // ── Auto-close mobile menu pag na-click ang isang link sa loob ──
  if (mobileMenu) {
    mobileMenu.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
      });
    });
  }

  // ── Farmer / Buyer hero toggle ──
  const toggleBtns = document.querySelectorAll('.hero-toggle-btn');
  const panels = {
    farmers: document.getElementById('hero-farmers'),
    buyers: document.getElementById('hero-buyers'),
  };

  toggleBtns.forEach(btn => {
    const newBtn = btn.cloneNode(true);
    btn.parentNode.replaceChild(newBtn, btn);

    newBtn.addEventListener('click', () => {
      const target = newBtn.dataset.target;
      Object.keys(panels).forEach(key => {
        panels[key]?.classList.toggle('hidden', key !== target);
      });
      document.querySelectorAll('.hero-toggle-btn').forEach(b => {
        b.classList.remove('bg-forest', 'text-white');
        b.classList.add('border', 'border-white/50', 'text-white');
      });
      newBtn.classList.remove('border', 'border-white/50');
      newBtn.classList.add('bg-forest', 'text-white');
    });
  });

  // ── Category filter ──
  const filterBtns = document.querySelectorAll('.category-filter-btn');
  const productCards = document.querySelectorAll('.product-card');
  const noProductsMsg = document.getElementById('noProductsMsg');

  filterBtns.forEach(btn => {
    const newBtn = btn.cloneNode(true);
    btn.parentNode.replaceChild(newBtn, btn);

    newBtn.addEventListener('click', () => {
      const filter = newBtn.dataset.filter;
      let visibleCount = 0;

      document.querySelectorAll('.category-filter-btn').forEach(b => {
        b.classList.remove('bg-forest', 'text-white');
        b.classList.add('border', 'border-zinc-300', 'text-zinc-600');
      });
      newBtn.classList.remove('border', 'border-zinc-300', 'text-zinc-600');
      newBtn.classList.add('bg-forest', 'text-white');

      productCards.forEach(card => {
        const matches = filter === 'all' || card.dataset.category === filter;
        card.classList.toggle('hidden', !matches);
        if (matches) visibleCount++;
      });

      noProductsMsg?.classList.toggle('hidden', visibleCount > 0);
    });
  });

  // ── Back to Top ──
  const backToTopBtn = document.getElementById('backToTopBtn');
  if (backToTopBtn) {
    const newBtn = backToTopBtn.cloneNode(true);
    backToTopBtn.parentNode.replaceChild(newBtn, backToTopBtn);

    newBtn.addEventListener('click', () => {
      newBtn.classList.add('launching');
      setTimeout(() => newBtn.classList.remove('launching'), 1300);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    window.removeEventListener('scroll', window.__backToTopScroll);
    window.__backToTopScroll = () => {
      const show = window.scrollY > 400;
      newBtn.classList.toggle('opacity-0', !show);
      newBtn.classList.toggle('pointer-events-none', !show);
      newBtn.classList.toggle('opacity-100', show);
    };
    window.addEventListener('scroll', window.__backToTopScroll);
  }
}

// ── Init — DOMContentLoaded safe para sa phone ──
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => initHeroPage());
} else {
  initHeroPage();
}

window.initPage = initHeroPage;
window.addEventListener('smoothnav:after', initHeroPage);