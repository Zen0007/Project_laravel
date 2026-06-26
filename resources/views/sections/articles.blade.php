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
        <div class="col-span-full text-center py-12">
                <p class="text-textMuted font-mono text-xs animate-pulse">$ loading database entries...</p>
            </div>
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
