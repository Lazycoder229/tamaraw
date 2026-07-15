<?php $this->layout = 'layout.blank'; ?>

<?php $this->currentSection = 'title'; ob_start(); ?> TAMARAW Marketplace <?php $this->sections[$this->currentSection] = ob_get_clean(); $this->currentSection = null; ?>
<?php $this->currentSection = 'page-title'; ob_start(); ?> Welcome <?php $this->sections[$this->currentSection] = ob_get_clean(); $this->currentSection = null; ?>

<?php $this->currentSection = 'content'; ob_start(); ?>


<header class="fixed top-0 inset-x-0 z-50 bg-cream/96 backdrop-blur-sm border-b border-ink/10">
  <div class="max-w-7xl mx-auto px-5 h-16 flex items-center justify-between gap-6">

    
    <div class="flex items-center gap-2.5">
      <div class="w-8 h-8 bg-forest flex items-center justify-center">
        <svg width="20" height="20" viewBox="0 0 32 32" fill="none">
          <path d="M4 20 C4 20 6 12 10 10 C10 10 8 8 9 6 C10 4 13 5 14 7 C14 7 15 6 16 6 C17 6 18 7 18 7 C19 5 22 4 23 6 C24 8 22 10 22 10 C26 12 28 20 28 20 C28 20 24 22 16 22 C8 22 4 20 4 20Z" fill="white"/>
          <circle cx="12" cy="13" r="1.5" fill="#1E5631"/>
          <circle cx="20" cy="13" r="1.5" fill="#1E5631"/>
          <path d="M13 17 C13 17 14.5 18.5 16 18.5 C17.5 18.5 19 17 19 17" stroke="#1E5631" stroke-width="1.2" stroke-linecap="round" fill="none"/>
        </svg>
      </div>
      <div>
        <span class="font-display font-semibold text-ink text-lg tracking-tight">TAMARAW</span>
        <span class="hidden sm:block text-[9px] font-medium tracking-[0.15em] uppercase text-muted-fg -mt-0.5">Baco, Oriental Mindoro</span>
      </div>
    </div>

    
   <nav class="hidden lg:flex items-center gap-7">
<?php foreach ([
    'Marketplace'  => '#marketplace',
    'For Farmers'  => '#how-it-works',
    'AI Assistant' => '#ai',
    'Cooperatives' => '#testimonials',
    'Pricing'      => '#pricing',
] as $link => $anchor): ?>
    <a href="<?= htmlspecialchars((string)($anchor), ENT_QUOTES, 'UTF-8') ?>" class="text-sm text-muted-fg hover:text-ink transition-colors"><?= htmlspecialchars((string)($link), ENT_QUOTES, 'UTF-8') ?></a>
  <?php endforeach; ?>
</nav>

    
    <div class="flex items-center gap-2.5">
      <a href="#" class="hidden sm:inline text-sm text-ink border border-ink/25 px-4 py-2 hover:border-ink transition-colors">Sign In</a>
      <a href="#" class="inline-flex items-center gap-1.5 bg-forest text-cream text-sm px-4 py-2 hover:bg-forest/90 transition-colors">Join Free</a>
      <div id="cart-badge" class="hidden relative p-2 text-ink cursor-pointer">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
          <line x1="3" y1="6" x2="21" y2="6"/>
          <path d="M16 10a4 4 0 01-8 0"/>
        </svg>
        <span id="cart-count" class="absolute -top-0.5 -right-0.5 bg-amber text-ink text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">0</span>
      </div>
      <button id="mobile-nav-toggle" class="lg:hidden p-1">
        <svg id="icon-open" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <line x1="3" y1="6" x2="21" y2="6"/>
          <line x1="3" y1="12" x2="21" y2="12"/>
          <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
        <svg id="icon-close" class="hidden" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <line x1="18" y1="6" x2="6" y2="18"/>
          <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>
  </div>

  
  <div id="mobile-nav" class="hidden lg:hidden bg-cream border-t border-ink/10 px-5 py-5 flex flex-col gap-4">
    <?php foreach (['Marketplace','For Farmers','AI Assistant','Cooperatives','Pricing'] as $link): ?>
      <a href="#" class="text-sm text-ink"><?= htmlspecialchars((string)($link), ENT_QUOTES, 'UTF-8') ?></a>
    <?php endforeach; ?>
  </div>
</header>


