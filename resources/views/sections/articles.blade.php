{{-- ==================== ARTICLES SECTION ==================== --}}
<section id="section-articles" class="section-hidden pt-24 pb-24">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Section Header --}}
        <div class="mb-12">
            <div class="font-mono text-xs text-neonGreen mb-2 tracking-widest uppercase">Blog</div>
            <h2 class="text-3xl md:text-4xl font-bold tracking-tight mb-2">Articles</h2>
            <p class="text-textSecondary font-mono text-sm">Thoughts on code, architecture, and engineering.</p>
        </div>

        {{-- Tag Filter --}}
        <div class="flex flex-wrap gap-2 mb-10" id="tagFilter">
            <button onclick="filterArticles('all')" class="tag-btn active font-mono text-xs px-4 py-2 rounded-lg bg-neonGreen/10 text-neonGreen border border-neonGreen/30 transition-all hover:bg-neonGreen/20" data-tag="all">All Posts</button>
            <button onclick="filterArticles('golang')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-golang transition-all hover:opacity-80" data-tag="golang">#golang</button>
            <button onclick="filterArticles('rust')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-rust transition-all hover:opacity-80" data-tag="rust">#rust</button>
            <button onclick="filterArticles('python')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-python transition-all hover:opacity-80" data-tag="python">#python</button>
            <button onclick="filterArticles('javascript')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-javascript transition-all hover:opacity-80" data-tag="javascript">#javascript</button>
            <button onclick="filterArticles('devops')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-devops transition-all hover:opacity-80" data-tag="devops">#devops</button>
            <button onclick="filterArticles('database')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-database transition-all hover:opacity-80" data-tag="database">#database</button>
        </div>

        {{-- Articles Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="articlesGrid">

            {{-- Article 1 --}}
            <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="golang" onclick="showArticle(0)">
                <div class="h-44 bg-surfaceLight relative overflow-hidden">
                    <img src="https://icehousecorp.com/wp-content/uploads/2022/04/go-768x525.png" alt="" class="w-full h-full object-cover opacity-60">
                    <div class="absolute top-3 left-3"><span class="tag-golang font-mono text-xs px-2 py-1 rounded-md">#golang</span></div>
                </div>
                <div class="p-5">
                    <div class="font-mono text-xs text-textMuted mb-2">2024-12-15 · 8 min read</div>
                    <h3 class="font-semibold text-textPrimary mb-2 leading-snug">Understanding Go Concurrency: Beyond Goroutines</h3>
                    <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">Deep dive into Go's concurrency model — channels, select statements, context propagation, and common patterns for building robust concurrent systems.</p>
                </div>
            </article>

            {{-- Article 2 --}}
            <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="rust" onclick="showArticle(1)">
                <div class="h-44 bg-surfaceLight relative overflow-hidden">
                    <img src="https://picsum.photos/seed/rustlife/600/400.jpg" alt="" class="w-full h-full object-cover opacity-60">
                    <div class="absolute top-3 left-3"><span class="tag-rust font-mono text-xs px-2 py-1 rounded-md">#rust</span></div>
                </div>
                <div class="p-5">
                    <div class="font-mono text-xs text-textMuted mb-2">2024-12-08 · 12 min read</div>
                    <h3 class="font-semibold text-textPrimary mb-2 leading-snug">Rust Lifetimes Demystified: A Practical Guide</h3>
                    <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">Lifetime annotations don't have to be scary. Learn through practical examples how Rust's borrow checker ensures memory safety at compile time.</p>
                </div>
            </article>

            {{-- Article 3 --}}
            <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="python,devops" onclick="showArticle(2)">
                <div class="h-44 bg-surfaceLight relative overflow-hidden">
                    <img src="https://picsum.photos/seed/asyncpy/600/400.jpg" alt="" class="w-full h-full object-cover opacity-60">
                    <div class="absolute top-3 left-3 flex gap-1">
                        <span class="tag-python font-mono text-xs px-2 py-1 rounded-md">#python</span>
                        <span class="tag-devops font-mono text-xs px-2 py-1 rounded-md">#devops</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="font-mono text-xs text-textMuted mb-2">2024-11-29 · 10 min read</div>
                    <h3 class="font-semibold text-textPrimary mb-2 leading-snug">Async Python for High-Throughput APIs</h3>
                    <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">Building production-grade async APIs with FastAPI, handling 10k+ concurrent connections with proper resource management.</p>
                </div>
            </article>

            {{-- Article 4 --}}
            <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="golang,database" onclick="showArticle(3)">
                <div class="h-44 bg-surfaceLight relative overflow-hidden">
                    <img src="https://picsum.photos/seed/gopgdb/600/400.jpg" alt="" class="w-full h-full object-cover opacity-60">
                    <div class="absolute top-3 left-3 flex gap-1">
                        <span class="tag-golang font-mono text-xs px-2 py-1 rounded-md">#golang</span>
                        <span class="tag-database font-mono text-xs px-2 py-1 rounded-md">#database</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="font-mono text-xs text-textMuted mb-2">2024-11-20 · 15 min read</div>
                    <h3 class="font-semibold text-textPrimary mb-2 leading-snug">Go + PostgreSQL: Connection Pooling Done Right</h3>
                    <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">Optimizing database connections in Go services — pool sizing, prepared statements, and avoiding common pitfalls in high-load scenarios.</p>
                </div>
            </article>

            {{-- Article 5 --}}
            <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="javascript" onclick="showArticle(4)">
                <div class="h-44 bg-surfaceLight relative overflow-hidden">
                    <img src="https://picsum.photos/seed/tsedge/600/400.jpg" alt="" class="w-full h-full object-cover opacity-60">
                    <div class="absolute top-3 left-3"><span class="tag-javascript font-mono text-xs px-2 py-1 rounded-md">#javascript</span></div>
                </div>
                <div class="p-5">
                    <div class="font-mono text-xs text-textMuted mb-2">2024-11-12 · 7 min read</div>
                    <h3 class="font-semibold text-textPrimary mb-2 leading-snug">TypeScript Edge Runtime: Beyond Node.js</h3>
                    <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">Exploring the new wave of TypeScript runtimes — Deno, Bun, and Cloudflare Workers — and when to choose each.</p>
                </div>
            </article>

            {{-- Article 6 --}}
            <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="rust,devops" onclick="showArticle(5)">
                <div class="h-44 bg-surfaceLight relative overflow-hidden">
                    <img src="https://picsum.photos/seed/rustcli/600/400.jpg" alt="" class="w-full h-full object-cover opacity-60">
                    <div class="absolute top-3 left-3 flex gap-1">
                        <span class="tag-rust font-mono text-xs px-2 py-1 rounded-md">#rust</span>
                        <span class="tag-devops font-mono text-xs px-2 py-1 rounded-md">#devops</span>
                    </div>
                </div>
                <div class="p-5">
                    <div class="font-mono text-xs text-textMuted mb-2">2024-11-05 · 9 min read</div>
                    <h3 class="font-semibold text-textPrimary mb-2 leading-snug">Building CLI Tools in Rust: From Zero to Published</h3>
                    <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">A complete guide to building, testing, and publishing CLI tools with Rust using Clap and Tokio.</p>
                </div>
            </article>

        </div>
    </div>
</section>

{{-- ==================== ARTICLE DETAIL SECTION ==================== --}}
<section id="section-article-detail" class="section-hidden pt-24 pb-24">
    <div class="max-w-3xl mx-auto px-6">
        <button onclick="showSection('articles')" class="font-mono text-xs text-textMuted hover:text-neonGreen transition-colors flex items-center gap-2 mb-8">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to articles
        </button>
        <div class="mb-6" id="articleMeta"></div>
        <div class="prose-custom" id="articleContent"></div>
        <div class="mt-16 pt-8 border-t border-border">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-full overflow-hidden border border-border">
                    <img src="https://picsum.photos/seed/devavatar2024/100/100.jpg" alt="" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="text-sm font-medium">Alex Chen</div>
                    <div class="font-mono text-xs text-textMuted">Full-stack developer · Building with Go & Rust</div>
                </div>
            </div>
        </div>
    </div>
</section>
