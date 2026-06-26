{{-- Mobile Slide Menu --}}
<div class="mobile-menu fixed top-0 right-0 w-72 h-full bg-surface z-50 border-l border-border p-6" id="mobileMenu">
    <div class="flex justify-between items-center mb-8">
        <span class="font-mono text-neonGreen text-sm">Navigation</span>
        <button onclick="toggleMobileMenu()" class="text-textSecondary hover:text-neonGreen">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>
    
<div class="flex flex-col gap-4">
    @if(Request::is('admin*'))
        {{-- State Terbuka di Halaman Admin Dashboard --}}
        <a href="/" class="text-sm font-mono text-textSecondary hover:text-neonGreen py-2">Home</a>
        <a href="{{ route('admin.index') }}" class="text-sm font-mono text-neonGreen font-bold py-2">Articles</a>
    @else
        {{-- State Terbuka di Halaman Utama User --}}
        <a href="#" onclick="showSection('home'); toggleMobileMenu();" class="nav-link active text-sm font-mono" data-section="home">Home</a>
        <a href="#" onclick="showSection('articles'); toggleMobileMenu();" class="nav-link text-sm font-mono" data-section="articles">Articles</a>
        <a href="#" onclick="showSection('projects'); toggleMobileMenu();" class="nav-link text-sm font-mono" data-section="projects">Projects</a>
        <a href="#" onclick="showSection('about'); toggleMobileMenu();" class="nav-link text-sm font-mono" data-section="about">About</a>
    @endif
</div>

    <!-- Pembatas Garis Tipis (Divider) -->
    <div class="border-t border-border/50 my-4"></div>

    <div>
        {{-- Autentikasi untuk Mobile --}}
        @auth
            @if(!Request::is('admin*'))
                <a href="{{ route('admin.index') }}" class="block font-mono text-sm text-neonGreen hover:underline py-2">
                    ~/ Admin Panel
                </a>
            @endif
            
            <form action="{{ route('logout') }}" method="POST" class="w-full pt-2">
                @csrf
                <button type="submit" class="w-full text-left font-mono text-sm text-textSecondary hover:text-red-400 transition-colors py-2">
                    ~/ Logout_
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block font-mono text-sm text-textPrimary hover:text-neonGreen transition-colors py-2">
                ~/ Login_
            </a>
        @endauth
    </div>
</div>

{{-- Overlay --}}
<div class="fixed inset-0 bg-black/50 z-40 hidden" id="mobileOverlay" onclick="toggleMobileMenu()"></div>