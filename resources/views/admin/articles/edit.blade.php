<div id="editArticleModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center hidden z-50 p-4">
    <div class="bg-surfaceDark border border-border/50 max-w-lg w-full rounded-lg p-6 font-mono text-sm">
        <div class="flex justify-between items-center border-b border-border/30 pb-3 mb-4">
            <h3 class="text-neonGreen font-bold text-base">[EDIT_ARTICLE_NODE]</h3>
            <button onclick="closeEditModal()" class="text-textMuted hover:text-textPrimary">[close]</button>
        </div>

        <form id="editArticleForm" onsubmit="handleEditFormSubmit(event)">
            <div class="space-y-4">
                <div>
                    <label class="block text-textSecondary text-xs mb-1">TITLE</label>
                    <input type="text" id="editTitle" required class="w-full bg-surfaceLight/10 border border-border/30 rounded p-2 text-textPrimary focus:outline-none focus:border-neonGreen">
                </div>
                <div>
                    <label class="block text-textSecondary text-xs mb-1">SLUG</label>
                    <input type="text" id="editSlug" required class="w-full bg-surfaceLight/10 border border-border/30 rounded p-2 text-textPrimary focus:outline-none focus:border-neonGreen">
                </div>
                <div>
                    <label class="block text-textSecondary text-xs mb-1">TAGS (Separated by comma)</label>
                    <input type="text" id="editTags" class="w-full bg-surfaceLight/10 border border-border/30 rounded p-2 text-textPrimary focus:outline-none focus:border-neonGreen" placeholder="news, tech, cyber">
                </div>
                <div>
                    <label class="block text-textSecondary text-xs mb-1">CONTENT (JSON String or Text)</label>
                    <textarea id="editContent" rows="5" class="w-full bg-surfaceLight/10 border border-border/30 rounded p-2 text-textPrimary font-mono text-xs focus:outline-none focus:border-neonGreen"></textarea>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-6 border-t border-border/30 pt-4">
                <button type="button" onclick="closeEditModal()" class="text-textMuted hover:text-textPrimary px-4 py-2">[cancel]</button>
                <button type="submit" class="bg-neonGreen/10 border border-neonGreen/40 text-neonGreen hover:bg-neonGreen/20 px-4 py-2 rounded font-bold transition">
                    [execute_update]
                </button>
            </div>
        </form>
    </div>
</div>