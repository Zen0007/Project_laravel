<nav class="fixed top-0 left-0 right-0 z-50 bg-bg/90 backdrop-blur-xl border-b border-border">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

        <a href="#" onclick="showSection('home')" class="font-mono font-bold text-lg tracking-tight">
            <span class="text-neonGreen">~</span><span class="text-textPrimary">/dev.log</span>
        </a>

      {{-- Desktop Links --}}

<div class="hidden md:flex items-center gap-8">
    <a href="#" onclick="showSection('home')" class="nav-link active text-sm font-mono" data-section="home">Home</a>
    <a href="#" onclick="showSection('articles')" class="nav-link text-sm font-mono" data-section="articles">Articles</a>
    <a href="#" onclick="showSection('projects')" class="nav-link text-sm font-mono" data-section="projects">Projects</a>
    <a href="#" onclick="showSection('about')" class="nav-link text-sm font-mono" data-section="about">About</a>
</div>

        {{-- Desktop Actions --}}
        <div class="hidden md:flex items-center gap-3">
            <button onclick="toggleThemeAccent()" class="p-2 rounded-lg hover:bg-surfaceLight transition-colors text-textSecondary hover:text-neonGreen" title="Toggle accent color">
                <i data-lucide="palette" class="w-4 h-4"></i>
            </button>
            <a href="https://github.com" target="_blank" class="p-2 rounded-lg hover:bg-surfaceLight transition-colors text-textSecondary hover:text-neonGreen">
               <i class="fab fa-github"></i>
            </a>
        </div>

        {{-- Hamburger --}}
        <button onclick="toggleMobileMenu()" class="md:hidden p-2 text-textSecondary">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>

    </div>
</nav>
