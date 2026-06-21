<div class="min-h-screen pt-28 px-6 max-w-6xl mx-auto font-mono">  
    
    {{-- SECTION 1: DASHBOARD HOME (STATISTIK UTAMA) --}}
    <div id="admin-section-dashboard" class="admin-section section-visible">
        {{-- Dashboard Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-border pb-6 mb-8 gap-4">
            <div>
                <h1 class="text-xl font-bold text-textPrimary tracking-tight">
                    <span class="text-neonGreen">~/</span>admin_dashboard
                </h1>
                <p class="text-xs text-textSecondary mt-1">Manage system core resources and logs.</p>
            </div>
            <div>
                <button onclick="ArticleService.openCreateModal()" class="px-4 py-2 text-xs font-bold rounded-lg bg-neonGreen text-bg hover:bg-neonGreen/90 transition shadow-lg shadow-neonGreen/10">
                    + CREATE_NEW_ARTICLE
                </button>
            </div>
        </div>

        {{-- System Statistics --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="p-4 bg-surface/40 border border-border rounded-xl">
                <div class="text-xs text-textSecondary">total_articles</div>
                <div id="statTotalArticles" class="text-2xl font-bold text-neonGreen mt-1">...</div>
            </div>
            <div class="p-4 bg-surface/40 border border-border rounded-xl">
                <div class="text-xs text-textSecondary">total_projects</div>
                <div class="text-2xl font-bold text-textPrimary mt-1">08</div>
            </div>
            <div class="p-4 bg-surface/40 border border-border rounded-xl">
                <div class="text-xs text-textSecondary">system_status</div>
                <div class="text-2xl font-bold text-emerald-400 mt-1 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> ONLINE
                </div>
            </div>
        </div>

        {{-- Visual Log Terminal Info --}}
        <div class="p-6 bg-surface/30 border border-border rounded-xl font-mono text-xs text-textSecondary">
            <p class="text-neonGreen">[SYSTEM LOG READY]</p>
            <p class="mt-1">Silahkan klik menu <span class="text-textPrimary font-bold">"Articles"</span> di navbar atas untuk mengelola data core storage database secara asinkronus.</p>
        </div>
    </div>


    {{-- SECTION 2: ARTICLES MANAGEMENT (TABEL UTAMA DATABASE) --}}
    <div id="admin-section-articles" class="admin-section hidden section-hidden">
        {{-- Table Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-border pb-6 mb-8 gap-4">
            <div>
                <h1 class="text-xl font-bold text-textPrimary tracking-tight">
                    <span class="text-neonGreen">~/</span>core_articles_database
                </h1>
                <p class="text-xs text-textSecondary mt-1">Daftar arsip seluruh artikel log aktif di sistem.</p>
            </div>
            <div>
                <button onclick="ArticleService.openCreateModal()" class="px-4 py-2 text-xs font-bold rounded-lg bg-neonGreen text-bg hover:bg-neonGreen/90 transition shadow-lg shadow-neonGreen/10">
                    + CREATE_NEW_ARTICLE
                </button>
            </div>
        </div>

        {{-- Log Table Wrapper --}}
        <div class="bg-surface/30 border border-border rounded-xl overflow-hidden">
            <div class="p-4 border-b border-border/60 bg-surface/50 flex items-center justify-between">
                <span class="text-xs text-textPrimary font-bold">> database_entries.log</span>
                <span id="tableLogCount" class="text-[10px] text-textSecondary">Loading records...</span>
            </div>
            
            {{-- Table Container --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-border/50 text-[11px] text-textSecondary uppercase tracking-wider bg-bg/20">
                            <th class="p-4 font-medium w-16">ID</th>
                            <th class="p-4 font-medium">Title</th>
                            <th class="p-4 font-medium hidden sm:table-cell">Slug</th>
                            <th class="p-4 font-medium">Tags</th>
                            <th class="p-4 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="articlesTableBody" class="text-xs text-textSecondary divide-y divide-border/30">
                        {{-- Loader placeholder saat data sedang ditarik --}}
                        <tr>
                            <td colspan="5" class="p-8 text-center text-textMuted animate-pulse">
                                $ fetching_live_supabase_data...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Footer Return Nav --}}
    <div class="mt-8 text-center pb-12">
        <a href="/" class="text-xs text-textSecondary hover:text-neonGreen transition">
            &larr; return_to_terminal_hub
        </a>
    </div>

</div>

{{-- ==================== MODAL OVERLAY: CREATE NEW ARTICLE ==================== --}}
<div id="createArticleModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden p-4">
    <div class="bg-surface border border-border rounded-xl w-full max-w-2xl overflow-hidden font-mono text-xs">
        <div class="p-4 border-b border-border bg-surfaceLight flex justify-between items-center">
            <span class="text-textPrimary font-bold">> create_new_article.exe</span>
            <button type="button" onclick="ArticleService.closeCreateModal()" class="text-textSecondary hover:text-red-400">[X]</button>
        </div>
        
        {{-- FIXED: Hapus atribut onsubmit inline agar sepenuhnya dikontrol oleh script blog.js event listener --}}
        <form id="createArticleForm" class="p-6 space-y-4">
            <div>
                <label class="block text-textSecondary mb-1">Title *</label>
                <input type="text" id="formTitle" required class="w-full bg-bg border border-border rounded p-2 text-textPrimary focus:border-neonGreen focus:outline-none">
            </div>
            
            <div>
                <label class="block text-textSecondary mb-1">Slug (Optional - auto-generated if left blank)</label>
                <input type="text" id="formSlug" placeholder="e.g., my-awesome-post" class="w-full bg-bg border border-border rounded p-2 text-textPrimary focus:border-neonGreen focus:outline-none">
            </div>
            
            <div>
                <label class="block text-textSecondary mb-1">Tags (Comma-separated, e.g., golang, devops, rust)</label>
                <input type="text" id="formTags" placeholder="golang, rust, devops" class="w-full bg-bg border border-border rounded p-2 text-textPrimary focus:border-neonGreen focus:outline-none">
            </div>

            <div>
                <label class="block text-textSecondary mb-1">Content (Markdown / Text Body) *</label>
                <textarea id="formContent" required rows="6" class="w-full bg-bg border border-border rounded p-2 text-textPrimary focus:border-neonGreen focus:outline-none" placeholder="Write your content here..."></textarea>
            </div>
            
            <div class="flex justify-end gap-4 pt-2">
                <button type="button" onclick="ArticleService.closeCreateModal()" class="px-4 py-2 text-textSecondary hover:text-textPrimary">[CANCEL]</button>
                <button type="submit" class="px-4 py-2 bg-neonGreen text-bg font-bold rounded hover:bg-neonGreen/90">[SUBMIT]</button>
            </div>
        </form>
    </div>
</div>