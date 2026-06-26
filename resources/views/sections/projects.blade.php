{{-- ==================== PROJECTS SECTION ==================== --}}
<section id="section-projects" class="section-hidden pt-24 pb-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-12">
            <div class="font-mono text-xs text-neonBlue mb-2 tracking-widest uppercase">Open Source</div>
            <h2 class="text-3xl md:text-4xl font-bold tracking-tight mb-2">Projects</h2>
            <p class="text-textSecondary font-mono text-sm">Tools and libraries I've built and maintain.</p>
        </div>

        <div class="space-y-4">

            {{-- Repo 1 --}}
            <div class="repo-card rounded-xl bg-surface p-6">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <i data-lucide="book-open" class="w-4 h-4 text-textMuted"></i>
                            <a href="#" class="text-neonBlue hover:underline font-mono text-sm font-medium">alexchen/go-pipeline</a>
                            <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-surfaceLight text-textMuted border border-border">Public</span>
                        </div>
                        <p class="text-textSecondary text-sm mb-4">A lightweight, composable pipeline library for Go with built-in concurrency control, error handling, and middleware support.</p>
                        <div class="flex flex-wrap items-center gap-4 font-mono text-xs text-textMuted">
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-neonGreen"></span> Go</span>
                            <span class="flex items-center gap-1"><i data-lucide="star" class="w-3 h-3"></i> 2.4k</span>
                            <span class="flex items-center gap-1"><i data-lucide="git-fork" class="w-3 h-3"></i> 189</span>
                            <span class="flex items-center gap-1"><i data-lucide="circle-dot" class="w-3 h-3"></i> 12 issues</span>
                        </div>
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        <button onclick="showToast('⭐ Starred go-pipeline')" class="font-mono text-xs px-4 py-2 rounded-lg border border-neonGreen/30 text-neonGreen hover:bg-neonGreen/10 transition-colors">
                            <i data-lucide="star" class="w-3 h-3 inline mr-1"></i>Star
                        </button>
                    </div>
                </div>
            </div>

            {{-- Repo 2 --}}
            <div class="repo-card rounded-xl bg-surface p-6">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <i data-lucide="book-open" class="w-4 h-4 text-textMuted"></i>
                            <a href="#" class="text-neonBlue hover:underline font-mono text-sm font-medium">alexchen/ts-bundler</a>
                            <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-surfaceLight text-textMuted border border-border">Public</span>
                        </div>
                        <p class="text-textSecondary text-sm mb-4">A zero-config TypeScript bundler written in Rust. 10x faster than webpack for most projects with native tree-shaking and minification.</p>
                        <div class="flex flex-wrap items-center gap-4 font-mono text-xs text-textMuted">
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-[#FF79C6]"></span> Rust</span>
                            <span class="flex items-center gap-1"><i data-lucide="star" class="w-3 h-3"></i> 3.1k</span>
                            <span class="flex items-center gap-1"><i data-lucide="git-fork" class="w-3 h-3"></i> 156</span>
                            <span class="flex items-center gap-1"><i data-lucide="circle-dot" class="w-3 h-3"></i> 21 issues</span>
                        </div>
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        <button onclick="showToast('⭐ Starred ts-bundler')" class="font-mono text-xs px-4 py-2 rounded-lg border border-neonGreen/30 text-neonGreen hover:bg-neonGreen/10 transition-colors">
                            <i data-lucide="star" class="w-3 h-3 inline mr-1"></i>Star
                        </button>
                    </div>
                </div>
            </div>

            {{-- Repo 3 --}}
            <div class="repo-card rounded-xl bg-surface p-6">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <i data-lucide="book-open" class="w-4 h-4 text-textMuted"></i>
                            <a href="#" class="text-neonBlue hover:underline font-mono text-sm font-medium">alexchen/rustql</a>
                            <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-surfaceLight text-textMuted border border-border">Public</span>
                        </div>
                        <p class="text-textSecondary text-sm mb-4">Type-safe SQL query builder for Rust with compile-time query validation and zero-cost abstractions over raw SQL.</p>
                        <div class="flex flex-wrap items-center gap-4 font-mono text-xs text-textMuted">
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-[#FF79C6]"></span> Rust</span>
                            <span class="flex items-center gap-1"><i data-lucide="star" class="w-3 h-3"></i> 1.8k</span>
                            <span class="flex items-center gap-1"><i data-lucide="git-fork" class="w-3 h-3"></i> 97</span>
                            <span class="flex items-center gap-1"><i data-lucide="circle-dot" class="w-3 h-3"></i> 5 issues</span>
                        </div>
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        <button onclick="showToast('⭐ Starred rustql')" class="font-mono text-xs px-4 py-2 rounded-lg border border-neonGreen/30 text-neonGreen hover:bg-neonGreen/10 transition-colors">
                            <i data-lucide="star" class="w-3 h-3 inline mr-1"></i>Star
                        </button>
                    </div>
                </div>
            </div>

            {{-- Repo 4 --}}
            <div class="repo-card rounded-xl bg-surface p-6">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <i data-lucide="book-open" class="w-4 h-4 text-textMuted"></i>
                            <a href="#" class="text-neonBlue hover:underline font-mono text-sm font-medium">alexchen/dotfiles</a>
                            <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-surfaceLight text-textMuted border border-border">Public</span>
                        </div>
                        <p class="text-textSecondary text-sm mb-4">My personal Neovim + Tmux + Zsh configuration. Optimized for Go and Rust development with LSP, treesitter, and custom keymaps.</p>
                        <div class="flex flex-wrap items-center gap-4 font-mono text-xs text-textMuted">
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-[#FFD700]"></span> Vim script</span>
                            <span class="flex items-center gap-1"><i data-lucide="star" class="w-3 h-3"></i> 945</span>
                            <span class="flex items-center gap-1"><i data-lucide="git-fork" class="w-3 h-3"></i> 234</span>
                            <span class="flex items-center gap-1"><i data-lucide="circle-dot" class="w-3 h-3"></i> 2 issues</span>
                        </div>
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        <button onclick="showToast('⭐ Starred dotfiles')" class="font-mono text-xs px-4 py-2 rounded-lg border border-neonGreen/30 text-neonGreen hover:bg-neonGreen/10 transition-colors">
                            <i data-lucide="star" class="w-3 h-3 inline mr-1"></i>Star
                        </button>
                    </div>
                </div>
            </div>

            {{-- Repo 5 --}}
            <div class="repo-card rounded-xl bg-surface p-6">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <i data-lucide="book-open" class="w-4 h-4 text-textMuted"></i>
                            <a href="#" class="text-neonBlue hover:underline font-mono text-sm font-medium">alexchen/async-cache</a>
                            <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-surfaceLight text-textMuted border border-border">Public</span>
                        </div>
                        <p class="text-textSecondary text-sm mb-4">High-performance async caching library for Python with TTL, LRU eviction, and support for multiple backends (Redis, Memcached, in-memory).</p>
                        <div class="flex flex-wrap items-center gap-4 font-mono text-xs text-textMuted">
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-[#FFD700]"></span> Python</span>
                            <span class="flex items-center gap-1"><i data-lucide="star" class="w-3 h-3"></i> 678</span>
                            <span class="flex items-center gap-1"><i data-lucide="git-fork" class="w-3 h-3"></i> 45</span>
                            <span class="flex items-center gap-1"><i data-lucide="circle-dot" class="w-3 h-3"></i> 8 issues</span>
                        </div>
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        <button onclick="showToast('⭐ Starred async-cache')" class="font-mono text-xs px-4 py-2 rounded-lg border border-neonGreen/30 text-neonGreen hover:bg-neonGreen/10 transition-colors">
                            <i data-lucide="star" class="w-3 h-3 inline mr-1"></i>Star
                        </button>
                    </div>
                </div>
            </div>

        </div>

        {{-- GitHub Stats --}}
        <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-surface border border-border rounded-xl p-5 text-center">
                <div class="text-2xl font-bold text-neonGreen font-mono">8.9k</div>
                <div class="font-mono text-xs text-textMuted mt-1">Total Stars</div>
            </div>
            <div class="bg-surface border border-border rounded-xl p-5 text-center">
                <div class="text-2xl font-bold text-neonBlue font-mono">721</div>
                <div class="font-mono text-xs text-textMuted mt-1">Total Forks</div>
            </div>
            <div class="bg-surface border border-border rounded-xl p-5 text-center">
                <div class="text-2xl font-bold text-neonGreen font-mono">47</div>
                <div class="font-mono text-xs text-textMuted mt-1">Repositories</div>
            </div>
            <div class="bg-surface border border-border rounded-xl p-5 text-center">
                <div class="text-2xl font-bold text-neonBlue font-mono">1,247</div>
                <div class="font-mono text-xs text-textMuted mt-1">Contributions (yr)</div>
            </div>
        </div>

    </div>
</section>
