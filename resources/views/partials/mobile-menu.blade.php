{{-- Mobile Slide Menu --}}
<div class="mobile-menu fixed top-0 right-0 w-72 h-full bg-surface z-50 border-l border-border p-6" id="mobileMenu">
    <div class="flex justify-between items-center mb-8">
        <span class="font-mono text-neonGreen text-sm">Navigation</span>
        <button onclick="toggleMobileMenu()" class="text-textSecondary hover:text-neonGreen">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>
    <div class="flex flex-col gap-4">
        <a href="#" onclick="showSection('home');toggleMobileMenu()" class="font-mono text-sm text-textSecondary hover:text-neonGreen transition-colors py-2">~/ Home</a>
        <a href="#" onclick="showSection('articles');toggleMobileMenu()" class="font-mono text-sm text-textSecondary hover:text-neonGreen transition-colors py-2">~/ Articles</a>
        <a href="#" onclick="showSection('projects');toggleMobileMenu()" class="font-mono text-sm text-textSecondary hover:text-neonGreen transition-colors py-2">~/ Projects</a>
        <a href="#" onclick="showSection('about');toggleMobileMenu()" class="font-mono text-sm text-textSecondary hover:text-neonGreen transition-colors py-2">~/ About</a>
    </div>
</div>

{{-- Overlay --}}
<div class="fixed inset-0 bg-black/50 z-40 hidden" id="mobileOverlay" onclick="toggleMobileMenu()"></div>
