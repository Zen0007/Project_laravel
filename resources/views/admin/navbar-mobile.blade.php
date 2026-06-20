<div
    id="mobileMenu"
    class="md:hidden overflow-hidden max-h-0 transition-all duration-300 ease-out border-t border-border"
>
    <div class="px-6 py-4 flex flex-col gap-4 bg-bg">

        <a
            href="{{ route('admin.index') }}"
            class="{{ request()->routeIs('admin.index') ? 'text-neonGreen font-bold' : 'text-textSecondary' }}"
        >
            Home
        </a>

        <a
            href="{{ route('admin.articles.index') }}"
            class="{{ request()->routeIs('admin.articles.*') ? 'text-neonGreen font-bold' : 'text-textSecondary' }}"
        >
            Articles
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button
                type="submit"
                class="text-left text-red-400"
            >
                Logout
            </button>
        </form>

    </div>
</div>