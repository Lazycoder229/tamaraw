// resources/js/navigation/products.js
import { Cart } from '../cart.js';

// ── State ─────────────────────────────────────────────────────────
let activeCategory = 'All';
let searchTerm     = '';
let priceMin       = null;
let priceMax       = null;
let certifiedOnly  = false;
let activeBrgy     = [];

// ── Helpers ───────────────────────────────────────────────────────
const allCards     = () => [...document.querySelectorAll('.product-card')];
const noResults    = document.getElementById('no-results');
const resultsCount = document.getElementById('results-count');
const showingCount = document.getElementById('showing-count');

function applyFilters() {
  let visible = 0;
  allCards().forEach(card => {
    const show =
      (activeCategory === 'All' || card.dataset.category === activeCategory) &&
      (!searchTerm || card.dataset.name.includes(searchTerm) || card.dataset.farm.includes(searchTerm)) &&
      (priceMin === null || parseFloat(card.dataset.price) >= priceMin) &&
      (priceMax === null || parseFloat(card.dataset.price) <= priceMax) &&
      (!certifiedOnly || card.dataset.certified === 'true') &&
      (activeBrgy.length === 0 || activeBrgy.includes(card.dataset.barangay));

    card.classList.toggle('hidden', !show);
    if (show) visible++;
  });

  if (resultsCount) resultsCount.textContent = visible;
  if (showingCount) showingCount.textContent  = visible;
  if (noResults)    noResults.classList.toggle('hidden', visible > 0);
  document.getElementById('product-grid')?.classList.toggle('hidden', visible === 0);
}

// ── Category ──────────────────────────────────────────────────────
document.querySelectorAll('.cat-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    activeCategory = btn.dataset.cat;
    document.querySelectorAll('.cat-btn').forEach(b => {
      const active = b.dataset.cat === activeCategory;
      b.classList.toggle('bg-forest',     active);
      b.classList.toggle('text-cream',    active);
      b.classList.toggle('border-forest', active);
      b.classList.toggle('text-muted-fg', !active);
      b.classList.remove('text-ink');
    });
    applyFilters();
  });
});

// ── Search ────────────────────────────────────────────────────────
document.getElementById('search-input')?.addEventListener('input', e => {
  searchTerm = e.target.value.toLowerCase().trim();
  applyFilters();
});

// ── Price ─────────────────────────────────────────────────────────
document.getElementById('apply-price')?.addEventListener('click', () => {
  priceMin = document.getElementById('price-min').value ? parseFloat(document.getElementById('price-min').value) : null;
  priceMax = document.getElementById('price-max').value ? parseFloat(document.getElementById('price-max').value) : null;
  applyFilters();
});

// ── Certified ─────────────────────────────────────────────────────
document.getElementById('certified-filter')?.addEventListener('change', e => {
  certifiedOnly = e.target.checked;
  applyFilters();
});

// ── Barangay ──────────────────────────────────────────────────────
document.querySelectorAll('.brgy-filter').forEach(cb => {
  cb.addEventListener('change', () => {
    activeBrgy = [...document.querySelectorAll('.brgy-filter:checked')]
      .map(c => c.dataset.brgy)
      .filter(b => b !== 'All Barangays');
    applyFilters();
  });
});

// ── Sort ──────────────────────────────────────────────────────────
document.getElementById('sort-select')?.addEventListener('change', e => {
  const grid  = document.getElementById('product-grid');
  const cards = allCards();
  cards.sort((a, b) => {
    switch (e.target.value) {
      case 'price-asc':  return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
      case 'price-desc': return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
      case 'stock':      return parseInt(b.dataset.stock ?? 0) - parseInt(a.dataset.stock ?? 0);
      case 'name':       return a.dataset.name.localeCompare(b.dataset.name);
      default:           return 0;
    }
  });
  cards.forEach(card => grid.appendChild(card));
});

