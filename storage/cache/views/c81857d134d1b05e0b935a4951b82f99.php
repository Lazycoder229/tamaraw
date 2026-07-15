<?php $this->layout = 'layout.app'; ?>

<?php
  $pageTitle    = 'Marketplace';
  $headerLayout = 'left-search';
  $headerSearch = 'Search products, farms…';
?>

<?php $this->currentSection = 'title'; ob_start(); ?> Marketplace — TAMARAW <?php $this->sections[$this->currentSection] = ob_get_clean(); $this->currentSection = null; ?>

<?php $this->currentSection = 'styles'; ob_start(); ?>
<style>
  #product-grid { grid-auto-rows: 1fr; }
</style>
<?php $this->sections[$this->currentSection] = ob_get_clean(); $this->currentSection = null; ?>

<?php $this->currentSection = 'content'; ob_start(); ?>

<div class="flex flex-col lg:flex-row gap-6">

  
  <aside class="w-full lg:w-56 xl:w-60 shrink-0 space-y-6">

    <p class="text-xs text-muted-fg">
      <span id="results-count"><?= htmlspecialchars((string)(count($listings)), ENT_QUOTES, 'UTF-8') ?></span>
      products · verified Baco farmers
    </p>

    <div>
      <p class="text-[10px] font-bold tracking-widest uppercase text-muted-fg mb-2">Sort by</p>
      <select id="sort-select"
              class="w-full text-xs border border-ink/20 bg-cream text-ink px-3 py-2
                     focus:outline-none focus:border-forest">
        <option value="default">Default</option>
        <option value="price-asc">Price: Low → High</option>
        <option value="price-desc">Price: High → Low</option>
        <option value="stock">Most Stock</option>
        <option value="name">Name A–Z</option>
      </select>
    </div>

    <div class="pb-5 border-b border-ink/10">
      <p class="text-[10px] font-bold tracking-widest uppercase text-muted-fg mb-2">Category</p>
      <div class="flex flex-col gap-1">
        <?php foreach (['All','Vegetables','Fruits','Grains','Livestock','Processed'] as $cat): ?>
          <button data-cat="<?= htmlspecialchars((string)($cat), ENT_QUOTES, 'UTF-8') ?>"
                  class="cat-btn text-left px-3 py-2 text-sm transition-all flex items-center justify-between
                         <?= htmlspecialchars((string)($cat === 'All' ? 'bg-forest text-cream' : 'text-ink hover:bg-muted'), ENT_QUOTES, 'UTF-8') ?>">
            <span><?= htmlspecialchars((string)($cat), ENT_QUOTES, 'UTF-8') ?></span>
            <?php if ($cat === 'All'): ?>
              <span class="text-[10px] bg-cream/20 text-cream px-1.5 py-0.5"><?= htmlspecialchars((string)(count($listings)), ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
          </button>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="pb-5 border-b border-ink/10">
      <p class="text-[10px] font-bold tracking-widest uppercase text-muted-fg mb-2">Price / kg</p>
      <div class="flex items-center gap-2">
        <input type="number" id="price-min" placeholder="Min"
               class="w-full border border-ink/20 bg-cream px-3 py-2 text-sm text-ink
                      focus:outline-none focus:border-forest"/>
        <span class="text-muted-fg text-sm shrink-0">—</span>
        <input type="number" id="price-max" placeholder="Max"
               class="w-full border border-ink/20 bg-cream px-3 py-2 text-sm text-ink
                      focus:outline-none focus:border-forest"/>
      </div>
      <button id="apply-price"
              class="mt-2 w-full text-xs border border-ink/25 px-3 py-2 text-ink
                     hover:border-forest hover:text-forest transition-colors">Apply</button>
    </div>

    <div class="pb-5 border-b border-ink/10">
      <label class="flex items-center gap-2.5 cursor-pointer group">
        <input type="checkbox" id="certified-filter" class="w-4 h-4 accent-forest"/>
        <span class="text-sm text-ink group-hover:text-forest transition-colors">Verified Farms Only</span>
      </label>
    </div>

    <div class="pb-5 border-b border-ink/10">
      <p class="text-[10px] font-bold tracking-widest uppercase text-muted-fg mb-2">Barangay</p>
      <div class="flex flex-col gap-1.5">
        <?php foreach (['All Barangays','Brgy. Batangan','Brgy. San Andres','Brgy. Calubian','Brgy. Poblacion','Brgy. Lumangbayan','Brgy. San Ignacio'] as $brgy): ?>
          <label class="flex items-center gap-2.5 cursor-pointer group">
            <input type="checkbox" data-brgy="<?= htmlspecialchars((string)($brgy), ENT_QUOTES, 'UTF-8') ?>"
                   class="brgy-filter w-3.5 h-3.5 accent-forest"
                   <?= htmlspecialchars((string)($brgy === 'All Barangays' ? 'checked' : ''), ENT_QUOTES, 'UTF-8') ?>/>
            <span class="text-xs text-muted-fg group-hover:text-ink transition-colors"><?= htmlspecialchars((string)($brgy), ENT_QUOTES, 'UTF-8') ?></span>
          </label>
        <?php endforeach; ?>
      </div>
    </div>

    <button id="clear-filters"
            class="w-full text-xs text-muted-fg border border-ink/15 px-3 py-2
                   hover:border-sienna hover:text-sienna transition-colors">
      Clear All Filters
    </button>

  </aside>

  
  <div class="flex-1 min-w-0">

    
    <div class="flex flex-wrap gap-2 mb-5 lg:hidden">
      <?php foreach (['All','Vegetables','Fruits','Grains','Livestock','Processed'] as $cat): ?>
        <button data-cat="<?= htmlspecialchars((string)($cat), ENT_QUOTES, 'UTF-8') ?>"
                class="cat-btn px-3 py-1.5 text-xs font-semibold border transition-all
                       <?= htmlspecialchars((string)($cat === 'All' ? 'bg-forest text-cream border-forest' : 'bg-transparent text-muted-fg border-ink/20'), ENT_QUOTES, 'UTF-8') ?>">
          <?= htmlspecialchars((string)($cat), ENT_QUOTES, 'UTF-8') ?>
        </button>
      <?php endforeach; ?>
    </div>

    
    <div id="no-results" class="hidden py-24 text-center">
      <p class="text-4xl mb-4">🌱</p>
      <p class="font-display font-light text-ink text-xl mb-2">No products found</p>
      <p class="text-sm text-muted-fg">Try adjusting your filters or search term.</p>
      <button id="reset-from-empty"
              class="mt-6 text-sm text-forest border-b border-forest pb-px hover:opacity-70 transition-opacity">
        Clear all filters
      </button>
    </div>

    
    <div id="product-grid"
         class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-px bg-ink/10">

      <?php foreach ($listings as $product): ?>
        <div class="product-card group bg-card flex flex-col overflow-hidden cursor-pointer"
             data-category="<?= htmlspecialchars((string)($product['category']), ENT_QUOTES, 'UTF-8') ?>"
             data-price="<?= htmlspecialchars((string)($product['price']), ENT_QUOTES, 'UTF-8') ?>"
             data-certified="<?= htmlspecialchars((string)($product['certified'] ? 'true' : 'false'), ENT_QUOTES, 'UTF-8') ?>"
             data-barangay="<?= htmlspecialchars((string)($product['barangay']), ENT_QUOTES, 'UTF-8') ?>"
             data-name="<?= htmlspecialchars((string)(strtolower($product['name'])), ENT_QUOTES, 'UTF-8') ?>"
             data-farm="<?= htmlspecialchars((string)(strtolower($product['farm'])), ENT_QUOTES, 'UTF-8') ?>"
             data-id="<?= htmlspecialchars((string)($product['id']), ENT_QUOTES, 'UTF-8') ?>"
             data-img="<?= htmlspecialchars((string)($product['img']), ENT_QUOTES, 'UTF-8') ?>"
             data-unit="<?= htmlspecialchars((string)($product['unit']), ENT_QUOTES, 'UTF-8') ?>"
             data-stock="<?= htmlspecialchars((string)($product['stock']), ENT_QUOTES, 'UTF-8') ?>"
             data-min-order="<?= htmlspecialchars((string)($product['minOrder']), ENT_QUOTES, 'UTF-8') ?>"
             data-badge="<?= htmlspecialchars((string)($product['badge']), ENT_QUOTES, 'UTF-8') ?>"
             data-contact-name="<?= htmlspecialchars((string)($product['farm']), ENT_QUOTES, 'UTF-8') ?>"
             data-contact-brgy="<?= htmlspecialchars((string)($product['barangay']), ENT_QUOTES, 'UTF-8') ?>">

          
          <div class="relative overflow-hidden bg-muted" style="aspect-ratio:1/1">
            <img src="<?= htmlspecialchars((string)($product['img']), ENT_QUOTES, 'UTF-8') ?>"
                 alt="<?= htmlspecialchars((string)($product['name']), ENT_QUOTES, 'UTF-8') ?>"
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-[1.06]"/>
            <?php if ($product['badge']): ?>
              <span class="absolute top-2 left-2 bg-amber text-ink text-[9px] font-bold
                           tracking-wider uppercase px-2 py-0.5"><?= htmlspecialchars((string)($product['badge']), ENT_QUOTES, 'UTF-8') ?></span>
            <?php endif; ?>
            <?php if ($product['certified']): ?>
              <span class="absolute top-2 right-2 bg-white/90 text-forest text-[9px] font-bold
                           px-1.5 py-0.5 flex items-center gap-1">
                <svg width="10" height="10" viewBox="0 0 24 24" fill="#1E5631">
                  <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                Verified
              </span>
            <?php endif; ?>
            
            <div class="absolute inset-0 bg-ink/0 group-hover:bg-ink/10 transition-colors duration-300"></div>
          </div>

          
          <div class="p-3 flex flex-col flex-1">
            <p class="text-[9px] font-bold tracking-[0.15em] uppercase text-muted-fg mb-0.5"><?= htmlspecialchars((string)($product['category']), ENT_QUOTES, 'UTF-8') ?></p>
            <h3 class="font-display font-light text-ink text-sm leading-snug mb-0.5 line-clamp-2"><?= htmlspecialchars((string)($product['name']), ENT_QUOTES, 'UTF-8') ?></h3>
            <p class="text-[10px] text-muted-fg mb-3 truncate"><?= htmlspecialchars((string)($product['farm']), ENT_QUOTES, 'UTF-8') ?></p>

            <div class="mt-auto">
              <div class="flex items-baseline gap-1 mb-2">
                <span class="font-display text-base text-ink">₱<?= htmlspecialchars((string)($product['price']), ENT_QUOTES, 'UTF-8') ?></span>
                <span class="text-[10px] text-muted-fg"><?= htmlspecialchars((string)($product['unit']), ENT_QUOTES, 'UTF-8') ?></span>
              </div>
              <div class="grid grid-cols-2 gap-1">
                <button class="btn-contact text-[10px] border border-ink/25 px-2 py-1.5
                               hover:border-forest hover:text-forest transition-colors"
                        data-id="<?= htmlspecialchars((string)($product['id']), ENT_QUOTES, 'UTF-8') ?>">
                  Contact
                </button>
                <button class="btn-add-to-cart text-[10px] px-2 py-1.5 font-medium
                               bg-forest text-cream hover:bg-forest/85 transition-all duration-200"
                        data-id="<?= htmlspecialchars((string)($product['id']), ENT_QUOTES, 'UTF-8') ?>">
                  Add to Cart
                </button>
              </div>
            </div>
          </div>

        </div>
      <?php endforeach; ?>

    </div>

    
    <div class="mt-8 flex items-center justify-between">
      <p class="text-xs text-muted-fg">
        Showing <span id="showing-count"><?= htmlspecialchars((string)(count($listings)), ENT_QUOTES, 'UTF-8') ?></span> of <?= htmlspecialchars((string)(count($listings)), ENT_QUOTES, 'UTF-8') ?> products
      </p>
      <div class="flex items-center gap-1">
        <button class="w-8 h-8 flex items-center justify-center border border-ink/20 text-muted-fg
                       hover:border-forest hover:text-forest transition-colors text-xs" disabled>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"/></svg>
        </button>
        <button class="w-8 h-8 flex items-center justify-center border border-forest bg-forest text-cream text-xs font-bold">1</button>
        <button class="w-8 h-8 flex items-center justify-center border border-ink/20 text-muted-fg hover:border-forest hover:text-forest transition-colors text-xs">2</button>
        <button class="w-8 h-8 flex items-center justify-center border border-ink/20 text-muted-fg hover:border-forest hover:text-forest transition-colors text-xs">3</button>
        <button class="w-8 h-8 flex items-center justify-center border border-ink/20 text-muted-fg hover:border-forest hover:text-forest transition-colors text-xs">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
        </button>
      </div>
    </div>

  </div>
</div>


<footer class="bg-ink text-cream/50 py-14 px-6 mt-5">
  <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-5 gap-10">
    <div class="md:col-span-2">
      <div class="mb-4">
        <span class="font-display text-xl font-semibold text-cream">TAMARAW</span>
        <p class="text-[10px] font-bold tracking-widest uppercase text-gold/60 mt-0.5">Trade and Market Access for Rural Agricultural Workers</p>
      </div>
      <p class="text-xs leading-loose max-w-xs">A farm-to-table e-commerce platform with AI-powered farming assistant for the agricultural communities of Baco, Oriental Mindoro.</p>
      <p class="text-xs mt-4 text-cream/30">Capstone Project · 2026<br>Baco, Oriental Mindoro, Philippines</p>
    </div>
    <?php foreach ([
      ['Platform',['Marketplace','AI Assistant','For Cooperatives','Pricing','How It Works']],
      ['Farmers',['Register Farm','List Products','Crop Advisor','Market Prices','Weather Alerts']],
      ['Buyers',['Browse Produce','Wholesale Orders','B2B Portal','Track Orders','Contact Farms']],
    ] as $col): ?>
      <div>
        <h4 class="text-[10px] font-bold tracking-[0.22em] uppercase text-cream mb-4"><?= htmlspecialchars((string)($col[0]), ENT_QUOTES, 'UTF-8') ?></h4>
        <ul class="space-y-2.5">
          <?php foreach ($col[1] as $link): ?>
            <li><a href="#" class="text-xs hover:text-cream transition-colors"><?= htmlspecialchars((string)($link), ENT_QUOTES, 'UTF-8') ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="max-w-7xl mx-auto mt-10 pt-8 border-t border-cream/10 flex flex-col md:flex-row justify-between gap-2 text-xs">
    <p>© 2026 TAMARAW Platform. All rights reserved.</p>
    <p>Empowering Baco's farming communities · Baco, Oriental Mindoro</p>
  </div>
</footer>




<div id="modal-contact" class="fixed inset-0 z-50 hidden items-end sm:items-center justify-center">
  <div id="modal-contact-backdrop" class="absolute inset-0 bg-ink/50 backdrop-blur-sm"></div>

  <div class="relative bg-cream w-full sm:max-w-md sm:mx-4 border border-ink/10 shadow-2xl z-10">

    
    <div class="flex items-center justify-between p-5 border-b border-ink/10">
      <div>
        <p class="text-[10px] font-bold tracking-widest uppercase text-muted-fg mb-0.5">Contact Farm</p>
        <p id="cf-farm" class="font-display font-light text-ink text-lg"></p>
      </div>
      <button id="modal-contact-close" class="text-muted-fg hover:text-ink transition-colors">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    
    <div class="p-5 space-y-4">

      
      <div class="flex items-start gap-4 p-4 bg-muted/40 border border-ink/10">
        <div class="w-12 h-12 shrink-0 overflow-hidden bg-muted">
          <img id="cf-img" src="" alt="" class="w-full h-full object-cover"/>
        </div>
        <div>
          <p id="cf-product" class="text-sm font-medium text-ink"></p>
          <p id="cf-brgy" class="text-xs text-muted-fg mt-0.5"></p>
          <p class="text-xs text-muted-fg mt-0.5">Price: <span id="cf-price" class="text-ink font-medium"></span></p>
        </div>
      </div>

      
      <div>
        <p class="text-[10px] font-bold tracking-widest uppercase text-muted-fg mb-3">Reach the Farm</p>
        <div class="space-y-2">
          <a href="#" class="flex items-center gap-3 px-4 py-3 border border-ink/15
                             hover:border-forest hover:text-forest transition-colors group">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                 class="text-muted-fg group-hover:text-forest transition-colors shrink-0">
              <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.09 9.8 19.79 19.79 0 01.22 1.18 2 2 0 012.2 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.09a16 16 0 006 6l.66-.66a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
            </svg>
            <div>
              <p class="text-xs font-medium text-ink group-hover:text-forest transition-colors">Call / SMS</p>
              <p class="text-[10px] text-muted-fg">Contact via phone</p>
            </div>
          </a>
          <a href="#" class="flex items-center gap-3 px-4 py-3 border border-ink/15
                             hover:border-forest hover:text-forest transition-colors group">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                 class="text-muted-fg group-hover:text-forest transition-colors shrink-0">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
            <div>
              <p class="text-xs font-medium text-ink group-hover:text-forest transition-colors">Send Message</p>
              <p class="text-[10px] text-muted-fg">Via TAMARAW messaging</p>
            </div>
          </a>
          <a href="#" class="flex items-center gap-3 px-4 py-3 border border-ink/15
                             hover:border-forest hover:text-forest transition-colors group">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                 class="text-muted-fg group-hover:text-forest transition-colors shrink-0">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <div>
              <p class="text-xs font-medium text-ink group-hover:text-forest transition-colors">View Farm Location</p>
              <p id="cf-brgy-link" class="text-[10px] text-muted-fg"></p>
            </div>
          </a>
        </div>
      </div>

      
      <p class="text-[11px] text-muted-fg leading-relaxed border-t border-ink/10 pt-4">
        Farm contact details are shared after account verification. Sign in or create a free account to connect directly with this farm.
      </p>

    </div>

    <div class="px-5 pb-5">
      <a href="/register"
         class="block w-full text-center text-xs font-medium bg-forest text-cream
                px-4 py-3 hover:bg-forest/85 transition-colors">
        Create Free Account to Connect
      </a>
    </div>

  </div>
</div>




<div id="modal-cart" class="fixed inset-0 z-50 hidden items-end sm:items-center justify-center">
  
  <div id="modal-cart-backdrop"
       class="absolute inset-0 bg-ink/50 backdrop-blur-sm transition-opacity duration-300"></div>

  
  <div class="relative bg-cream w-full sm:max-w-lg sm:mx-4 border border-ink/10
              shadow-2xl z-10 overflow-hidden"
       style="max-height:92dvh">

    
    <div class="flex border-b border-ink/10">
      <div id="step-tab-1"
           class="flex-1 py-2.5 text-center text-[10px] font-bold tracking-widest uppercase
                  transition-colors border-b-2 border-forest text-forest">
        1 · Product
      </div>
      <div id="step-tab-2"
           class="flex-1 py-2.5 text-center text-[10px] font-bold tracking-widest uppercase
                  transition-colors border-b-2 border-transparent text-muted-fg">
        2 · Review &amp; Deliver
      </div>
    </div>

    
    <div class="overflow-hidden">
      <div id="modal-steps"
           class="flex transition-transform duration-300 ease-in-out"
           style="width:200%">

        
        
        
        <div class="w-1/2 overflow-y-auto" style="max-height:80dvh">

          
          <div class="flex items-start justify-between p-5 border-b border-ink/10">
            <div class="flex gap-4">
              <div class="w-20 h-20 shrink-0 overflow-hidden bg-muted">
                <img id="mc-img" src="" alt=""
                     class="w-full h-full object-cover"/>
              </div>
              <div class="min-w-0">
                <p id="mc-category"
                   class="text-[9px] font-bold tracking-widest uppercase text-muted-fg mb-0.5"></p>
                <p id="mc-name"
                   class="font-display font-light text-ink text-lg leading-snug"></p>
                <p id="mc-farm" class="text-xs text-muted-fg mt-0.5"></p>
                <div id="mc-verified-badge"
                     class="hidden mt-1 inline-flex items-center gap-1
                            text-[10px] text-forest font-semibold">
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="#1E5631">
                    <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806
                             3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806
                             3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946
                             3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946
                             3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806
                             3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806
                             3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946
                             3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946
                             3.42 3.42 0 013.138-3.138z"/>
                  </svg>
                  Verified Farm
                </div>
              </div>
            </div>
            <button id="modal-cart-close"
                    class="text-muted-fg hover:text-ink transition-colors ml-4 shrink-0 mt-0.5">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
              </svg>
            </button>
          </div>

          <div class="p-5 space-y-5">

            
            <div>
              <p class="text-[10px] font-bold tracking-widest uppercase text-muted-fg mb-2">
                About this Product
              </p>
              <p id="mc-description"
                 class="text-sm text-ink/80 leading-relaxed"></p>
            </div>

            
            <div class="border-t border-ink/10"></div>

            
            <div class="flex items-center justify-between">
              <span class="text-sm text-muted-fg">Unit Price</span>
              <span class="font-display text-2xl text-ink">
                ₱<span id="mc-price"></span>
                <span id="mc-unit" class="text-xs text-muted-fg font-sans ml-1"></span>
              </span>
            </div>

            
            <div>
              <p class="text-[10px] font-bold tracking-widest uppercase text-muted-fg mb-2">
                Order Type
              </p>
              <div class="grid grid-cols-2 gap-2">
                <button id="btn-retail" data-type="retail"
                        class="order-type-btn px-4 py-2.5 text-xs font-semibold border
                               transition-all bg-forest text-cream border-forest">
                  Retail
                </button>
                <button id="btn-bulk" data-type="bulk"
                        class="order-type-btn px-4 py-2.5 text-xs font-semibold border
                               transition-all text-ink border-ink/25
                               hover:border-forest hover:text-forest">
                  Bulk / Wholesale
                </button>
              </div>
              <p id="mc-bulk-note"
                 class="hidden mt-2 text-[11px] text-amber font-medium leading-relaxed">
                ⚡ Bulk orders receive <strong>10% off</strong> automatically.
                Delivery will be coordinated with the farm.
              </p>
            </div>

            
            <div>
              <div class="flex items-center justify-between mb-2">
                <p class="text-[10px] font-bold tracking-widest uppercase text-muted-fg">
                  Quantity
                </p>
                <p class="text-[10px] text-muted-fg">
                  Stock: <span id="mc-stock"></span> kg available
                </p>
              </div>
              <div class="flex items-center gap-0 mb-1.5">
                <button id="mc-qty-minus"
                        class="w-10 h-10 border border-ink/20 flex items-center justify-center
                               text-ink hover:border-forest hover:text-forest transition-colors text-lg
                               select-none">−</button>
                <input id="mc-qty" type="number" value="1" min="1"
                       class="w-20 h-10 border-y border-ink/20 text-center text-sm text-ink
                              bg-transparent focus:outline-none"/>
                <button id="mc-qty-plus"
                        class="w-10 h-10 border border-ink/20 flex items-center justify-center
                               text-ink hover:border-forest hover:text-forest transition-colors text-lg
                               select-none">+</button>
                <span class="ml-3 text-xs text-muted-fg">kg</span>
              </div>
              <p class="text-[11px] text-muted-fg">
                Min. order: <span id="mc-min-order"></span>
              </p>
            </div>

            
            <div class="bg-muted/50 border border-ink/10 px-4 py-3
                        flex items-center justify-between">
              <div>
                <span class="text-sm text-muted-fg">Subtotal</span>
                <p id="mc-discount-line"
                   class="hidden text-[11px] text-forest font-medium mt-0.5">
                  10% bulk discount applied
                </p>
              </div>
              <span id="mc-subtotal"
                    class="font-display text-2xl text-ink">₱0.00</span>
            </div>

          </div>

          
          <div class="px-5 pb-5 grid grid-cols-2 gap-2 border-t border-ink/10 pt-4">
            <button id="modal-cart-close-2"
                    class="text-xs border border-ink/25 px-4 py-3 text-ink
                           hover:border-forest hover:text-forest transition-colors">
              Cancel
            </button>
            <button id="mc-next"
                    class="text-xs px-4 py-3 font-medium bg-forest text-cream
                           hover:bg-forest/85 transition-colors flex items-center
                           justify-center gap-2">
              Review Order
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2">
                <path d="M9 18l6-6-6-6"/>
              </svg>
            </button>
          </div>

        </div>

        
        
        
        <div class="w-1/2 overflow-y-auto" style="max-height:80dvh">

          <div class="p-5 space-y-5">

            
            <button id="mc-back"
                    class="flex items-center gap-1.5 text-xs text-muted-fg
                           hover:text-ink transition-colors">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2">
                <path d="M15 18l-6-6 6-6"/>
              </svg>
              Back to Product
            </button>

            
            <div class="border border-ink/10">
              <div class="px-4 py-3 border-b border-ink/10 flex items-center gap-3">
                <div class="w-10 h-10 shrink-0 overflow-hidden bg-muted">
                  <img id="rv-img" src="" alt=""
                       class="w-full h-full object-cover"/>
                </div>
                <div class="flex-1 min-w-0">
                  <p id="rv-name"
                     class="text-sm font-medium text-ink truncate"></p>
                  <p id="rv-farm"
                     class="text-[11px] text-muted-fg"></p>
                </div>
                <div class="text-right shrink-0">
                  <p id="rv-qty-label"
                     class="text-xs text-muted-fg"></p>
                  <p id="rv-item-total"
                     class="text-sm font-display text-ink"></p>
                </div>
              </div>

              
              <div class="px-4 py-3 space-y-2.5 text-sm border-b border-ink/10">
                <div class="flex justify-between">
                  <span class="text-muted-fg">Item subtotal</span>
                  <span id="rv-subtotal" class="text-ink"></span>
                </div>
                <div id="rv-discount-row" class="hidden flex justify-between">
                  <span class="text-forest text-xs">Bulk discount (10%)</span>
                  <span id="rv-discount-amt" class="text-forest text-xs">-₱0.00</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-muted-fg">Delivery fee</span>
                  <span id="rv-delivery" class="text-ink"></span>
                </div>
                <div id="rv-promo-row" class="hidden flex justify-between">
                  <span class="text-forest text-xs">Promo code</span>
                  <span id="rv-promo-amt" class="text-forest text-xs">-₱0.00</span>
                </div>
              </div>

              <div class="px-4 py-3 flex justify-between items-baseline">
                <span class="text-sm font-semibold text-ink">Total</span>
                <span id="rv-total"
                      class="font-display text-2xl text-ink"></span>
              </div>
            </div>

            
            <div>
              <p class="text-[10px] font-bold tracking-widest uppercase text-muted-fg mb-2">
                Promo Code
              </p>
              <div class="flex gap-2">
                <input id="promo-input" type="text"
                       placeholder="Enter code (e.g. BACO10)"
                       class="flex-1 border border-ink/20 bg-cream px-3 py-2 text-sm text-ink
                              placeholder:text-muted-fg focus:outline-none focus:border-forest
                              uppercase tracking-widest"/>
                <button id="promo-apply"
                        class="text-xs border border-ink/25 px-4 py-2 text-ink
                               hover:border-forest hover:text-forest transition-colors shrink-0">
                  Apply
                </button>
              </div>
              <p id="promo-msg" class="hidden mt-1.5 text-[11px]"></p>
            </div>

            
            <div>
              <p class="text-[10px] font-bold tracking-widest uppercase text-muted-fg mb-2">
                Delivery Address
              </p>
              <div class="space-y-2">
                <input id="delivery-name" type="text" placeholder="Full name"
                       class="w-full border border-ink/20 bg-cream px-3 py-2 text-sm text-ink
                              placeholder:text-muted-fg focus:outline-none focus:border-forest"/>
                <input id="delivery-phone" type="tel" placeholder="Phone number"
                       class="w-full border border-ink/20 bg-cream px-3 py-2 text-sm text-ink
                              placeholder:text-muted-fg focus:outline-none focus:border-forest"/>
                <select id="delivery-barangay"
                        class="w-full border border-ink/20 bg-cream text-ink px-3 py-2 text-sm
                               focus:outline-none focus:border-forest">
                  <option value="" disabled selected>Select barangay</option>
                  <option>Brgy. Batangan</option>
                  <option>Brgy. San Andres</option>
                  <option>Brgy. Calubian</option>
                  <option>Brgy. Poblacion</option>
                  <option>Brgy. Lumangbayan</option>
                  <option>Brgy. San Ignacio</option>
                  <option>Brgy. Poblacion (Baco proper)</option>
                </select>
                <textarea id="delivery-address" rows="2"
                          placeholder="Street / purok / landmark"
                          class="w-full border border-ink/20 bg-cream px-3 py-2 text-sm text-ink
                                 placeholder:text-muted-fg focus:outline-none focus:border-forest
                                 resize-none"></textarea>
              </div>
              <p class="mt-2 text-[11px] text-muted-fg">
                🚚 Free delivery on orders ₱500 and above.
                Standard fee is <strong class="text-ink">₱50</strong>.
              </p>
            </div>

          </div>

          
          <div class="px-5 pb-5 border-t border-ink/10 pt-4 space-y-2">
            <button id="mc-confirm"
                    class="w-full text-sm px-4 py-3 font-medium bg-forest text-cream
                           hover:bg-forest/85 transition-colors flex items-center
                           justify-center gap-2">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2">
                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6h11
                         M10 19a1 1 0 1 0 2 0M17 19a1 1 0 1 0 2 0"/>
              </svg>
              Confirm &amp; Add to Cart
            </button>
            <p class="text-center text-[11px] text-muted-fg">
              You can review your full cart before placing the order.
            </p>
          </div>

        </div>
        

      </div>
      
    </div>

  </div>
  
</div>

<?php $this->sections[$this->currentSection] = ob_get_clean(); $this->currentSection = null; ?>