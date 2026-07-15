// resources/js/navigation/cart-page.js

document.addEventListener('DOMContentLoaded', initCartPage);
// In case this script is loaded with `defer`/`type="module"` (DOM already
// parsed by the time it runs), DOMContentLoaded may never fire again — so
// also run immediately if the document is already ready.
if (document.readyState !== 'loading') initCartPage();

function initCartPage() {
  // Guard against double-init if both triggers above fire.
  if (window.__cartPageInitialized) return;
  window.__cartPageInitialized = true;

  // ══════════════════════════════════════════════════════════════════
  // ── MOCK CART DATA ─────────────────────────────────────────────────
  // TODO(backend): replace with the real cart, e.g. fetched from GET /cart
  // ══════════════════════════════════════════════════════════════════
  let cartItems = [
    {
      id: 'p-101', farmId: 'f-1', farmName: 'Batangan Growers Coop',
      name: 'Sweet Corn (Sinandomeng)', img: 'https://images.unsplash.com/photo-1601593768799-76c2b23ce157?w=200',
      unitPrice: 45.00, unit: 'kg', qty: 8, minOrder: 5,
    },
    {
      id: 'p-118', farmId: 'f-1', farmName: 'Batangan Growers Coop',
      name: 'Native Squash (Kalabasa)', img: 'https://images.unsplash.com/photo-1570586437263-ab629fccc818?w=200',
      unitPrice: 28.00, unit: 'kg', qty: 4, minOrder: 2,
    },
    {
      id: 'p-204', farmId: 'f-2', farmName: 'San Ignacio Poultry Farm',
      name: 'Native Free-Range Eggs', img: 'https://images.unsplash.com/photo-1518569656558-1f25e69d93d7?w=200',
      unitPrice: 220.00, unit: 'tray', qty: 2, minOrder: 1,
    },
    {
      id: 'p-317', farmId: 'f-3', farmName: 'Lumangbayan Citrus Growers',
      name: 'Calamansi', img: 'https://images.unsplash.com/photo-1590502593389-c4c48b0c0dc9?w=200',
      unitPrice: 60.00, unit: 'kg', qty: 3, minOrder: 2,
    },
  ];

  let selectedIds = new Set(cartItems.map(i => i.id)); // everything selected by default

  // ── DOM refs ────────────────────────────────────────────────────
  const cartEmpty        = document.getElementById('cart-empty');
  const cartContent       = document.getElementById('cart-content');
  const cartFooterBar     = document.getElementById('cart-footer-bar');
  const groupsWrap        = document.getElementById('cart-groups');
  const selectAllHeader   = document.getElementById('select-all');
  const selectAllFooter   = document.getElementById('select-all-footer');
  const footerTotalItems  = document.getElementById('footer-total-items');
  const footerSelCount    = document.getElementById('footer-selected-count');
  const footerItemPlural  = document.getElementById('footer-item-plural');
  const footerTotalEl     = document.getElementById('footer-total');
  const checkoutBtn       = document.getElementById('proceed-checkout');
  const deleteSelectedBtn = document.getElementById('delete-selected');

  // If the essential containers aren't on this page at all, bail out quietly
  // instead of throwing — this script may be loaded globally on pages
  // without a cart-groups element.
  if (!groupsWrap || !cartContent) {
    console.warn('cart-page.js: expected cart markup not found on this page, skipping init.');
    return;
  }

  function peso(n) { return '₱' + n.toFixed(2); }

  // ── Grouping ────────────────────────────────────────────────────
  function groupByFarm(items) {
    const groups = {};
    items.forEach(item => {
      if (!groups[item.farmId]) groups[item.farmId] = { farmName: item.farmName, items: [] };
      groups[item.farmId].items.push(item);
    });
    return groups;
  }

  // ── Render ──────────────────────────────────────────────────────
  function render() {
    if (cartItems.length === 0) {
      cartEmpty?.classList.remove('hidden');
      cartContent?.classList.add('hidden');
      cartFooterBar?.classList.add('hidden');
      return;
    }
    cartEmpty?.classList.add('hidden');
    cartContent?.classList.remove('hidden');
    cartFooterBar?.classList.remove('hidden');

    const groups = groupByFarm(cartItems);

    groupsWrap.innerHTML = Object.entries(groups).map(([farmId, group]) => {
      const allChecked = group.items.every(i => selectedIds.has(i.id));

      const rows = group.items.map(item => {
        const checked   = selectedIds.has(item.id);
        const lineTotal = item.unitPrice * item.qty;
        return `
          <div class="grid grid-cols-[auto_1fr] md:grid-cols-[auto_1fr_120px_140px_120px_80px]
                      items-center gap-4 px-5 py-4 border-t border-ink/10 cart-item-row"
               data-id="${item.id}">
            <input type="checkbox" class="item-checkbox w-4 h-4 accent-forest" data-id="${item.id}" ${checked ? 'checked' : ''}/>

            <div class="flex items-center gap-3 min-w-0">
              <div class="w-14 h-14 shrink-0 overflow-hidden bg-muted">
                <img src="${item.img}" alt="${item.name}" class="w-full h-full object-cover"/>
              </div>
              <div class="min-w-0">
                <p class="text-sm font-medium text-ink truncate">${item.name}</p>
                <p class="text-[11px] text-muted-fg">Min. order: ${item.minOrder} ${item.unit}</p>
              </div>
            </div>

            <p class="hidden md:block text-right text-sm text-ink">${peso(item.unitPrice)}/${item.unit}</p>

            <div class="flex md:justify-center items-center gap-0 col-span-2 md:col-span-1 mt-2 md:mt-0 ml-7 md:ml-0">
              <button class="qty-minus w-8 h-8 border border-ink/20 flex items-center justify-center
                             text-ink hover:border-forest hover:text-forest transition-colors text-sm" data-id="${item.id}">−</button>
              <input type="number" value="${item.qty}" min="${item.minOrder}"
                     class="qty-input w-14 h-8 border-y border-ink/20 text-center text-sm text-ink
                            bg-transparent focus:outline-none" data-id="${item.id}"/>
              <button class="qty-plus w-8 h-8 border border-ink/20 flex items-center justify-center
                             text-ink hover:border-forest hover:text-forest transition-colors text-sm" data-id="${item.id}">+</button>
            </div>

            <p class="hidden md:block text-right text-sm font-display text-ink item-line-total" data-id="${item.id}">
              ${peso(lineTotal)}
            </p>

            <div class="hidden md:flex justify-center">
              <button class="remove-item text-xs text-sienna hover:opacity-70 transition-opacity" data-id="${item.id}">
                Remove
              </button>
            </div>

            <!-- mobile row: price + total + remove -->
            <div class="md:hidden col-span-2 flex items-center justify-between mt-2 ml-7 text-xs text-muted-fg">
              <span>${peso(item.unitPrice)}/${item.unit}</span>
              <span class="font-display text-sm text-ink item-line-total" data-id="${item.id}">${peso(lineTotal)}</span>
              <button class="remove-item text-sienna" data-id="${item.id}">Remove</button>
            </div>
          </div>
        `;
      }).join('');

      return `
        <div class="border border-ink/10 bg-card">
          <div class="flex items-center gap-3 px-5 py-3 bg-muted/30 border-b border-ink/10">
            <input type="checkbox" class="farm-checkbox w-4 h-4 accent-forest" data-farm="${farmId}" ${allChecked ? 'checked' : ''}/>
            <span class="text-sm font-medium text-ink">${group.farmName}</span>
          </div>
          ${rows}
        </div>
      `;
    }).join('');

    bindRowEvents();
    updateFooter();
    syncSelectAllHeader();
  }

  // ── Event binding (re-bound after every render since HTML is replaced) ──
  function bindRowEvents() {
    document.querySelectorAll('.item-checkbox').forEach(cb => {
      cb.addEventListener('change', () => {
        cb.checked ? selectedIds.add(cb.dataset.id) : selectedIds.delete(cb.dataset.id);
        updateFooter();
        syncFarmCheckbox(cb.dataset.id);
        syncSelectAllHeader();
      });
    });

    document.querySelectorAll('.farm-checkbox').forEach(cb => {
      cb.addEventListener('change', () => {
        const farmItems = cartItems.filter(i => i.farmId === cb.dataset.farm);
        farmItems.forEach(i => cb.checked ? selectedIds.add(i.id) : selectedIds.delete(i.id));
        render();
      });
    });

    document.querySelectorAll('.qty-minus').forEach(btn => {
      btn.addEventListener('click', () => changeQty(btn.dataset.id, -1));
    });
    document.querySelectorAll('.qty-plus').forEach(btn => {
      btn.addEventListener('click', () => changeQty(btn.dataset.id, +1));
    });
    document.querySelectorAll('.qty-input').forEach(input => {
      input.addEventListener('change', () => {
        const item = cartItems.find(i => i.id === input.dataset.id);
        if (!item) return;
        const val = Math.max(item.minOrder, parseInt(input.value) || item.minOrder);
        item.qty = val;
        updateRowTotal(item.id);
        updateFooter();
      });
    });

    document.querySelectorAll('.remove-item').forEach(btn => {
      btn.addEventListener('click', () => {
        cartItems = cartItems.filter(i => i.id !== btn.dataset.id);
        selectedIds.delete(btn.dataset.id);
        render();
      });
    });
  }

  function changeQty(id, delta) {
    const item = cartItems.find(i => i.id === id);
    if (!item) return;
    item.qty = Math.max(item.minOrder, item.qty + delta);
    const input = document.querySelector(`.qty-input[data-id="${id}"]`);
    if (input) input.value = item.qty;
    updateRowTotal(id);
    updateFooter();
  }

  function updateRowTotal(id) {
    const item = cartItems.find(i => i.id === id);
    if (!item) return;
    const total = item.unitPrice * item.qty;
    document.querySelectorAll(`.item-line-total[data-id="${id}"]`).forEach(el => {
      el.textContent = peso(total);
    });
  }

  function syncFarmCheckbox(itemId) {
    const item = cartItems.find(i => i.id === itemId);
    if (!item) return;
    const farmItems = cartItems.filter(i => i.farmId === item.farmId);
    const allChecked = farmItems.every(i => selectedIds.has(i.id));
    const farmCb = document.querySelector(`.farm-checkbox[data-farm="${item.farmId}"]`);
    if (farmCb) farmCb.checked = allChecked;
  }

  function syncSelectAllHeader() {
    const allChecked = cartItems.length > 0 && cartItems.every(i => selectedIds.has(i.id));
    if (selectAllHeader) selectAllHeader.checked = allChecked;
    if (selectAllFooter) selectAllFooter.checked = allChecked;
  }

  function updateFooter() {
    const selectedItems = cartItems.filter(i => selectedIds.has(i.id));
    const total = selectedItems.reduce((sum, i) => sum + i.unitPrice * i.qty, 0);

    if (footerTotalItems) footerTotalItems.textContent = cartItems.length;
    if (footerSelCount)   footerSelCount.textContent   = selectedItems.length;
    if (footerItemPlural) footerItemPlural.textContent = selectedItems.length === 1 ? '' : 's';
    if (footerTotalEl)    footerTotalEl.textContent    = peso(total);
    if (checkoutBtn)      checkoutBtn.disabled         = selectedItems.length === 0;
  }

  // ── Select all (header + footer, kept in sync) ───────────────────
  function toggleSelectAll(checked) {
    selectedIds = checked ? new Set(cartItems.map(i => i.id)) : new Set();
    render();
  }
  selectAllHeader?.addEventListener('change', () => toggleSelectAll(selectAllHeader.checked));
  selectAllFooter?.addEventListener('change', () => toggleSelectAll(selectAllFooter.checked));

  // ── Delete selected ───────────────────────────────────────────────
  deleteSelectedBtn?.addEventListener('click', () => {
    if (selectedIds.size === 0) return;
    cartItems = cartItems.filter(i => !selectedIds.has(i.id));
    selectedIds.clear();
    render();
  });

  // ══════════════════════════════════════════════════════════════════
  // ── PROCEED TO CHECKOUT ──────────────────────────────────────────
  // Hands off only the *selected* items to the checkout page. checkout.js
  // reads this same key; if it's missing/empty it falls back to its own
  // mock data so the checkout page still works when opened directly.
  // ══════════════════════════════════════════════════════════════════
  checkoutBtn?.addEventListener('click', () => {
    const selectedItems = cartItems
      .filter(i => selectedIds.has(i.id))
      .map(i => ({
        id: i.id,
        name: i.name,
        farm: i.farmName,
        img: i.img,
        unit: '/' + i.unit,
        price: i.unitPrice,
        qty: i.qty,
        orderType: 'retail',
        bulkDiscount: 0,
      }));

    if (selectedItems.length === 0) return;

    localStorage.setItem('tamarawCheckoutItems', JSON.stringify(selectedItems));
    window.location.href = '/checkout';

    // TODO(backend): once a real cart endpoint exists, this should instead
    // POST the selected product_ids/qty to something like /checkout/prepare
    // and simply redirect to /checkout (server holds the state), rather than
    // relying on localStorage as the handoff mechanism.
  });

  render();
}