<section class="pt-16 min-h-screen grid grid-cols-1 lg:grid-cols-2">
  <div class="flex flex-col justify-center px-8 md:px-14 lg:px-20 py-20 lg:py-28">

    
    <div class="flex border border-ink/20 w-fit mb-8">
      <button data-mode="farmers" class="hero-toggle px-5 py-2 text-xs font-semibold uppercase tracking-widest transition-all bg-forest text-cream">For Farmers</button>
      <button data-mode="buyers" class="hero-toggle px-5 py-2 text-xs font-semibold uppercase tracking-widest transition-all text-muted-fg hover:text-ink">For Buyers</button>
    </div>

    <p class="text-xs font-bold tracking-[0.22em] uppercase text-amber mb-5">Baco, Oriental Mindoro · Est. 2026</p>

    <div id="hero-farmers">
      <h1 class="font-display font-light text-ink leading-[1.03] mb-7" style="font-size:clamp(2.6rem,6vw,5rem)">
        Sell smarter.<br><em class="italic text-forest">Farm better.</em>
      </h1>
      <p class="text-base md:text-lg text-muted-fg leading-relaxed max-w-md mb-10">
        TAMARAW connects farmers in Baco directly to buyers across Oriental Mindoro and beyond.
        List your harvest, set your price, and let our AI tell you what to plant next — all in one platform.
      </p>
    </div>

    <div id="hero-buyers" class="hidden">
      <h1 class="font-display font-light text-ink leading-[1.03] mb-7" style="font-size:clamp(2.6rem,6vw,5rem)">
        Fresh from Baco.<br><em class="italic text-forest">Direct from the farm.</em>
      </h1>
      <p class="text-base md:text-lg text-muted-fg leading-relaxed max-w-md mb-10">
        Order verified, traceable produce straight from farmers in Baco, Oriental Mindoro.
        Whether you're a household, restaurant, or grocery — find consistent supply at fair prices.
      </p>
    </div>

    <div class="flex flex-wrap items-center gap-5">
      <a href="#marketplace" id="hero-cta-primary" class="inline-flex items-center gap-2 bg-forest text-cream text-sm font-medium px-7 py-3.5 hover:bg-forest/90 transition-colors">
        List Your Products
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="#ai" id="hero-cta-secondary" class="inline-flex items-center gap-1.5 text-sm text-ink border-b border-ink/30 hover:border-ink transition-colors pb-px">
        See AI Features
      </a>
    </div>

    <div class="mt-14 pt-8 border-t border-ink/10 grid grid-cols-4 gap-4">
      <?php foreach ([['240+','Registered Farms'],['18','Barangays Served'],['₱4.2M','Sales Facilitated'],['1,200+','Active Buyers']] as $stat): ?>
        <div>
          <div class="font-display text-2xl font-light text-ink"><?= htmlspecialchars((string)($stat[0]), ENT_QUOTES, 'UTF-8') ?></div>
          <div class="text-[11px] text-muted-fg mt-1 leading-snug"><?= htmlspecialchars((string)($stat[1]), ENT_QUOTES, 'UTF-8') ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="relative hidden lg:block bg-muted overflow-hidden">
    <img
      src="https://images.unsplash.com/photo-1761839257870-06874bda71b5?w=960&h=1100&fit=crop&auto=format"
      alt="Farmer using tablet at the farm in Baco, Oriental Mindoro"
      class="w-full h-full object-cover"
    />
    <div class="absolute inset-0 bg-gradient-to-t from-ink/40 via-ink/5 to-transparent"></div>

    <div class="absolute top-10 right-8 bg-white/95 backdrop-blur-sm border border-ink/10 p-4 w-56 shadow-lg">
      <div class="flex items-center gap-2 mb-3">
        <div class="w-2 h-2 rounded-full bg-forest animate-pulse"></div>
        <span class="text-[10px] font-bold tracking-widest uppercase text-forest">AI Advisor Live</span>
      </div>
      <p class="text-xs text-ink leading-relaxed">"Plant Pechay this week. Demand up 28% in Calapan. Expected yield: <strong>450 kg</strong>."</p>
    </div>

    <div class="absolute bottom-8 left-8 right-8">
      <div class="bg-cream/93 backdrop-blur-sm px-5 py-4 flex items-center justify-between">
        <div>
          <p class="text-[10px] font-bold tracking-widest uppercase text-forest">This Week's Top Price</p>
          <p class="font-display text-lg text-ink mt-0.5">Kamatis · ₱75/kg</p>
        </div>
        <span class="text-xs bg-forest/12 text-forest font-bold px-2.5 py-1">↑ 10% vs avg</span>
      </div>
    </div>
  </div>
</section>


<div class="bg-forest text-cream/85 py-3 overflow-hidden">
  <div class="flex gap-10 whitespace-nowrap ticker-scroll">
    <?php foreach ([0,1,2,3] as $i): ?>
      <span class="flex items-center gap-10 text-sm shrink-0">
        <?php foreach (['· Ampalaya ₱45/kg','· Pechay Baguio ₱60/kg','· Kamatis ₱75/kg','· Sitaw ₱55/kg','· Saging na Saba ₱35/kg','· Palay ₱22/kg','· Talong ₱50/kg','· Kangkong ₱40/kg'] as $item): ?>
          <span><?= htmlspecialchars((string)($item), ENT_QUOTES, 'UTF-8') ?></span>
        <?php endforeach; ?>
      </span>
    <?php endforeach; ?>
  </div>
</div>


