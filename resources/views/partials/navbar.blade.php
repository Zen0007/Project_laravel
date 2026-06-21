<nav class="fixed top-0 left-0 right-0 z-50 bg-bg/90 backdrop-blur-xl border-b border-border">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

        {{-- Logo Brand --}}
        {{-- Jika di admin panel ke root dashboard, jika di halaman publik memicu fungsi SPA scroll --}}
        <a href="{{ Request::is('admin*') ? route('admin.index') : '#' }}" 
           onclick="{{ Request::is('admin*') ? '' : "showSection('home')" }}" 
           class="font-mono font-bold text-lg tracking-tight flex-shrink-0">
            <span class="text-neonGreen">~</span>
            <span class="text-textPrimary">/dev.log</span>
        </a>

        @if(Request::is('admin*'))
            {{-- ========================================== --}}
            {{-- STATE 1: TAMPILAN NAVBAR ADMIN PANEL      --}}
            {{-- ========================================== --}}
            
            {{-- Memuat navigasi tengah & aksi kanan khusus admin --}}
            @include('admin.navbar-desktop')

            {{-- Tombol Burger Menu khusus admin --}}
            <button
                id="mobileMenuBtn"
                class="md:hidden p-2 text-textSecondary hover:text-neonGreen transition-colors"
            >
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

        @else
            {{-- ========================================== --}}
            {{-- STATE 2: TAMPILAN NAVBAR PUBLIC / HOST    --}}
            {{-- ========================================== --}}
            
            {{-- Desktop Links Tengah untuk Halaman Utama --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="#" onclick="showSection('home')" class="nav-link active text-sm font-mono" data-section="home">Home</a>
                <a href="#" onclick="showSection('articles')" class="nav-link text-sm font-mono" data-section="articles">Articles</a>
                <a href="#" onclick="showSection('projects')" class="nav-link text-sm font-mono" data-section="projects">Projects</a>
                <a href="#" onclick="showSection('about')" class="nav-link text-sm font-mono" data-section="about">About</a>
            </div>

            {{-- Desktop Actions Kanan untuk Halaman Utama --}}
            <div class="hidden md:flex items-center gap-3">
                @auth
                    <a href="{{ route('admin.index') }}" class="px-3 py-2 text-xs font-mono rounded-lg border border-neonGreen/30 text-neonGreen hover:bg-neonGreen/10 transition">
                        Admin
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 rounded-lg hover:bg-surfaceLight transition-colors text-textSecondary hover:text-red-400" title="Logout Account">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 text-xs font-mono rounded-lg border border-border hover:border-neonGreen/30 hover:text-neonGreen transition">
                        Login
                    </a>
                @endauth

                <button onclick="toggleThemeAccent()" class="p-2 rounded-lg hover:bg-surfaceLight transition-colors text-textSecondary hover:text-neonGreen">
                    <i data-lucide="palette" class="w-4 h-4"></i>
                </button>

                <a href="https://github.com" target="_blank" class="p-2 rounded-lg hover:bg-surfaceLight transition-colors text-textSecondary hover:text-neonGreen">
                    <i class="fab fa-github"></i>
                </a>
            </div>

            {{-- Hamburger Menu untuk Mobile Halaman Utama --}}
            <button onclick="toggleMobileMenu()" class="md:hidden p-2 text-textSecondary hover:text-neonGreen transition-colors">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>
        @endif

    </div>

    {{-- Laci Mobile Menu (Hanya ditaruh/aktif jika route berada di cakupan area admin) --}}
    @if(Request::is('admin*'))
        @include('admin.navbar-mobile')
    @else
        {{-- Opsional: Jika Anda punya berkas navbar-mobile khusus halaman publik host, bisa dimasukkan di bawah ini --}}
        {{-- @include('pages.navbar-mobile-public') --}}
    @endif
</nav>