// ── Clear Filters ─────────────────────────────────────────────────
function clearAllFilters() {
  activeCategory = 'All'; searchTerm = ''; priceMin = null; priceMax = null;
  certifiedOnly = false; activeBrgy = [];
  const si = document.getElementById('search-input');
  if (si) si.value = '';
  const pmn = document.getElementById('price-min');
  if (pmn) pmn.value = '';
  const pmx = document.getElementById('price-max');
  if (pmx) pmx.value = '';
  const cf = document.getElementById('certified-filter');
  if (cf) cf.checked = false;
  document.querySelectorAll('.brgy-filter').forEach(cb => cb.checked = cb.dataset.brgy === 'All Barangays');
  document.querySelectorAll('.cat-btn').forEach(b => {
    const active = b.dataset.cat === 'All';
    b.classList.toggle('bg-forest', active);
    b.classList.toggle('text-cream', active);
    b.classList.toggle('border-forest', active);
    b.classList.toggle('text-muted-fg', !active);
  });
  applyFilters();
}
document.getElementById('clear-filters')?.addEventListener('click', clearAllFilters);
document.getElementById('reset-from-empty')?.addEventListener('click', clearAllFilters);


// ══════════════════════════════════════════════════════════════════
// ── ADD TO CART MODAL (2-STEP) ────────────────────────────────────
// ══════════════════════════════════════════════════════════════════
const modalCart     = document.getElementById('modal-cart');
const mcImg         = document.getElementById('mc-img');
const mcCategory    = document.getElementById('mc-category');
const mcName        = document.getElementById('mc-name');
const mcFarm        = document.getElementById('mc-farm');
const mcDescription = document.getElementById('mc-description');
const mcVerifiedTag = document.getElementById('mc-verified-badge');
const mcPrice       = document.getElementById('mc-price');
const mcUnit        = document.getElementById('mc-unit');
const mcStock       = document.getElementById('mc-stock');
const mcMinOrder    = document.getElementById('mc-min-order');
const mcSubtotal    = document.getElementById('mc-subtotal');
const mcDiscountLine= document.getElementById('mc-discount-line');
const mcQtyInput    = document.getElementById('mc-qty');
const mcBulkNote    = document.getElementById('mc-bulk-note');

const modalSteps    = document.getElementById('modal-steps');
const stepTab1      = document.getElementById('step-tab-1');
const stepTab2      = document.getElementById('step-tab-2');

const DELIVERY_FEE     = 50;
const FREE_DELIVERY_AT = 500;
const BULK_DISCOUNT    = 0.10;

let currentProduct = null;  // card dataset of the active product
let orderType      = 'retail';
let promoDiscount  = 0;     // flat peso amount taken off via promo

function getItemSubtotal() {
  const qty   = parseInt(mcQtyInput?.value) || 0;
  const price = parseFloat(currentProduct?.price) || 0;
  return qty * price;
}

function getDiscountedSubtotal() {
  const sub = getItemSubtotal();
  return orderType === 'bulk' ? sub * (1 - BULK_DISCOUNT) : sub;
}

function updateSubtotal() {
  const sub = getDiscountedSubtotal();
  mcSubtotal.textContent = '₱' + sub.toFixed(2);
  mcDiscountLine?.classList.toggle('hidden', orderType !== 'bulk');
}

function openCartModal(card) {
  currentProduct = card.dataset;
  orderType      = 'retail';
  promoDiscount  = 0;

  // Populate step 1
  mcImg.src              = card.dataset.img;
  mcImg.alt              = card.dataset.name;
  mcCategory.textContent = card.dataset.category;
  mcName.textContent     = card.querySelector('h3').textContent;
  mcFarm.textContent     = card.dataset.contactName;
  if (mcDescription) mcDescription.textContent = card.dataset.description || 'No description provided by the farm yet.';
  mcVerifiedTag?.classList.toggle('hidden', card.dataset.certified !== 'true');
  mcPrice.textContent    = card.dataset.price;
  mcUnit.textContent     = card.dataset.unit;
  mcStock.textContent    = card.dataset.stock;
  mcMinOrder.textContent = card.dataset.minOrder;
  mcQtyInput.value       = 1;
  mcBulkNote.classList.add('hidden');
  mcDiscountLine?.classList.add('hidden');

  // Reset order type buttons
  setOrderTypeButtons('retail');

  // Reset step 2 fields
  const promoInput = document.getElementById('promo-input');
  if (promoInput) promoInput.value = '';
  document.getElementById('promo-msg')?.classList.add('hidden');
  document.getElementById('rv-promo-row')?.classList.add('hidden');

  updateSubtotal();
  goToStep(1);

  modalCart.classList.remove('hidden');
  modalCart.classList.add('flex');
  document.body.style.overflow = 'hidden';
}

