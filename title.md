"TAMARAW: Trade and Market Access for Rural Agricultural Workers — A Farm-to-Table E-Commerce Platform with AI-Powered Farming Assistant for the Agricultural Communities of Baco, Oriental Mindoro"



protected function compile(string $content): string
{
    $content = $this->compileComments($content);
    $content = $this->compilePhp($content);        // ← dagdag dito
    $content = $this->compileLayout($content);
    // ...ang lahat ng iba pa
}

protected function compilePhp(string $content): string
{
    $content = preg_replace('/@php/', '<?php', $content);
    $content = preg_replace('/@endphp/', '?>', $content);
    return $content;
}

# TAMARAW
**Trade and Market Access for Rural Agricultural Workers**
*A Farm-to-Table E-Commerce Platform with AI-Powered Farming Assistant for the Agricultural Communities of Baco, Oriental Mindoro*

---

## 1. Functional Requirements

### 1.1 User & Account Management
- FR-1.1: The system shall allow users to register as a **Buyer**, **Farmer/Seller**, or **Admin**, with role-specific onboarding fields.
- FR-1.2: The system shall support email/password authentication with password hashing and session management.
- FR-1.3: The system shall allow users to view and edit their profile (name, contact number, address, profile photo).
- FR-1.4: The system shall support password reset via email/token.
- FR-1.5: The system shall allow farmers to submit verification documents (e.g., farmer ID, barangay certification) for seller approval by an Admin.
- FR-1.6: The system shall maintain multiple shipping addresses per buyer.

### 1.2 Marketplace & Product Management
- FR-2.1: The system shall allow approved sellers to create, edit, archive, and delete product listings.
- FR-2.2: Each product listing shall include name, description, category, unit of measure (kg, sack, piece, bundle), price, stock quantity, harvest date, and multiple images.
- FR-2.3: The system shall support product categorization (e.g., Vegetables, Fruits, Grains, Livestock, Processed Goods).
- FR-2.4: The system shall automatically flag/hide products when stock reaches zero.
- FR-2.5: The system shall log inventory changes (restock, sale deduction, manual adjustment).
- FR-2.6: The system shall allow buyers to search products by keyword and filter by category, price range, location, and availability.
- FR-2.7: The system shall display seller/farm profile on each product page (farm name, location, rating).

### 1.3 Seller Center
- FR-3.1: The system shall provide a Seller Center modal/dashboard summarizing active listings, pending orders, and sales performance.
- FR-3.2: The system shall allow sellers to update order status (Pending → Confirmed → Preparing → Ready for Pickup/Shipped → Completed).
- FR-3.3: The system shall allow sellers to set store availability (open/closed for orders) and pickup/delivery options.
- FR-3.4: The system shall generate basic sales reports (daily/weekly/monthly revenue, top products) per seller.

### 1.4 Shopping Cart & Checkout
- FR-4.1: The system shall allow buyers to add/remove/update quantities of products in a persistent cart.
- FR-4.2: The system shall support multi-seller carts, splitting checkout into separate orders per seller.
- FR-4.3: The system shall calculate subtotal, delivery fee, and total at checkout.
- FR-4.4: The system shall allow buyers to select a delivery address and preferred payment method at checkout.
- FR-4.5: The system shall generate an order confirmation and unique order reference number upon successful checkout.

### 1.5 Order & Payment Management
- FR-5.1: The system shall support Cash on Delivery/Pickup and at least one digital payment method (e.g., GCash, bank transfer).
- FR-5.2: The system shall record payment status (Unpaid, Paid, Refunded) per order.
- FR-5.3: The system shall allow buyers to track order status in real time.
- FR-5.4: The system shall allow buyers to cancel an order prior to seller confirmation.
- FR-5.5: The system shall notify both buyer and seller on order status changes.

### 1.6 AI Farming Assistant
- FR-6.1: The system shall provide a chat interface where farmers can ask questions related to crop care, pest management, weather-based planting advice, and market pricing trends.
- FR-6.2: The system shall persist chat history per user session, retrievable across logins.
- FR-6.3: The system shall allow the AI assistant to reference the user's registered crops/products to give contextualized advice.
- FR-6.4: The system shall allow users to start a new chat session or continue a previous one.

### 1.7 Reviews & Ratings
- FR-7.1: The system shall allow buyers to rate (1–5 stars) and review products/sellers after order completion.
- FR-7.2: The system shall display average rating and review count on product and seller profiles.
- FR-7.3: The system shall allow sellers to respond to reviews.

