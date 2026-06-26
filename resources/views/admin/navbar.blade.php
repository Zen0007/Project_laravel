<nav class="fixed top-0 left-0 right-0 z-50 bg-bg/90 backdrop-blur-xl border-b border-border">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

        <a href="{{ route('admin.index') }}" class="font-mono font-bold text-lg tracking-tight">
            <span class="text-neonGreen">~</span>
            <span class="text-textPrimary">/dev.log</span>
        </a>

        @include('admin.navbar-desktop')

        <button
            id="mobileMenuBtn"
            class="md:hidden p-2 text-textSecondary hover:text-neonGreen transition-colors"
        >
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>

    </div>

    @include('admin.navbar-mobile')
</nav>