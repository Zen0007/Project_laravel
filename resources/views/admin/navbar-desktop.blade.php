<div class="hidden md:grid md:grid-cols-3 items-center flex-1">

    {{-- Left Spacer --}}
    <div></div>

    {{-- Center Navigation --}}
    <div class="flex justify-center">

        <div
            id="desktopNav"
            class="relative flex items-center gap-10"
        >

            {{-- Animated Slider Indicator --}}
            <span
                id="navIndicator"
                class="absolute -bottom-2 left-0 h-[2px] bg-neonGreen rounded-full"
            ></span>

            <a
                href="{{ route('admin.index') }}"
                class="nav-link text-sm font-mono tracking-wide
                {{
                    request()->routeIs('admin.index')
                    ? 'active text-neonGreen font-bold'
                    : 'text-textSecondary hover:text-neonGreen'
                }}"
            >
                Home
            </a>

            <a
                href="{{ route('admin.articles.index') }}"
                class="nav-link text-sm font-mono tracking-wide
                {{
                    request()->routeIs('admin.articles.*')
                    ? 'active text-neonGreen font-bold'
                    : 'text-textSecondary hover:text-neonGreen'
                }}"
            >
                Articles
            </a>

        </div>

    </div>

    {{-- Right Actions --}}
    <div class="flex justify-end items-center gap-2">

        {{-- Theme --}}
        <button
            onclick="toggleThemeAccent()"
            title="Theme"
            class="
                p-2
                rounded-lg
                text-textSecondary
                hover:text-neonGreen
                hover:bg-surfaceLight
                transition-all
                duration-300
            "
        >
            <i data-lucide="palette" class="w-4 h-4"></i>
        </button>

        {{-- Github --}}
        <a
            href="https://github.com"
            target="_blank"
            rel="noopener noreferrer"
            title="GitHub"
            class="
                p-2
                rounded-lg
                text-textSecondary
                hover:text-neonGreen
                hover:bg-surfaceLight
                transition-all
                duration-300
            "
        >
            <i class="fab fa-github"></i>
        </a>

        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button
                type="submit"
                title="Logout"
                class="
                    p-2
                    rounded-lg
                    text-textSecondary
                    hover:text-red-400
                    hover:bg-surfaceLight
                    transition-all
                    duration-300
                "
            >
                <i data-lucide="log-out" class="w-4 h-4"></i>
            </button>
        </form>

    </div>

</div>