### 1.8 Notifications
- FR-8.1: The system shall notify users in-app (and optionally via email) for: order placed, order status change, new message, low stock alert (seller), and verification status updates.

### 1.9 Admin Panel
- FR-9.1: The system shall allow Admins to approve/reject farmer-seller verification requests.
- FR-9.2: The system shall allow Admins to manage product categories.
- FR-9.3: The system shall allow Admins to suspend/ban users or listings that violate platform policy.
- FR-9.4: The system shall provide Admins with platform-wide analytics (total users, total sales, active listings).

---

## 2. Non-Functional Requirements

| Category | Requirement |
|---|---|
| **Performance** | NFR-1: Product listing and search pages shall load within 2–3 seconds under normal load (≤100 concurrent users). |
| **Scalability** | NFR-2: The system architecture (LitePHP + MySQL) shall support horizontal growth in product/user volume without major re-architecture. |
| **Security** | NFR-3: Passwords shall be hashed (bcrypt/Argon2); all forms shall be protected against SQL injection and CSRF; sessions shall expire after inactivity. |
| **Usability** | NFR-4: UI shall support Filipino and English labels/instructions, with a simple, low-literacy-friendly layout suited for rural users. |
| **Accessibility** | NFR-5: The platform shall be usable on low-end Android devices and low-bandwidth mobile connections common in Baco, Oriental Mindoro. |
| **Reliability/Availability** | NFR-6: The system shall target 99% uptime during business hours; failed transactions shall roll back cleanly (no partial orders). |
| **Maintainability** | NFR-7: Codebase shall follow the LitePHP MVC structure (Controllers, Components, Views) with clear separation of concerns, per existing framework conventions. |
| **Data Integrity** | NFR-8: All monetary and inventory-affecting operations shall be wrapped in database transactions. |
| **Compatibility** | NFR-9: The platform shall be responsive across desktop, tablet, and mobile browsers (Chrome, Edge, mobile Chrome). |
| **Localization** | NFR-10: Currency shall be displayed in PHP (₱); dates/times in local (Asia/Manila) timezone. |
| **Auditability** | NFR-11: Key actions (order status change, inventory adjustment, verification decisions) shall be logged with timestamp and actor. |

---

## 3. Database Schema
 <!-- <div class="flex gap-1.5">
          @if ($product->badge)
          <span class="text-[10px] px-2 py-0.5 bg-amber/10 text-amber tracking-wide">{{ $product->badge }}</span>
          @endif
          @if ($product->verified)
          <span class="text-[10px] px-2 py-0.5 bg-forest/10 text-forest tracking-wide">Verified</span>
          @endif
        </div> -->
Relational schema (MySQL-flavored). Naming: snake_case tables, singular FK suffix `_id`.

