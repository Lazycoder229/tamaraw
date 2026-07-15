// resources/js/navigation/checkout.js

// ══════════════════════════════════════════════════════════════════
// ── MOCK CART DATA ─────────────────────────────────────────────────
// TODO(backend): replace this with actual cart data, e.g. fetched
// from GET /cart or passed in via a Blade @json() into a data attribute.
// ══════════════════════════════════════════════════════════════════
const fallbackMockItems = [
  {
    id: 'p-101',
    name: 'Sweet Corn (Sinandomeng)',
    farm: 'Batangan Growers Coop',
    img: 'https://images.unsplash.com/photo-1601593768799-76c2b23ce157?w=200',
    unit: '/kg',
    price: 45.00,
    qty: 8,
    orderType: 'bulk',      // 'retail' | 'bulk'
    bulkDiscount: 0.10,
  },
  {
    id: 'p-204',
    name: 'Native Free-Range Eggs',
    farm: 'San Ignacio Poultry Farm',
    img: 'https://images.unsplash.com/photo-1518569656558-1f25e69d93d7?w=200',
    unit: '/tray',
    price: 220.00,
    qty: 2,
    orderType: 'retail',
    bulkDiscount: 0,
  },
  {
    id: 'p-317',
    name: 'Calamansi',
    farm: 'Lumangbayan Citrus Growers',
    img: 'https://images.unsplash.com/photo-1590502593389-c4c48b0c0dc9?w=200',
    unit: '/kg',
    price: 60.00,
    qty: 3,
    orderType: 'retail',
    bulkDiscount: 0,
  },
];

// Prefer whatever the cart page handed off; fall back to mock data so this
// page still renders something sensible when opened directly for testing.
// TODO(backend): once /checkout is server-rendered with real order data,
// remove this localStorage read entirely and populate mockCartItems (or
// better, a Blade @json() payload) from the server instead.
function loadCartItems() {
  try {
    const stored = localStorage.getItem('tamarawCheckoutItems');
    if (stored) {
      const parsed = JSON.parse(stored);
      if (Array.isArray(parsed) && parsed.length > 0) return parsed;
    }
  } catch (e) {
    console.warn('Could not read handed-off cart items, using fallback mock data.', e);
  }
  return fallbackMockItems;
}

const mockCartItems = loadCartItems();

const DELIVERY_FEE     = 50;
const FREE_DELIVERY_AT = 500;

// ── DOM refs ──────────────────────────────────────────────────────
const itemsWrap    = document.getElementById('co-items');
const itemCountEl  = document.getElementById('co-item-count');
const subtotalEl   = document.getElementById('co-subtotal');
const discountRow  = document.getElementById('co-discount-row');
const discountAmt  = document.getElementById('co-discount-amt');
const deliveryEl   = document.getElementById('co-delivery');
const totalEl      = document.getElementById('co-total');
const placeOrderBtn= document.getElementById('co-place-order');
const successModal = document.getElementById('co-success');
const addressError = document.getElementById('co-address-error');

// ── Render items ──────────────────────────────────────────────────
function itemLineTotal(item) {
  const raw = item.price * item.qty;
  return item.orderType === 'bulk' ? raw * (1 - item.bulkDiscount) : raw;
}

function renderItems() {
  itemCountEl.textContent = `(${mockCartItems.length})`;

  itemsWrap.innerHTML = mockCartItems.map(item => {
    const raw   = item.price * item.qty;
    const total = itemLineTotal(item);
    const bulkTag = item.orderType === 'bulk'
      ? `<span class="text-[9px] font-bold uppercase tracking-wide text-forest bg-forest/10 px-1.5 py-0.5 ml-2">Bulk -10%</span>`
      : '';

    return `
      <div class="flex items-center gap-3 px-5 py-3.5">
        <div class="w-14 h-14 shrink-0 overflow-hidden bg-muted">
          <img src="${item.img}" alt="${item.name}" class="w-full h-full object-cover"/>
        </div>
        <div class="flex-1 min-w-0">
          <p class="text-sm font-medium text-ink truncate">${item.name}${bulkTag}</p>
          <p class="text-[11px] text-muted-fg">${item.farm}</p>
          <p class="text-[11px] text-muted-fg mt-0.5">${item.qty} ${item.unit.replace('/', '')} × ₱${item.price.toFixed(2)}</p>
        </div>
        <div class="text-right shrink-0">
          <p class="text-sm font-display text-ink">₱${total.toFixed(2)}</p>
          ${item.orderType === 'bulk' ? `<p class="text-[10px] text-muted-fg line-through">₱${raw.toFixed(2)}</p>` : ''}
        </div>
      </div>
    `;
  }).join('');
}

