// resources/js/cart.js

export const Cart = {
  getCount() {
    const el = document.getElementById('header-cart-count');
    return el ? parseInt(el.textContent) || 0 : 0;
  },

  setCount(n) {
    const el = document.getElementById('header-cart-count');
    if (!el) return;
    el.textContent = n;
    el.classList.toggle('hidden', n < 1);
  },

  increment(by = 1) {
    this.setCount(this.getCount() + by);
  },

  async add(btn, qty = 1) {
    // Optimistic
    this.increment(qty);

    try {
      const res = await fetch('/cart/add', {
        method:  'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept':       'application/json', // tell Laravel we want JSON back, not a redirect/HTML error page
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
        },
        body: JSON.stringify({
          product_id: btn.dataset.id,
          qty,
          name:       btn.dataset.name,
          price:      parseFloat(btn.dataset.price),
          farm:       btn.dataset.farm,
          category:   btn.dataset.category,
          img:        btn.dataset.img,
          certified:  btn.dataset.certified === 'true' || btn.dataset.certified === '1',
        }),
      });

      // ── Guard: read the raw body first, only parse as JSON if it actually looks like JSON.
      // This is what avoids the "Unexpected token '<'" crash — that error means the server
      // returned an HTML page (a 404, a 500 error page, or a redirect to /login), not JSON.
      const raw = await res.text();
      let data;
      try {
        data = JSON.parse(raw);
      } catch {
        console.error(
          `Cart error: expected JSON from /cart/add but got ${res.status} ${res.statusText}.`,
          '\nRaw response (first 300 chars):', raw.slice(0, 300),
          '\n\nMost likely causes:',
          '\n 1. No route registered for POST /cart/add in routes/web.php or routes/api.php',
          '\n 2. Route exists but is behind auth middleware, so it redirected to the login page',
          '\n 3. A server error (500) is being rendered as an HTML error page instead of JSON'
        );
        this.setCount(this.getCount() - qty); // roll back the optimistic update
        return;
      }

      if (!res.ok) {
        console.error('Cart error: server responded with', res.status, data);
        this.setCount(this.getCount() - qty);
        return;
      }

      this.setCount(data.cart_count);
    } catch (e) {
      this.setCount(this.getCount() - qty);
      console.error('Cart error (network)', e);
    }
  },
};