```sql
-- ========================================
-- USERS & ROLES
-- ========================================

CREATE TABLE users (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role            ENUM('buyer', 'farmer', 'admin') NOT NULL DEFAULT 'buyer',
    first_name      VARCHAR(100) NOT NULL,
    last_name       VARCHAR(100) NOT NULL,
    email           VARCHAR(150) NOT NULL UNIQUE,
    phone_number    VARCHAR(20),
    password_hash   VARCHAR(255) NOT NULL,
    profile_photo   VARCHAR(255),
    status          ENUM('active', 'suspended', 'banned') NOT NULL DEFAULT 'active',
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE password_resets (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id         BIGINT UNSIGNED NOT NULL,
    token           VARCHAR(255) NOT NULL,
    expires_at      DATETIME NOT NULL,
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE addresses (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id         BIGINT UNSIGNED NOT NULL,
    label           VARCHAR(50),               -- e.g. Home, Farm
    street          VARCHAR(255) NOT NULL,
    barangay        VARCHAR(100) NOT NULL,
    municipality    VARCHAR(100) NOT NULL DEFAULT 'Baco',
    province        VARCHAR(100) NOT NULL DEFAULT 'Oriental Mindoro',
    postal_code     VARCHAR(10),
    is_default      BOOLEAN DEFAULT FALSE,
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ========================================
-- FARMER / SELLER PROFILE & VERIFICATION
-- ========================================

CREATE TABLE farmer_profiles (
    id                  BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id             BIGINT UNSIGNED NOT NULL UNIQUE,
    farm_name           VARCHAR(150) NOT NULL,
    farm_description    TEXT,
    farm_barangay       VARCHAR(100),
    verification_status ENUM('pending', 'verified', 'rejected') NOT NULL DEFAULT 'pending',
    store_open          BOOLEAN DEFAULT TRUE,
    delivery_available  BOOLEAN DEFAULT TRUE,
    pickup_available    BOOLEAN DEFAULT TRUE,
    rating_avg          DECIMAL(3,2) DEFAULT 0.00,
    rating_count        INT UNSIGNED DEFAULT 0,
    created_at          DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE farmer_verification_documents (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    farmer_id       BIGINT UNSIGNED NOT NULL,
    doc_type        VARCHAR(100) NOT NULL,     -- e.g. Farmer ID, Barangay Cert
    file_path       VARCHAR(255) NOT NULL,
    reviewed_by     BIGINT UNSIGNED,           -- admin user_id
    review_status   ENUM('pending','approved','rejected') DEFAULT 'pending',
    reviewed_at     DATETIME,
    uploaded_at     DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (farmer_id) REFERENCES farmer_profiles(id) ON DELETE CASCADE,
    FOREIGN KEY (reviewed_by) REFERENCES users(id) ON DELETE SET NULL
);

-- ========================================
-- PRODUCT CATALOG
-- ========================================

CREATE TABLE categories (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(100) NOT NULL UNIQUE,
    slug            VARCHAR(100) NOT NULL UNIQUE,
    parent_id       INT UNSIGNED,
    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE products (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    farmer_id       BIGINT UNSIGNED NOT NULL,
    category_id     INT UNSIGNED NOT NULL,
    name            VARCHAR(150) NOT NULL,
    slug            VARCHAR(180) NOT NULL UNIQUE,
    description     TEXT,
    unit            ENUM('kg','sack','piece','bundle','liter','tray') NOT NULL,
    price           DECIMAL(10,2) NOT NULL,
    stock_quantity  INT UNSIGNED NOT NULL DEFAULT 0,
    harvest_date    DATE,
    status          ENUM('active','out_of_stock','archived') NOT NULL DEFAULT 'active',
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (farmer_id) REFERENCES farmer_profiles(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE product_images (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id      BIGINT UNSIGNED NOT NULL,
    file_path       VARCHAR(255) NOT NULL,
    is_primary      BOOLEAN DEFAULT FALSE,
    sort_order      SMALLINT UNSIGNED DEFAULT 0,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE inventory_logs (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id      BIGINT UNSIGNED NOT NULL,
    change_type     ENUM('restock','sale','manual_adjustment') NOT NULL,
    quantity_change INT NOT NULL,              -- can be negative
    resulting_stock INT UNSIGNED NOT NULL,
    note            VARCHAR(255),
    created_by      BIGINT UNSIGNED,
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

-- ========================================
-- CART
-- ========================================

CREATE TABLE carts (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id         BIGINT UNSIGNED NOT NULL UNIQUE,
    updated_at      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE cart_items (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cart_id         BIGINT UNSIGNED NOT NULL,
    product_id      BIGINT UNSIGNED NOT NULL,
    quantity        INT UNSIGNED NOT NULL DEFAULT 1,
    added_at        DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_cart_product (cart_id, product_id),
    FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- ========================================
-- ORDERS & PAYMENTS
-- ========================================

CREATE TABLE orders (
    id                  BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_reference     VARCHAR(30) NOT NULL UNIQUE,
    buyer_id            BIGINT UNSIGNED NOT NULL,
    farmer_id           BIGINT UNSIGNED NOT NULL,   -- one order per seller (split cart)
    address_id          BIGINT UNSIGNED NOT NULL,
    fulfillment_method  ENUM('delivery','pickup') NOT NULL,
    subtotal            DECIMAL(10,2) NOT NULL,
    delivery_fee        DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    total_amount        DECIMAL(10,2) NOT NULL,
    order_status        ENUM('pending','confirmed','preparing','ready','shipped','completed','cancelled') NOT NULL DEFAULT 'pending',
    payment_status       ENUM('unpaid','paid','refunded') NOT NULL DEFAULT 'unpaid',
    placed_at           DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at          DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (buyer_id) REFERENCES users(id),
    FOREIGN KEY (farmer_id) REFERENCES farmer_profiles(id),
    FOREIGN KEY (address_id) REFERENCES addresses(id)
);

CREATE TABLE order_items (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id        BIGINT UNSIGNED NOT NULL,
    product_id      BIGINT UNSIGNED NOT NULL,
    product_name    VARCHAR(150) NOT NULL,     -- snapshot at time of order
    unit_price      DECIMAL(10,2) NOT NULL,    -- snapshot at time of order
    quantity        INT UNSIGNED NOT NULL,
    line_total      DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE order_status_logs (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id        BIGINT UNSIGNED NOT NULL,
    old_status      VARCHAR(30),
    new_status      VARCHAR(30) NOT NULL,
    changed_by      BIGINT UNSIGNED,
    changed_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (changed_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE payments (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id        BIGINT UNSIGNED NOT NULL UNIQUE,
    payment_method  ENUM('cod','gcash','bank_transfer') NOT NULL,
    amount          DECIMAL(10,2) NOT NULL,
    reference_no    VARCHAR(100),
    status          ENUM('pending','confirmed','failed','refunded') NOT NULL DEFAULT 'pending',
    paid_at         DATETIME,
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

-- ========================================
-- REVIEWS & RATINGS
-- ========================================

CREATE TABLE reviews (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id        BIGINT UNSIGNED NOT NULL,
    buyer_id        BIGINT UNSIGNED NOT NULL,
    farmer_id       BIGINT UNSIGNED NOT NULL,
    product_id      BIGINT UNSIGNED,
    rating          TINYINT UNSIGNED NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment         TEXT,
    seller_reply    TEXT,
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_review_order_product (order_id, product_id),
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (buyer_id) REFERENCES users(id),
    FOREIGN KEY (farmer_id) REFERENCES farmer_profiles(id),
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
);

-- ========================================
-- AI FARMING ASSISTANT
-- ========================================

CREATE TABLE ai_chat_sessions (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id         BIGINT UNSIGNED NOT NULL,
    title           VARCHAR(150),              -- auto-generated summary of session
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at      DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE ai_chat_messages (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    session_id      BIGINT UNSIGNED NOT NULL,
    sender          ENUM('user','ai') NOT NULL,
    message         TEXT NOT NULL,
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (session_id) REFERENCES ai_chat_sessions(id) ON DELETE CASCADE
);

-- ========================================
-- NOTIFICATIONS
-- ========================================

CREATE TABLE notifications (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id         BIGINT UNSIGNED NOT NULL,
    type            VARCHAR(50) NOT NULL,      -- order_placed, status_change, new_message, low_stock, verification_update
    title           VARCHAR(150) NOT NULL,
    body            VARCHAR(255),
    related_id      BIGINT UNSIGNED,           -- polymorphic reference (order_id, product_id, etc.)
    is_read         BOOLEAN DEFAULT FALSE,
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ========================================
-- ADMIN / AUDIT
-- ========================================

CREATE TABLE audit_logs (
    id              BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    actor_id        BIGINT UNSIGNED,
    action          VARCHAR(100) NOT NULL,     -- e.g. 'suspend_user', 'approve_verification'
    target_table    VARCHAR(50),
    target_id       BIGINT UNSIGNED,
    details         TEXT,
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (actor_id) REFERENCES users(id) ON DELETE SET NULL
);
```

