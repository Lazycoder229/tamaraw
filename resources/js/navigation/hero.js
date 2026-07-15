// ── Mobile Nav ────────────────────────────────────────────────────
const mobileNavToggle = document.getElementById('mobile-nav-toggle');
const mobileNav       = document.getElementById('mobile-nav');
const iconOpen        = document.getElementById('icon-open');
const iconClose       = document.getElementById('icon-close');

if (mobileNavToggle) {
  mobileNavToggle.addEventListener('click', () => {
    const isOpen = !mobileNav.classList.contains('hidden');
    mobileNav.classList.toggle('hidden', isOpen);
    iconOpen.classList.toggle('hidden', !isOpen);
    iconClose.classList.toggle('hidden', isOpen);
  });
}

// ── Hero Audience Toggle ───────────────────────────────────────────
const heroToggles  = document.querySelectorAll('.hero-toggle');
const heroFarmers  = document.getElementById('hero-farmers');
const heroBuyers   = document.getElementById('hero-buyers');
const heroPrimary  = document.getElementById('hero-cta-primary');
const heroSecondary = document.getElementById('hero-cta-secondary');

if (heroFarmers) {
  heroToggles.forEach(btn => {
    btn.addEventListener('click', () => {
      const mode = btn.dataset.mode;

      heroToggles.forEach(b => {
        b.classList.toggle('bg-forest',  b.dataset.mode === mode);
        b.classList.toggle('text-cream', b.dataset.mode === mode);
        b.classList.toggle('text-muted-fg', b.dataset.mode !== mode);
      });

      heroFarmers.classList.toggle('hidden', mode !== 'farmers');
      heroBuyers.classList.toggle('hidden',  mode !== 'buyers');

      if (mode === 'farmers') {
        heroPrimary.textContent  = 'List Your Products';
        heroSecondary.textContent = 'See AI Features';
      } else {
        heroPrimary.textContent  = 'Browse the Marketplace';
        heroSecondary.textContent = 'How It Works';
      }

      const arrow = `<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>`;
      heroPrimary.innerHTML = heroPrimary.textContent + ' ' + arrow;
    });
  });
}

// ── Category Filter ────────────────────────────────────────────────
const catButtons   = document.querySelectorAll('.cat-btn');
const productCards = document.querySelectorAll('.product-card');

if (catButtons.length) {
  catButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const cat = btn.dataset.cat;

      catButtons.forEach(b => {
        const active = b.dataset.cat === cat;
        if (active) {
          b.classList.add('bg-forest', 'text-cream', 'border-forest');
          b.classList.remove('bg-transparent', 'text-muted-fg');
        } else {
          b.classList.remove('bg-forest', 'text-cream', 'border-forest');
          b.classList.add('bg-transparent', 'text-muted-fg');
        }
      });

      productCards.forEach(card => {
        const match = cat === 'All' || card.dataset.category === cat;
        card.classList.toggle('hidden', !match);
      });
    });
  });
}

// ── Add to Cart ────────────────────────────────────────────────────
let cartCount     = 0;
const cartBadge   = document.getElementById('cart-badge');
const cartCountEl = document.getElementById('cart-count');

document.querySelectorAll('.add-to-cart').forEach(btn => {
  btn.addEventListener('click', () => {
    cartCount++;
    if (cartCountEl) cartCountEl.textContent = cartCount;
    if (cartBadge)   cartBadge.classList.remove('hidden');

    const original = btn.textContent;
    btn.textContent = 'Added ✓';
    setTimeout(() => { btn.textContent = original; }, 1300);
  });
});

// ── AI Feature Tabs ────────────────────────────────────────────────
const aiTabs     = document.querySelectorAll('.ai-tab');
const aiPanels   = document.querySelectorAll('.ai-panel-content');
const aiHeadline = document.getElementById('ai-headline');
const aiDesc     = document.getElementById('ai-desc');

const aiContent = {
  crop: {
    headline: 'AI-powered planting recommendations',
    desc: 'Get personalized crop suggestions based on your soil type, current season, local weather patterns, and real-time market demand in Oriental Mindoro.',
  },
  market: {
    headline: 'Live market price intelligence',
    desc: 'Track farm-gate and retail prices across Oriental Mindoro markets daily. Know when to sell, when to hold, and how your prices compare to the regional average.',
  },
  weather: {
    headline: 'Weather risk and pest outbreak alerts',
    desc: "Get ahead of typhoons, drought periods, and pest outbreaks with AI-powered early warnings tailored to Baco's microclimate and your specific crops.",
  },
  calendar: {
    headline: 'AI-optimized planting schedule',
    desc: "Your personalized planting calendar syncs market demand cycles with Baco's rainfall patterns, so your harvest lands exactly when buyers need it most.",
  },
};

if (aiTabs.length) {
  aiTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const id = tab.dataset.ai;

      aiTabs.forEach(t => {
        const active = t.dataset.ai === id;
        t.classList.toggle('bg-gold',       active);
        t.classList.toggle('text-ink',      active);
        t.classList.toggle('border-gold',   active);
        t.classList.toggle('text-cream/60', !active);
        t.classList.toggle('border-cream/15', !active);
      });

      aiPanels.forEach(p => p.classList.add('hidden'));
      document.getElementById(`panel-${id}`)?.classList.remove('hidden');

      if (aiHeadline) aiHeadline.textContent = aiContent[id].headline;
      if (aiDesc)     aiDesc.textContent     = aiContent[id].desc;
    });
  });
}

// ── Newsletter ─────────────────────────────────────────────────────
const newsletterSubmit = document.getElementById('newsletter-submit');

if (newsletterSubmit) {
  newsletterSubmit.addEventListener('click', () => {
    const email = document.getElementById('newsletter-email').value.trim();
    if (!email || !email.includes('@')) return;
    document.getElementById('newsletter-form').classList.add('hidden');
    document.getElementById('newsletter-success').classList.remove('hidden');
  });
}