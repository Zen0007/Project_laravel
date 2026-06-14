import { ArticleService } from "./api";

window.ArticleService = ArticleService;

async function refreshDashboardTable() {
    const tableBody = document.getElementById("articlesTableBody");
    const statTotal = document.getElementById("statTotalArticles");
    const logCountText = document.getElementById("tableLogCount");

    try {
        const articles = await ArticleService.getAll();
        statTotal.textContent = String(articles.length).padStart(2, "0");
        logCountText.textContent = `Showing ${articles.length} records`;

        if (articles.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="p-8 text-center text-textMuted">
                        [!] No database entries found.
                    </td>
                </tr>`;
            return;
        }

        tableBody.innerHTML = articles
            .map((article) => {
                const tagBadges =
                    article.tags && article.tags.length > 0
                        ? article.tags
                              .map(
                                  (t) =>
                                      `<span class="text-[10px] text-neonGreen/80 bg-neonGreen/5 px-1.5 py-0.5 rounded border border-neonGreen/10 mr-1">#${t}</span>`,
                              )
                              .join("")
                        : '<span class="text-textMuted/40">-</span>';

                return `
                <tr class="hover:bg-surfaceLight/20 transition-colors">
                    <td class="p-4 text-neonGreen font-bold">#${String(article.id).padStart(3, "0")}</td>
                    <td class="p-4 font-medium text-textPrimary max-w-xs truncate">${article.title}</td>
                    <td class="p-4 hidden sm:table-cell text-textSecondary/70 truncate max-w-[150px]">/${article.slug}</td>
                    <td class="p-4">${tagBadges}</td>
                    <td class="p-4 text-right space-x-2 whitespace-nowrap">
                        <button class="text-textPrimary hover:text-neonGreen transition">[edit]</button>
                        <button onclick="ArticleService.handleDeleteArticle(${article.id})" class="text-red-400/70 hover:text-red-400 transition">
                            [delete]
                        </button>
                    </td>
                </tr>
            `;
            })
            .join("");
    } catch (error) {
        console.error("Dashboard engine failure:", error);
        tableBody.innerHTML = `
            <tr>
                <td colspan="5" class="p-8 text-center text-red-400">
                    CRITICAL_ERROR: Failed to establish handshake with database server.
                </td>
            </tr>`;
    }
}

document.addEventListener("DOMContentLoaded", refreshDashboardTable);