### 3.1 Entity Relationship Summary

- `users` → 1:1 → `farmer_profiles` (only for role = farmer)
- `users` → 1:N → `addresses`, `carts`, `orders` (as buyer), `notifications`, `ai_chat_sessions`
- `farmer_profiles` → 1:N → `products`, `orders` (as seller), `farmer_verification_documents`
- `products` → 1:N → `product_images`, `inventory_logs`, `cart_items`, `order_items`
- `orders` → 1:N → `order_items`, `order_status_logs` → 1:1 → `payments`
- `orders` → 1:N → `reviews`
- `ai_chat_sessions` → 1:N → `ai_chat_messages`
- `categories` → self-referencing for subcategories, 1:N → `products`

### 3.2 Notes for Implementation (LitePHP)
- Map each table to a Model class under your existing LitePHP structure; `farmer_profiles` and `products` naturally pair with a `Component`-driven Seller Center view.
- `order_items` snapshots `product_name`/`unit_price` at purchase time — this protects historical order data even if a farmer later edits or deletes a product.
- Consider a `deleted_at` soft-delete column on `products` and `users` instead of hard deletes, since orders/reviews reference them.
- Index recommendations: `products(category_id, status)`, `orders(buyer_id, order_status)`, `orders(farmer_id, order_status)`, `ai_chat_messages(session_id, created_at)`.