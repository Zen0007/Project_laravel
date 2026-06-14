<div class="articles-home min-h-screen pt-24 px-6 max-w-6xl mx-auto font-mono">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-border pb-6 mb-8 gap-4">
        <div>
            <h1 class="text-xl font-bold text-textPrimary tracking-tight">
                <span class="text-neonGreen">~/</span>admin_dashboard
            </h1>
            <p class="text-xs text-textSecondary mt-1">Manage system core resources and logs.</p>
        </div>
        <div>
            <button class="px-4 py-2 text-xs font-bold rounded-lg bg-neonGreen text-bg hover:bg-neonGreen/90 transition shadow-lg shadow-neonGreen/10">
                + CREATE_NEW_ARTICLE
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="p-4 bg-surface/40 border border-border rounded-xl">
            <div class="text-xs text-textSecondary">total_articles</div>
            <div class="text-2xl font-bold text-neonGreen mt-1">12</div>
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

    <div class="bg-surface/30 border border-border rounded-xl overflow-hidden">
        <div class="p-4 border-b border-border/60 bg-surface/50 flex items-center justify-between">
            <span class="text-xs text-textPrimary font-bold">> database_entries.log</span>
            <span class="text-[10px] text-textSecondary">Showing 3 of 12 records</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-border/50 text-[11px] text-textSecondary uppercase tracking-wider bg-bg/20">
                        <th class="p-4 font-medium w-16">ID</th>
                        <th class="p-4 font-medium">Title</th>
                        <th class="p-4 font-medium hidden sm:table-cell">Slug</th>
                        <th class="p-4 font-medium">Status</th>
                        <th class="p-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-textSecondary divide-y divide-border/30">
                    <tr class="hover:bg-surfaceLight/20 transition-colors">
                        <td class="p-4 text-neonGreen">#003</td>
                        <td class="p-4 font-medium text-textPrimary">Optimizing Go Garbage Collection for Microservices</td>
                        <td class="p-4 hidden sm:table-cell text-textSecondary/70">/go-gc-optimization</td>
                        <td class="p-4"><span class="px-2 py-0.5 text-[10px] bg-neonGreen/10 text-neonGreen rounded-md border border-neonGreen/20">published</span></td>
                        <td class="p-4 text-right space-x-2">
                            <button class="text-textPrimary hover:text-neonGreen transition">[edit]</button>
                            <button class="text-red-400/70 hover:text-red-400 transition">[delete]</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-surfaceLight/20 transition-colors">
                        <td class="p-4 text-neonGreen">#002</td>
                        <td class="p-4 font-medium text-textPrimary">Building Highly Scalable API Gateway using Gin Gonic</td>
                        <td class="p-4 hidden sm:table-cell text-textSecondary/70">/scalable-api-gateway-gin</td>
                        <td class="p-4"><span class="px-2 py-0.5 text-[10px] bg-neonGreen/10 text-neonGreen rounded-md border border-neonGreen/20">published</span></td>
                        <td class="p-4 text-right space-x-2">
                            <button class="text-textPrimary hover:text-neonGreen transition">[edit]</button>
                            <button class="text-red-400/70 hover:text-red-400 transition">[delete]</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-surfaceLight/20 transition-colors">
                        <td class="p-4 text-neonGreen">#001</td>
                        <td class="p-4 font-medium text-textPrimary">Understanding Clean Architecture in Flutter Applications</td>
                        <td class="p-4 hidden sm:table-cell text-textSecondary/70">/flutter-clean-architecture</td>
                        <td class="p-4"><span class="px-2 py-0.5 text-[10px] bg-amber-400/10 text-amber-400 rounded-md border border-amber-400/20">draft</span></td>
                        <td class="p-4 text-right space-x-2">
                            <button class="text-textPrimary hover:text-neonGreen transition">[edit]</button>
                            <button class="text-red-400/70 hover:text-red-400 transition">[delete]</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8 text-center pb-12">
        <a href="/" class="text-xs text-textSecondary hover:text-neonGreen transition">
            &larr; return_to_terminal_hub
        </a>
    </div>

</div>