function closeCartModal() {
  modalCart.classList.add('hidden');
  modalCart.classList.remove('flex');
  document.body.style.overflow = '';
}

function setOrderTypeButtons(type) {
  orderType = type;
  document.getElementById('btn-retail').className =
    type === 'retail'
      ? 'order-type-btn px-4 py-2.5 text-xs font-semibold border transition-all bg-forest text-cream border-forest'
      : 'order-type-btn px-4 py-2.5 text-xs font-semibold border transition-all text-ink border-ink/25 hover:border-forest hover:text-forest';
  document.getElementById('btn-bulk').className =
    type === 'bulk'
      ? 'order-type-btn px-4 py-2.5 text-xs font-semibold border transition-all bg-forest text-cream border-forest'
      : 'order-type-btn px-4 py-2.5 text-xs font-semibold border transition-all text-ink border-ink/25 hover:border-forest hover:text-forest';
  mcBulkNote.classList.toggle('hidden', type !== 'bulk');
  updateSubtotal();
}

// Order type toggle
document.querySelectorAll('.order-type-btn').forEach(btn => {
  btn.addEventListener('click', () => setOrderTypeButtons(btn.dataset.type));
});

// Qty controls
document.getElementById('mc-qty-minus')?.addEventListener('click', () => {
  mcQtyInput.value = Math.max(1, parseInt(mcQtyInput.value) - 1);
  updateSubtotal();
});
document.getElementById('mc-qty-plus')?.addEventListener('click', () => {
  mcQtyInput.value = parseInt(mcQtyInput.value) + 1;
  updateSubtotal();
});
mcQtyInput?.addEventListener('input', updateSubtotal);

// ── Step navigation ─────────────────────────────────────────────
function goToStep(step) {
  modalSteps.style.transform = step === 2 ? 'translateX(-50%)' : 'translateX(0)';

  stepTab1.classList.toggle('border-forest', step === 1);
  stepTab1.classList.toggle('text-forest',   step === 1);
  stepTab1.classList.toggle('border-transparent', step !== 1);
  stepTab1.classList.toggle('text-muted-fg', step !== 1);

  stepTab2.classList.toggle('border-forest', step === 2);
  stepTab2.classList.toggle('text-forest',   step === 2);
  stepTab2.classList.toggle('border-transparent', step !== 2);
  stepTab2.classList.toggle('text-muted-fg', step !== 2);

  if (step === 2) populateReview();
}

document.getElementById('mc-next')?.addEventListener('click', () => goToStep(2));
document.getElementById('mc-back')?.addEventListener('click', () => goToStep(1));

function getDeliveryFee(subtotalAfterDiscount) {
  return subtotalAfterDiscount >= FREE_DELIVERY_AT ? 0 : DELIVERY_FEE;
}

function populateReview() {
  const qty          = parseInt(mcQtyInput.value) || 0;
  const rawSubtotal   = getItemSubtotal();
  const bulkSubtotal  = getDiscountedSubtotal();
  const bulkAmountOff = rawSubtotal - bulkSubtotal;
  const delivery      = getDeliveryFee(bulkSubtotal);
  const total         = Math.max(0, bulkSubtotal - promoDiscount) + delivery;

  document.getElementById('rv-img').src          = currentProduct.img;
  document.getElementById('rv-name').textContent = mcName.textContent;
  document.getElementById('rv-farm').textContent = currentProduct.contactName;
  document.getElementById('rv-qty-label').textContent  = `${qty} ${currentProduct.unit || 'kg'}`;
  document.getElementById('rv-item-total').textContent = '₱' + rawSubtotal.toFixed(2);

  document.getElementById('rv-subtotal').textContent = '₱' + rawSubtotal.toFixed(2);

  const discountRow = document.getElementById('rv-discount-row');
  if (orderType === 'bulk') {
    discountRow?.classList.remove('hidden');
    document.getElementById('rv-discount-amt').textContent = '-₱' + bulkAmountOff.toFixed(2);
  } else {
    discountRow?.classList.add('hidden');
  }

  document.getElementById('rv-delivery').textContent =
    delivery === 0 ? 'FREE' : '₱' + delivery.toFixed(2);

  const promoRow = document.getElementById('rv-promo-row');
  if (promoDiscount > 0) {
    promoRow?.classList.remove('hidden');
    document.getElementById('rv-promo-amt').textContent = '-₱' + promoDiscount.toFixed(2);
  } else {
    promoRow?.classList.add('hidden');
  }

  document.getElementById('rv-total').textContent = '₱' + total.toFixed(2);
}