<section id="marketplace" class="max-w-7xl mx-auto px-6 py-20 md:py-28">
  <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
    <div>
      <p class="text-xs font-bold tracking-[0.22em] uppercase text-amber mb-3">Live Marketplace</p>
      <h2 class="font-display font-light text-ink leading-tight" style="font-size:clamp(2rem,4vw,3rem)">Fresh from Baco's farms</h2>
    </div>
   <div class="flex flex-wrap gap-2" id="category-filters">
  <?php foreach (['All','Vegetables','Fruits','Grains','Livestock','Processed'] as $cat): ?>
    <?php if ($cat === 'All'): ?>
      <button
        data-cat="<?= htmlspecialchars((string)($cat), ENT_QUOTES, 'UTF-8') ?>"
        class="cat-btn px-4 py-1.5 text-xs font-semibold border transition-all duration-200 bg-forest text-cream border-forest"
      ><?= htmlspecialchars((string)($cat), ENT_QUOTES, 'UTF-8') ?></button>
    <?php else: ?>
      <button
        data-cat="<?= htmlspecialchars((string)($cat), ENT_QUOTES, 'UTF-8') ?>"
        class="cat-btn px-4 py-1.5 text-xs font-semibold border transition-all duration-200 bg-transparent text-muted-fg border-ink/20 hover:border-forest/50 hover:text-ink"
      ><?= htmlspecialchars((string)($cat), ENT_QUOTES, 'UTF-8') ?></button>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-px bg-ink/10" id="product-grid">

    <?php
    $listings = [
      ['id'=>1,'name'=>'Ampalaya (Bitter Melon)','farm'=>'Dela Cruz Family Farm','barangay'=>'Brgy. Batangan, Baco','category'=>'Vegetables','price'=>45,'unit'=>'per kg','minOrder'=>'5 kg','stock'=>120,'certified'=>true,'badge'=>'In Season','img'=>'https://images.unsplash.com/photo-1590779033100-9f60a05a013d?w=600&h=680&fit=crop&auto=format'],
      ['id'=>2,'name'=>'Pechay Baguio','farm'=>'Santos Organic Produce','barangay'=>'Brgy. San Andres, Baco','category'=>'Vegetables','price'=>60,'unit'=>'per kg','minOrder'=>'3 kg','stock'=>85,'certified'=>true,'badge'=>'Organic','img'=>'https://images.unsplash.com/photo-1566385101042-1a0aa0c1268c?w=600&h=680&fit=crop&auto=format'],
      ['id'=>3,'name'=>'Saging na Saba','farm'=>'Mendoza Tropical Farms','barangay'=>'Brgy. Calubian, Baco','category'=>'Fruits','price'=>35,'unit'=>'per kg','minOrder'=>'10 kg','stock'=>200,'certified'=>false,'badge'=>'Bulk Available','img'=>'https://images.unsplash.com/photo-1518843875459-f738682238a6?w=600&h=680&fit=crop&auto=format'],
      ['id'=>4,'name'=>'Kamatis (Tomato)','farm'=>'Baco Agri Cooperative','barangay'=>'Brgy. Poblacion, Baco','category'=>'Vegetables','price'=>75,'unit'=>'per kg','minOrder'=>'2 kg','stock'=>60,'certified'=>true,'badge'=>'Best Seller','img'=>'https://images.unsplash.com/photo-1504472685735-9bd4075b3779?w=600&h=680&fit=crop&auto=format'],
      ['id'=>5,'name'=>'Sitaw (Long Beans)','farm'=>'Reyes Highland Farm','barangay'=>'Brgy. Lumangbayan, Baco','category'=>'Vegetables','price'=>55,'unit'=>'per kg','minOrder'=>'3 kg','stock'=>95,'certified'=>false,'badge'=>null,'img'=>'https://images.unsplash.com/photo-1597362925123-77861d3fbac7?w=600&h=680&fit=crop&auto=format'],
      ['id'=>6,'name'=>'Palay (Unmilled Rice)','farm'=>'Baco Rice Growers Assoc.','barangay'=>'Brgy. San Ignacio, Baco','category'=>'Grains','price'=>22,'unit'=>'per kg','minOrder'=>'50 kg','stock'=>2000,'certified'=>false,'badge'=>'Wholesale','img'=>'https://images.unsplash.com/photo-1579113800032-c38bd7635818?w=600&h=680&fit=crop&auto=format'],
    ];
    ?>

    <?php foreach ($listings as $product): ?>
      <div class="product-card group bg-card flex flex-col overflow-hidden" data-category="<?= htmlspecialchars((string)($product['category']), ENT_QUOTES, 'UTF-8') ?>">
        <div class="relative overflow-hidden bg-muted" style="aspect-ratio:4/3">
          <img
            src="<?= htmlspecialchars((string)($product['img']), ENT_QUOTES, 'UTF-8') ?>"
            alt="<?= htmlspecialchars((string)($product['name']), ENT_QUOTES, 'UTF-8') ?>"
            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-[1.04]"
          />
          <?php if ($product['badge']): ?>
            <span class="absolute top-3 left-3 bg-amber text-ink text-[10px] font-bold tracking-wider uppercase px-2.5 py-1"><?= htmlspecialchars((string)($product['badge']), ENT_QUOTES, 'UTF-8') ?></span>
          <?php endif; ?>
          <?php if ($product['certified']): ?>
            <span class="absolute top-3 right-3 bg-white/90 text-forest text-[10px] font-bold px-2 py-1 flex items-center gap-1">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="#1E5631"><path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
              Verified
            </span>
          <?php endif; ?>
        </div>
        <div class="p-5 flex flex-col flex-1">
          <div class="flex items-start justify-between gap-2 mb-1">
            <p class="text-[10px] font-bold tracking-[0.15em] uppercase text-muted-fg"><?= htmlspecialchars((string)($product['category']), ENT_QUOTES, 'UTF-8') ?></p>
            <p class="text-[10px] text-muted-fg">Stock: <?= htmlspecialchars((string)($product['stock']), ENT_QUOTES, 'UTF-8') ?> kg</p>
          </div>
          <h3 class="font-display font-light text-ink text-lg mb-1"><?= htmlspecialchars((string)($product['name']), ENT_QUOTES, 'UTF-8') ?></h3>
          <p class="text-xs text-muted-fg mb-1"><?= htmlspecialchars((string)($product['farm']), ENT_QUOTES, 'UTF-8') ?></p>
          <p class="text-[11px] text-muted-fg/70 mb-4"><?= htmlspecialchars((string)($product['barangay']), ENT_QUOTES, 'UTF-8') ?></p>

          <div class="mt-auto pt-4 border-t border-ink/10">
            <div class="flex items-center justify-between mb-3">
              <div class="flex items-baseline gap-1">
                <span class="font-display text-2xl text-ink">₱<?= htmlspecialchars((string)($product['price']), ENT_QUOTES, 'UTF-8') ?></span>
                <span class="text-xs text-muted-fg"><?= htmlspecialchars((string)($product['unit']), ENT_QUOTES, 'UTF-8') ?></span>
              </div>
              <span class="text-[11px] text-muted-fg border border-ink/15 px-2 py-0.5">Min. <?= htmlspecialchars((string)($product['minOrder']), ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <div class="grid grid-cols-2 gap-2">
              <button class="text-xs border border-ink/25 px-3 py-2 hover:border-forest hover:text-forest transition-colors">Contact Farm</button>
              <button
                class="add-to-cart text-xs px-3 py-2 font-medium bg-forest text-cream hover:bg-forest/85 transition-all duration-200"
                data-id="<?= htmlspecialchars((string)($product['id']), ENT_QUOTES, 'UTF-8') ?>"
              >Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>

  <div class="mt-10 text-center">
   <a href="<?= htmlspecialchars((string)(url('/products')), ENT_QUOTES, 'UTF-8') ?>" class="inline-flex items-center gap-2 text-sm text-ink border border-ink/25 px-8 py-3 hover:border-forest hover:text-forest transition-colors">
  View All Products
  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
</a>
  </div>
</section>


<section id="ai" class="bg-ink text-cream py-20 px-6">
  <div class="max-w-7xl mx-auto">
    <div class="mb-12">
      <p class="text-xs font-bold tracking-[0.22em] uppercase text-gold mb-3">AI-Powered Farming Assistant</p>
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <h2 class="font-display font-light text-cream leading-tight max-w-xl" style="font-size:clamp(2rem,4vw,3rem)">
          Your smart farming advisor,<br><em class="italic text-gold">built for Baco.</em>
        </h2>
        <p class="text-cream/55 text-sm max-w-xs leading-relaxed">
          Trained on Oriental Mindoro market data, local weather patterns, and soil profiles from Baco's farming communities.
        </p>
      </div>
    </div>

    
    <div class="flex flex-wrap gap-2 mb-8">
      <?php foreach ([['crop','🌱','Crop Advisor'],['market','📊','Market Prices'],['weather','🌤','Weather & Alerts'],['calendar','📅','Planting Calendar']] as $tab): ?>
        <button
          data-ai="<?= htmlspecialchars((string)($tab[0]), ENT_QUOTES, 'UTF-8') ?>"
          class="ai-tab flex items-center gap-2 px-4 py-2.5 text-sm font-medium border transition-all duration-200 <?= htmlspecialchars((string)($tab[0] === 'crop' ? 'bg-gold text-ink border-gold' : 'bg-transparent text-cream/60 border-cream/15 hover:border-cream/40 hover:text-cream'), ENT_QUOTES, 'UTF-8') ?>"
        >
          <span><?= htmlspecialchars((string)($tab[1]), ENT_QUOTES, 'UTF-8') ?></span>
          <span><?= htmlspecialchars((string)($tab[2]), ENT_QUOTES, 'UTF-8') ?></span>
        </button>
      <?php endforeach; ?>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
      <div>
        <h3 id="ai-headline" class="font-display font-light text-cream text-2xl mb-4">AI-powered planting recommendations</h3>
        <p id="ai-desc" class="text-cream/60 leading-relaxed mb-6">Get personalized crop suggestions based on your soil type, current season, local weather patterns, and real-time market demand in Oriental Mindoro.</p>
        <a href="#" class="inline-flex items-center gap-2 bg-gold text-ink text-sm font-medium px-6 py-3 hover:bg-gold/90 transition-colors">
          Try AI Assistant Free
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>

      <div id="ai-panel">
        
        <div id="panel-crop" class="ai-panel-content bg-ai-light border border-ai/15 p-5 space-y-3">
          <p class="text-xs font-bold tracking-widest uppercase text-ai mb-4">This Season's Top Recommendation</p>
          <?php foreach ([['Pechay Baguio','High demand in Calapan market · Low competition · 45-day harvest','+₱18,400 projected'],['Sitaw','Favorable rainfall forecast · Matches your soil profile','+₱12,200 projected'],['Ampalaya','Peak pricing season (Jul–Sep) · Fast turnover','+₱9,600 projected']] as $item): ?>
            <div class="bg-white border border-ai/10 p-4 flex items-start justify-between gap-4">
              <div>
                <p class="font-semibold text-sm text-ink"><?= htmlspecialchars((string)($item[0]), ENT_QUOTES, 'UTF-8') ?></p>
                <p class="text-xs text-muted-fg mt-0.5 leading-relaxed"><?= htmlspecialchars((string)($item[1]), ENT_QUOTES, 'UTF-8') ?></p>
              </div>
              <span class="text-xs font-bold text-forest whitespace-nowrap bg-forest/10 px-2 py-1"><?= htmlspecialchars((string)($item[2]), ENT_QUOTES, 'UTF-8') ?></span>
            </div>
          <?php endforeach; ?>
        </div>

        
        <div id="panel-market" class="ai-panel-content hidden bg-ai-light border border-ai/15 p-5">
          <p class="text-xs font-bold tracking-widest uppercase text-ai mb-4">Today's Farm-Gate Prices vs. Average</p>
          <div class="grid grid-cols-4 gap-2 text-[10px] font-bold tracking-wider uppercase text-muted-fg pb-2 border-b border-ink/10">
            <span>Crop</span><span class="text-right">Your Price</span><span class="text-right">Mkt Avg</span><span class="text-right">Trend</span>
          </div>
          <?php foreach ([['Kamatis',75,68,'up'],['Ampalaya',45,50,'down'],['Pechay',60,58,'up'],['Sitaw',55,55,'flat'],['Talong',50,44,'up']] as $row): ?>
            <div class="grid grid-cols-4 gap-2 py-2.5 border-b border-ink/6 text-sm">
              <span class="font-medium text-ink"><?= htmlspecialchars((string)($row[0]), ENT_QUOTES, 'UTF-8') ?></span>
              <span class="text-right font-semibold text-ink">₱<?= htmlspecialchars((string)($row[1]), ENT_QUOTES, 'UTF-8') ?></span>
              <span class="text-right text-muted-fg">₱<?= htmlspecialchars((string)($row[2]), ENT_QUOTES, 'UTF-8') ?></span>
              <span class="text-right font-bold <?= htmlspecialchars((string)($row[3] === 'up' ? 'text-forest' : ($row[3] === 'down' ? 'text-sienna' : 'text-muted-fg')), ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars((string)($row[3] === 'up' ? '↑' : ($row[3] === 'down' ? '↓' : '→')), ENT_QUOTES, 'UTF-8') ?>
              </span>
            </div>
          <?php endforeach; ?>
        </div>

        
        <div id="panel-weather" class="ai-panel-content hidden bg-ai-light border border-ai/15 p-5 space-y-3">
          <p class="text-xs font-bold tracking-widest uppercase text-ai mb-4">Active Alerts for Baco, Oriental Mindoro</p>
          <?php foreach ([
            ['warning','Typhoon Signal No. 1 forecast within 72 hours. Harvest mature Kamatis before Thursday.','2 hours ago'],
            ['info','Diamondback moth activity detected in nearby barangays. Apply BT spray preventively on Pechay.','1 day ago'],
            ['ok','Optimal planting window for root crops: July 18–25. Soil moisture levels are ideal.','July 15, 2026'],
          ] as $alert): ?>
            <?php
              $levelClass = $alert[0] === 'warning'
                ? 'bg-amber/15 border-amber/40 text-amber'
                : ($alert[0] === 'info' ? 'bg-ai-light border-ai/30 text-ai' : 'bg-forest/10 border-forest/30 text-forest');
              $levelLabel = $alert[0] === 'warning' ? '⚠ WARNING' : ($alert[0] === 'info' ? 'ℹ INFO' : '✓ GOOD');
            ?>
            <div class="border p-4 <?= htmlspecialchars((string)($levelClass), ENT_QUOTES, 'UTF-8') ?>">
              <div class="flex items-center justify-between mb-1">
                <span class="text-[10px] font-bold tracking-widest"><?= htmlspecialchars((string)($levelLabel), ENT_QUOTES, 'UTF-8') ?></span>
                <span class="text-[10px] opacity-60"><?= htmlspecialchars((string)($alert[2]), ENT_QUOTES, 'UTF-8') ?></span>
              </div>
              <p class="text-xs leading-relaxed text-ink"><?= htmlspecialchars((string)($alert[1]), ENT_QUOTES, 'UTF-8') ?></p>
            </div>
          <?php endforeach; ?>
        </div>

        
        <div id="panel-calendar" class="ai-panel-content hidden bg-ai-light border border-ai/15 p-5">
          <p class="text-xs font-bold tracking-widest uppercase text-ai mb-4">Your Planting Schedule — Q3 2026</p>
          <div class="grid grid-cols-2 gap-3">
            <?php foreach ([['Jul',['Pechay','Kangkong'],'Plant now'],['Aug',['Sitaw','Ampalaya'],'Prepare beds'],['Sep',['Kamatis','Talong'],'Schedule seedling'],['Oct',['Kamote','Gabi'],'Upcoming']] as $row): ?>
              <?php
                $statusClass = $row[2] === 'Plant now'
                  ? 'bg-forest text-cream'
                  : ($row[2] === 'Prepare beds' ? 'bg-amber text-ink' : 'bg-muted text-muted-fg');
              ?>
              <div class="bg-white border border-ink/10 p-4">
                <div class="flex items-center justify-between mb-3">
                  <span class="font-display text-2xl font-light text-ink"><?= htmlspecialchars((string)($row[0]), ENT_QUOTES, 'UTF-8') ?></span>
                  <span class="text-[10px] font-bold px-2 py-0.5 <?= htmlspecialchars((string)($statusClass), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars((string)($row[2]), ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="flex flex-wrap gap-1">
                  <?php foreach ($row[1] as $crop): ?>
                    <span class="text-xs bg-forest/8 text-forest px-2 py-0.5"><?= htmlspecialchars((string)($crop), ENT_QUOTES, 'UTF-8') ?></span>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section id="how-it-works" class="max-w-7xl mx-auto px-6 py-20 md:py-28">
  <p class="text-xs font-bold tracking-[0.22em] uppercase text-amber mb-3">How It Works</p>
  <h2 class="font-display font-light text-ink leading-tight mb-16" style="font-size:clamp(2rem,4vw,3rem)">
    Simple for farmers.<br><em class="italic text-forest">Easy for buyers.</em>
  </h2>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20">
    <div>
      <p class="text-xs font-bold tracking-widest uppercase text-forest border-b border-forest/30 pb-3 mb-8">For Farmers & Cooperatives</p>
      <div class="space-y-8">
        <?php foreach ([
          ['01','Register your farm','Create your free TAMARAW farm profile. Add your location, farm type, and certifications. Takes 5 minutes.'],
          ['02','List your harvest','Post what you have available — quantity, price, minimum order, photos. Reach buyers across Oriental Mindoro instantly.'],
          ['03','Get AI guidance','The AI Farming Assistant analyzes your crops against market demand, weather, and pricing data to maximize your yield and profit.'],
          ['04','Fulfill and grow','Receive orders, arrange pickup or delivery, collect payment. Build your buyer network and watch your income grow.'],
        ] as $step): ?>
          <div class="flex gap-5">
            <span class="font-display text-3xl font-light text-muted shrink-0 mt-0.5"><?= htmlspecialchars((string)($step[0]), ENT_QUOTES, 'UTF-8') ?></span>
            <div>
              <h4 class="font-semibold text-ink mb-1"><?= htmlspecialchars((string)($step[1]), ENT_QUOTES, 'UTF-8') ?></h4>
              <p class="text-sm text-muted-fg leading-relaxed"><?= htmlspecialchars((string)($step[2]), ENT_QUOTES, 'UTF-8') ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div>
      <p class="text-xs font-bold tracking-widest uppercase text-sienna border-b border-sienna/30 pb-3 mb-8">For Buyers (B2C & B2B)</p>
      <div class="space-y-8">
        <?php foreach ([
          ['01','Browse verified farms','Search by crop, location, certification, and price. Every farm on TAMARAW is verified with a registered farm in Baco.'],
          ['02','Order direct or wholesale','Individual buyers order by the kilo. Restaurants and retailers use our wholesale tools for recurring bulk orders and purchase orders.'],
          ['03','Track your order','From harvest confirmation to delivery or pickup, you see every step. Know exactly which farm your food came from.'],
          ['04','Build lasting supply chains','Subscribe to weekly deliveries, set preferred farms, and lock in pricing — build reliable supply relationships with Baco farmers.'],
        ] as $step): ?>
          <div class="flex gap-5">
            <span class="font-display text-3xl font-light text-muted shrink-0 mt-0.5"><?= htmlspecialchars((string)($step[0]), ENT_QUOTES, 'UTF-8') ?></span>
            <div>
              <h4 class="font-semibold text-ink mb-1"><?= htmlspecialchars((string)($step[1]), ENT_QUOTES, 'UTF-8') ?></h4>
              <p class="text-sm text-muted-fg leading-relaxed"><?= htmlspecialchars((string)($step[2]), ENT_QUOTES, 'UTF-8') ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>


<section id="testimonials" class="bg-muted py-20 px-6">
  <div class="max-w-7xl mx-auto">
    <p class="text-xs font-bold tracking-[0.22em] uppercase text-amber mb-12 text-center">From the TAMARAW Community</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <?php foreach ([
        ['farmer','"Dati hindi ko alam kung magkano dapat ibenta ang aking ampalaya. Sa TAMARAW, nakikita ko ang presyo sa merkado araw-araw at nagagawa kong magdesisyon kung kailan magbenta."','Rodrigo Dela Cruz','Vegetable Farmer, Brgy. Batangan','https://images.unsplash.com/photo-1741874299706-2b8e16839aaa?w=120&h=120&fit=crop&auto=format','Income up 42%'],
        ['buyer','"We supply three restaurants in Puerto Galera with vegetables sourced through TAMARAW. The produce quality is excellent, traceability is clear, and the farmers get a fair price."','Chef Maria Concepcion','Owner, Tamarind Kitchen, Puerto Galera','https://images.unsplash.com/photo-1577219492769-b63a779fac28?w=120&h=120&fit=crop&auto=format','Sourcing from 6 farms'],
        ['cooperative','"Ang aming kooperatiba ay may 48 miyembro. Simula nang sumali kami sa TAMARAW, naisaayos na ang aming mga bulk orders at tumaas ang aming kolektibong kita ng 38 porsyento."','Engr. Josephine Reyes','President, Baco Farmers Cooperative','https://images.unsplash.com/photo-1682363261741-4607aa65abbf?w=120&h=120&fit=crop&auto=format','+38% cooperative income'],
      ] as $t): ?>
        <blockquote class="bg-cream p-7 flex flex-col">
          <div class="flex items-center gap-3 mb-5">
            <img src="<?= htmlspecialchars((string)($t[4]), ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars((string)($t[2]), ENT_QUOTES, 'UTF-8') ?>" class="w-10 h-10 object-cover"/>
            <div>
              <p class="font-semibold text-sm text-ink"><?= htmlspecialchars((string)($t[2]), ENT_QUOTES, 'UTF-8') ?></p>
              <p class="text-xs text-muted-fg"><?= htmlspecialchars((string)($t[3]), ENT_QUOTES, 'UTF-8') ?></p>
            </div>
          </div>
          <p class="text-sm text-ink leading-relaxed flex-1 mb-5 italic"><?= htmlspecialchars((string)($t[1]), ENT_QUOTES, 'UTF-8') ?></p>
          <span class="text-xs font-bold text-forest bg-forest/10 px-2.5 py-1 w-fit"><?= htmlspecialchars((string)($t[5]), ENT_QUOTES, 'UTF-8') ?></span>
        </blockquote>
      <?php endforeach; ?>

    </div>
  </div>
</section>


<section id="pricing" class="max-w-7xl mx-auto px-6 py-20 md:py-28">
  <div class="text-center mb-14">
    <p class="text-xs font-bold tracking-[0.22em] uppercase text-amber mb-3">Pricing</p>
    <h2 class="font-display font-light text-ink" style="font-size:clamp(2rem,4vw,3rem)">
      Plans for every farm,<br><em class="italic text-forest">big or small.</em>
    </h2>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-ink/10">

    <?php foreach ([
      ['Magsasaka Free','For farmers getting started',0,'forever',false,'Start for Free',['List up to 5 products','Basic AI crop tips (weekly)','Market price snapshot','Direct buyer messaging','TAMARAW marketplace listing']],
      ['Pro Farmer','For active sellers',299,'per month',true,'Start 30-Day Free Trial',['Unlimited product listings','Full AI Crop Advisor (daily)','Live market price intelligence','Weather & pest alerts','Personalized planting calendar','Priority buyer matching','Sales analytics dashboard']],
      ['Kooperatiba','For cooperatives & groups',999,'per month',false,'Contact Us',['Everything in Pro Farmer','Up to 50 member accounts','Collective bulk order management','Cooperative inventory pooling','B2B wholesale pricing tools','Dedicated account manager','Custom cooperative landing page']],
    ] as $plan): ?>
      <div class="bg-card p-8 flex flex-col <?= htmlspecialchars((string)($plan[4] ? 'ring-2 ring-forest relative' : ''), ENT_QUOTES, 'UTF-8') ?>">
        <?php if ($plan[4]): ?>
          <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-forest text-cream text-[10px] font-bold tracking-widest uppercase px-3 py-1">Most Popular</span>
        <?php endif; ?>
        <p class="text-xs font-bold tracking-widest uppercase text-muted-fg mb-1"><?= htmlspecialchars((string)($plan[1]), ENT_QUOTES, 'UTF-8') ?></p>
        <h3 class="font-display text-xl font-semibold text-ink mb-4"><?= htmlspecialchars((string)($plan[0]), ENT_QUOTES, 'UTF-8') ?></h3>
        <div class="flex items-baseline gap-1.5 mb-6 pb-6 border-b border-ink/10">
          <?php if ($plan[2] === 0): ?>
            <span class="font-display text-4xl font-light">Free</span>
          <?php else: ?>
            <span class="font-display text-4xl font-light">₱<?= htmlspecialchars((string)($plan[2]), ENT_QUOTES, 'UTF-8') ?></span>
            <span class="text-xs text-muted-fg"><?= htmlspecialchars((string)($plan[3]), ENT_QUOTES, 'UTF-8') ?></span>
          <?php endif; ?>
        </div>
        <ul class="space-y-3 mb-8 flex-1">
          <?php foreach ($plan[6] as $feature): ?>
            <li class="flex items-start gap-2.5 text-sm text-ink">
              <svg class="text-forest mt-0.5 shrink-0" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
              <?= htmlspecialchars((string)($feature), ENT_QUOTES, 'UTF-8') ?>
            </li>
          <?php endforeach; ?>
        </ul>
        <a href="#" class="text-sm font-medium text-center px-6 py-3 transition-colors <?= htmlspecialchars((string)($plan[4] ? 'bg-forest text-cream hover:bg-forest/90' : 'border border-ink/25 text-ink hover:border-forest hover:text-forest'), ENT_QUOTES, 'UTF-8') ?>">
          <?= htmlspecialchars((string)($plan[5]), ENT_QUOTES, 'UTF-8') ?>
        </a>
      </div>
    <?php endforeach; ?>

  </div>
</section>


<section class="bg-forest text-cream py-20 px-6 relative overflow-hidden">
  <div class="absolute inset-0 opacity-8" style="background-image:radial-gradient(circle at center,rgba(240,180,41,0.3) 1px,transparent 1.5px);background-size:28px 28px;"></div>
  <div class="max-w-3xl mx-auto text-center relative">
    <p class="text-xs font-bold tracking-[0.22em] uppercase text-gold mb-4">Join TAMARAW Today</p>
    <h2 class="font-display font-light text-cream leading-tight mb-6" style="font-size:clamp(2rem,5vw,3.5rem)">
      Built for the farmers of<br><em class="italic text-gold">Baco, Oriental Mindoro.</em>
    </h2>
    <p class="text-cream/60 text-base leading-relaxed mb-10 max-w-lg mx-auto">
      Whether you grow a quarter-hectare of pechay or manage a 10-hectare rice farm,
      TAMARAW gives you the tools, the market access, and the AI guidance to grow your income.
    </p>
    <div class="flex flex-wrap items-center justify-center gap-4">
      <a href="#" class="inline-flex items-center gap-2 bg-cream text-forest text-sm font-medium px-8 py-4 hover:bg-cream/90 transition-colors">
        Register as a Farmer
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="#" class="inline-flex items-center gap-2 bg-transparent text-cream text-sm font-medium px-8 py-4 border border-cream/30 hover:border-cream transition-colors">
        Browse as a Buyer
      </a>
    </div>
  </div>
</section>


<section class="border-b border-ink/10 py-14 px-6">
  <div class="max-w-lg mx-auto text-center">
    <h3 class="font-display font-light text-ink text-2xl mb-2">Market updates, every Friday.</h3>
    <p class="text-sm text-muted-fg mb-6">Weekly farm-gate prices, crop advisories, and platform news for Baco farmers and buyers.</p>
    <div id="newsletter-success" class="hidden text-forest font-medium text-sm">Salamat! We'll see you this Friday.</div>
    <div id="newsletter-form" class="flex max-w-sm mx-auto">
      <input
        type="email"
        id="newsletter-email"
        placeholder="your@email.com"
        class="flex-1 bg-white border border-ink/20 border-r-0 px-4 py-3 text-sm text-ink placeholder:text-muted-fg focus:outline-none focus:border-forest"
      />
      <button id="newsletter-submit" class="bg-forest text-cream text-sm font-medium px-5 py-3 hover:bg-forest/90 transition-colors whitespace-nowrap">
        Subscribe
      </button>
    </div>
  </div>
</section>


<footer class="bg-ink text-cream/50 py-14 px-6">
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

<style>
  @keyframes ticker { from { transform: translateX(0) } to { transform: translateX(-25%) } }
  .ticker-scroll { animation: ticker 30s linear infinite; }
</style>

<?php $this->sections[$this->currentSection] = ob_get_clean(); $this->currentSection = null; ?>
