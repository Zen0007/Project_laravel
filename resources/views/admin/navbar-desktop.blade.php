<div class="hidden md:flex items-center justify-between flex-1 ml-10">

    {{-- Center Navigation --}}
    <div class="flex-1 flex justify-center">
        <div id="desktopNav" class="relative flex items-center gap-10 py-2">
            
            {{-- Animated Slider Indicator --}}
            {{-- Hapus durasi transisi inline/tailwind agar tidak balapan dengan CSS asli --}}
            <span id="navIndicator" class="absolute bottom-0 left-0 h-[2px] bg-neonGreen rounded-full"></span>

            <a 
                href="#" 
                onclick="switchAdminTab(event, 'dashboard')" 
                class="nav-link text-sm font-mono tracking-wide {{ request()->routeIs('admin.index') ? 'active text-neonGreen font-bold' : 'text-textSecondary hover:text-neonGreen' }}"
                data-tab="dashboard"
            >
                Home
            </a>

            <a 
                href="#" 
                onclick="switchAdminTab(event, 'articles')" 
                class="nav-link text-sm font-mono tracking-wide {{ request()->routeIs('admin.articles.*') ? 'active text-neonGreen font-bold' : 'text-textSecondary hover:text-neonGreen' }}"
                data-tab="articles"
            >
                Articles
            </a>
        </div>
    </div>

    {{-- Right Actions --}}
    <div class="flex justify-end items-center gap-2">
        {{-- Theme --}}
        <button onclick="toggleThemeAccent()" title="Theme" class="p-2 rounded-lg text-textSecondary hover:text-neonGreen hover:bg-surfaceLight transition-colors duration-300">
            <i data-lucide="palette" class="w-4 h-4"></i>
        </button>

        {{-- Github --}}
        <a href="https://github.com" target="_blank" rel="noopener noreferrer" title="GitHub" class="p-2 rounded-lg text-textSecondary hover:text-neonGreen hover:bg-surfaceLight transition-colors duration-300">
            <i class="fab fa-github"></i>
        </a>

        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" title="Logout" class="p-2 rounded-lg text-textSecondary hover:text-red-400 hover:bg-surfaceLight transition-colors duration-300">
                <i data-lucide="log-out" class="w-4 h-4"></i>
            </button>
        </form>
    </div>

</div>