// ── Promo code ────────────────────────────────────────────────────
const KNOWN_PROMOS = {
  BACO10: 10,
  BACOFARM: 25,
};

document.getElementById('promo-apply')?.addEventListener('click', () => {
  const input = document.getElementById('promo-input');
  const msg   = document.getElementById('promo-msg');
  const code  = (input?.value || '').trim().toUpperCase();

  if (KNOWN_PROMOS[code]) {
    promoDiscount = KNOWN_PROMOS[code];
    msg.textContent = `Promo applied: -₱${promoDiscount.toFixed(2)}`;
    msg.className = 'mt-1.5 text-[11px] text-forest';
  } else {
    promoDiscount = 0;
    msg.textContent = 'Invalid or expired promo code.';
    msg.className = 'mt-1.5 text-[11px] text-sienna';
  }
  msg.classList.remove('hidden');
  populateReview();
});

// Confirm add to cart
document.getElementById('mc-confirm')?.addEventListener('click', async () => {
  const btn = document.getElementById('mc-confirm');
  const originalContent = btn.innerHTML;
  btn.textContent = 'Adding…';
  btn.disabled    = true;

  await Cart.add({
    dataset: {
      id:        currentProduct.id,
      name:      mcName.textContent,
      price:     currentProduct.price,
      farm:      currentProduct.contactName,
      category:  currentProduct.category,
      img:       currentProduct.img,
      certified: currentProduct.certified,
    }
  }, parseInt(mcQtyInput.value));

  btn.textContent = 'Added ✓';
  setTimeout(() => {
    btn.innerHTML   = originalContent;
    btn.disabled    = false;
    closeCartModal();
  }, 900);
});

// Close handlers
document.getElementById('modal-cart-close')?.addEventListener('click', closeCartModal);
document.getElementById('modal-cart-close-2')?.addEventListener('click', closeCartModal);
document.getElementById('modal-cart-backdrop')?.addEventListener('click', closeCartModal);


// ══════════════════════════════════════════════════════════════════
// ── CONTACT FARM MODAL ────────────────────────────────────────────
// ══════════════════════════════════════════════════════════════════
const modalContact = document.getElementById('modal-contact');

function openContactModal(card) {
  document.getElementById('cf-farm').textContent    = card.dataset.contactName;
  document.getElementById('cf-img').src             = card.dataset.img;
  document.getElementById('cf-product').textContent = card.querySelector('h3').textContent;
  document.getElementById('cf-brgy').textContent    = card.dataset.contactBrgy;
  document.getElementById('cf-price').textContent   = '₱' + card.dataset.price + ' ' + card.dataset.unit;
  document.getElementById('cf-brgy-link').textContent = card.dataset.contactBrgy;

  modalContact.classList.remove('hidden');
  modalContact.classList.add('flex');
  document.body.style.overflow = 'hidden';
}

function closeContactModal() {
  modalContact.classList.add('hidden');
  modalContact.classList.remove('flex');
  document.body.style.overflow = '';
}

document.getElementById('modal-contact-close')?.addEventListener('click', closeContactModal);
document.getElementById('modal-contact-backdrop')?.addEventListener('click', closeContactModal);


// ══════════════════════════════════════════════════════════════════
// ── WIRE UP CARD BUTTONS ──────────────────────────────────────────
// ══════════════════════════════════════════════════════════════════
document.querySelectorAll('.btn-add-to-cart').forEach(btn => {
  btn.addEventListener('click', e => {
    e.stopPropagation();
    const card = btn.closest('.product-card');
    openCartModal(card);
  });
});

document.querySelectorAll('.btn-contact').forEach(btn => {
  btn.addEventListener('click', e => {
    e.stopPropagation();
    const card = btn.closest('.product-card');
    openContactModal(card);
  });
});

// Escape key closes any open modal
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') { closeCartModal(); closeContactModal(); }
});