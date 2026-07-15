<?php
    $iconColor = $theme === 'dark'
        ? 'text-zinc-400 hover:text-zinc-100'
        : 'text-zinc-500 hover:text-zinc-900';

    $activeColor = $theme === 'dark'
        ? 'text-zinc-100'
        : 'text-zinc-900';

    $isActive = is_active('/cart') !== '';
    $color    = $isActive ? $activeColor : $iconColor;
    $count    = (int) ($value ?? 0);
?>
<a data-ajax-link href="/cart" class="relative <?= e($color) ?> transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6h11M10 19a1 1 0 1 0 2 0M17 19a1 1 0 1 0 2 0"/>
    </svg>

    
    <span id="header-cart-count"
          class="absolute -top-0.5 -right-0.5 text-[10px] font-bold
                 w-4 h-4 rounded-full flex items-center justify-center
                 bg-amber text-ink <?= htmlspecialchars((string)($count < 1 ? 'hidden' : ''), ENT_QUOTES, 'UTF-8') ?>">
        <?= e($count) ?>
    </span>
</a>