// ── Totals ────────────────────────────────────────────────────────
function computeTotals() {
  const rawSubtotal = mockCartItems.reduce((sum, item) => sum + item.price * item.qty, 0);
  const discountedSubtotal = mockCartItems.reduce((sum, item) => sum + itemLineTotal(item), 0);
  const bulkSavings = rawSubtotal - discountedSubtotal;
  const delivery = discountedSubtotal >= FREE_DELIVERY_AT ? 0 : DELIVERY_FEE;
  const total = discountedSubtotal + delivery;
  return { rawSubtotal, discountedSubtotal, bulkSavings, delivery, total };
}

function renderTotals() {
  const { rawSubtotal, bulkSavings, delivery, total } = computeTotals();

  subtotalEl.textContent = '₱' + rawSubtotal.toFixed(2);

  if (bulkSavings > 0) {
    discountRow.classList.remove('hidden');
    discountAmt.textContent = '-₱' + bulkSavings.toFixed(2);
  } else {
    discountRow.classList.add('hidden');
  }

  deliveryEl.textContent = delivery === 0 ? 'FREE' : '₱' + delivery.toFixed(2);
  totalEl.textContent    = '₱' + total.toFixed(2);
}

renderItems();
renderTotals();

// ══════════════════════════════════════════════════════════════════
// ── PAYMENT METHOD TOGGLE ─────────────────────────────────────────
// ══════════════════════════════════════════════════════════════════
const gcashPanel = document.getElementById('gcash-panel');

document.querySelectorAll('input[name="payment-method"]').forEach(radio => {
  radio.addEventListener('change', () => {
    gcashPanel.classList.toggle('hidden', radio.value !== 'gcash' || !radio.checked);

    document.querySelectorAll('.payment-option').forEach(label => {
      const input = label.querySelector('input[name="payment-method"]');
      label.classList.toggle('border-forest', input.checked);
      label.classList.toggle('bg-forest/5', input.checked);
    });
  });
});
// Trigger initial state (COD checked by default)
document.querySelector('input[name="payment-method"]:checked')?.dispatchEvent(new Event('change'));

function getSelectedPaymentMethod() {
  return document.querySelector('input[name="payment-method"]:checked')?.value || 'cod';
}

// ══════════════════════════════════════════════════════════════════
// ── VALIDATION + PLACE ORDER ──────────────────────────────────────
// ══════════════════════════════════════════════════════════════════
function validateDeliveryFields() {
  const name    = document.getElementById('co-name').value.trim();
  const phone   = document.getElementById('co-phone').value.trim();
  const brgy    = document.getElementById('co-barangay').value;
  const address = document.getElementById('co-address').value.trim();
  return name && phone && brgy && address;
}

placeOrderBtn?.addEventListener('click', async () => {
  if (!validateDeliveryFields()) {
    addressError.classList.remove('hidden');
    document.getElementById('co-name').scrollIntoView({ behavior: 'smooth', block: 'center' });
    return;
  }
  addressError.classList.add('hidden');

  const { total } = computeTotals();
  const payload = {
    items: mockCartItems.map(i => ({ id: i.id, qty: i.qty, order_type: i.orderType })),
    delivery: {
      name:     document.getElementById('co-name').value.trim(),
      phone:    document.getElementById('co-phone').value.trim(),
      barangay: document.getElementById('co-barangay').value,
      address:  document.getElementById('co-address').value.trim(),
    },
    payment_method: getSelectedPaymentMethod(),
    total,
  };

  placeOrderBtn.disabled = true;
  placeOrderBtn.textContent = 'Placing Order…';

  try {
    // TODO(backend): wire this up to the real endpoint, e.g.:
    // const res = await fetch('/checkout/place-order', {
    //   method: 'POST',
    //   headers: {
    //     'Content-Type': 'application/json',
    //     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
    //   },
    //   body: JSON.stringify(payload),
    // });
    // if (!res.ok) throw new Error('Order failed');

    console.log('Placing order with payload:', payload);
    await new Promise(resolve => setTimeout(resolve, 600)); // simulate network delay

    successModal.classList.remove('hidden');
    successModal.classList.add('flex');
  } catch (err) {
    console.error('Checkout error', err);
    placeOrderBtn.disabled = false;
    placeOrderBtn.textContent = 'Place Order';
  }
});