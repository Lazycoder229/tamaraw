<?php $this->layout = 'layout.blank'; ?>

<?php $this->currentSection = 'content'; ob_start(); ?>
<!-- ============================================================ -->
<!-- HEADER (simplified — brings user back home) -->
<!-- ============================================================ -->
<header class="w-full border-b border-zinc-200 bg-cream">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-md flex items-center justify-center text-white text-sm">
                <img src="<?= htmlspecialchars((string)(url('logo2.png')), ENT_QUOTES, 'UTF-8') ?>" alt="Tamaraw Logo" class="w-12 h-12" />
            </div>
            <div class="leading-tight">
                <h1 class="font-semibold text-sm">TAMARAW</h1>
                <p class="text-[10px] text-zinc-500">Ecommerce Platform</p>
            </div>
        </a>

        <a href="<?= htmlspecialchars((string)(route('auth.create')), ENT_QUOTES, 'UTF-8') ?>" class="px-4 py-2 text-sm bg-forest text-white hover:bg-forest/90 transition">
            Join Free
        </a>
    </div>
</header>

<!-- ============================================================ -->
<!-- LOGIN -->
<!-- ============================================================ -->
<div class="min-h-[calc(100vh-73px)] bg-cream flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <p class="text-xs tracking-widest text-amber mb-3">WELCOME BACK</p>
            <h1 class="text-3xl font-display text-ink leading-tight">Sign in to TAMARAW</h1>
            <p class="mt-2 text-sm text-zinc-500">Access your marketplace, orders, and AI farming assistant.</p>
        </div>

        <?php if (isset($errors) && count($errors)): ?>
        <div class="mb-6 border border-red-200 bg-red-50 text-red-700 text-xs px-4 py-3">
            <ul class="list-disc list-inside space-y-1">
                <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars((string)($error), ENT_QUOTES, 'UTF-8') ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <form action="/login" method="POST" class="bg-white border border-zinc-200 p-6 space-y-5">
            <?= csrf_field() ?>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-medium text-zinc-600 mb-1">Email address</label>
                <input type="email" id="email" name="email" required maxlength="150"
                       value="<?= htmlspecialchars((string)(old('email')), ENT_QUOTES, 'UTF-8') ?>"
                       placeholder="your@email.com"
                       class="w-full px-3 py-2.5 text-sm border border-zinc-300 focus:outline-none focus:border-forest">
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label for="password" class="block text-xs font-medium text-zinc-600">Password</label>
                    <a href="/forgot-password" class="text-xs text-forest hover:underline">Forgot password?</a>
                </div>
                <input type="password" id="password" name="password" required
                       class="w-full px-3 py-2.5 text-sm border border-zinc-300 focus:outline-none focus:border-forest">
            </div>

            <!-- Remember me -->
            <label class="flex items-center gap-2 text-xs text-zinc-500">
                <input type="checkbox" name="remember">
                <span>Keep me signed in</span>
            </label>

            <button type="submit" class="w-full px-5 py-3 bg-forest text-white text-sm hover:bg-forest/90 transition">
                Sign in
            </button>
        </form>

        <p class="text-center text-sm text-zinc-500 mt-6">
            Don't have an account?
            <a href="<?= htmlspecialchars((string)(route('auth.create')), ENT_QUOTES, 'UTF-8') ?>" class="text-forest font-medium hover:underline">Create one</a>
        </p>
    </div>
</div>
<?php $this->sections[$this->currentSection] = ob_get_clean(); $this->currentSection = null; ?>