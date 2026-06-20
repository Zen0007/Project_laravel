import { ArticleService } from "./api";

// 1. Tambahkan fungsi kontrol UI (Modal & Toast) ke dalam scope global ArticleService
window.ArticleService = {
    ...ArticleService, // Menyalin fungsi bawaan dari api.js (getAll, create, delete, dll)

    // Fungsi membuka modal tambah artikel
    openCreateModal() {
        const modal = document.getElementById("createArticleModal");
        if (modal) modal.classList.remove("hidden");
    },

    // Fungsi menutup modal dan meriset form
    closeCreateModal() {
        const modal = document.getElementById("createArticleModal");
        const form = document.getElementById("createArticleForm");
        if (modal) modal.classList.add("hidden");
        if (form) form.reset();
    },

    // Handler untuk menghapus artikel dengan konfirmasi terminal-style
    async handleDeleteArticle(id) {
        if (
            !confirm(
                "CRITICAL_ACTION: Are you sure you want to drop this record from core storage?",
            )
        )
            return;

        try {
            await ArticleService.delete(id);
            showAdminToast("✓ RECORD_DROPPED: Entry removed successfully.");
            await refreshDashboardTable(); // Muat ulang tabel secara asinkronus (SPA)
        } catch (error) {
            console.error("Delete operational failure:", error);
            showAdminToast("❌ DROP_FAILED: Database connection rejected.");
        }
    },
};

// Helper internal untuk memicu toast notification matrix
function showAdminToast(message) {
    const toast = document.getElementById("toast");
    if (!toast) return;
    toast.textContent = message;
    toast.classList.add("show");
    setTimeout(() => toast.classList.remove("show"), 2500);
}

// 2. Fungsi Utama Merender Data Tabel & Statistik Dashboard
async function refreshDashboardTable() {
    const tableBody = document.getElementById("articlesTableBody");
    const statTotal = document.getElementById("statTotalArticles");
    const logCountText = document.getElementById("tableLogCount");

    if (!tableBody) return;

    try {
        const articles = await ArticleService.getAll();

        // Update counter stat komponen di atas tabel
        if (statTotal)
            statTotal.textContent = String(articles.length).padStart(2, "0");
        if (logCountText)
            logCountText.textContent = `Showing ${articles.length} records`;

        if (articles.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="5" class="p-8 text-center text-textMuted font-mono text-xs">
                        [!] SYSTEM_EMPTY: No database log entries found.
                    </td>
                </tr>`;
            return;
        }

        // Mapping array data dari Supabase ke dalam baris HTML element tabel
        tableBody.innerHTML = articles
            .map((article) => {
                // Parsing data tags yang berbentuk Array ataupun String koma
                let tagsArray = [];
                if (Array.isArray(article.tags)) {
                    tagsArray = article.tags;
                } else if (
                    typeof article.tags === "string" &&
                    article.tags.trim() !== ""
                ) {
                    tagsArray = article.tags.split(",").map((t) => t.trim());
                }

                const tagBadges =
                    tagsArray.length > 0
                        ? tagsArray
                              .map(
                                  (t) =>
                                      `<span class="text-[10px] text-neonGreen/80 bg-neonGreen/5 px-1.5 py-0.5 rounded border border-neonGreen/10 mr-1">#${t}</span>`,
                              )
                              .join("")
                        : '<span class="text-textMuted/40">-</span>';

                return `
                <tr class="hover:bg-surfaceLight/20 transition-colors border-b border-border/30 font-mono text-sm">
                    <td class="p-4 text-neonGreen font-bold">#${String(article.id).slice(-4)}</td>
                    <td class="p-4 font-medium text-textPrimary max-w-xs truncate">${article.title}</td>
                    <td class="p-4 hidden sm:table-cell text-textSecondary/70 truncate max-w-[150px]">/${article.slug}</td>
                    <td class="p-4">${tagBadges}</td>
                    <td class="p-4 text-right space-x-2 whitespace-nowrap">
                        <button class="text-textPrimary hover:text-neonGreen transition">[edit]</button>
                        <button onclick="ArticleService.handleDeleteArticle('${article.id}')" class="text-red-400/70 hover:text-red-400 transition">
                            [delete]
                        </button>
                    </td>
                </tr>`;
            })
            .join("");

        // Re-inisialisasi icon Lucide pasca manipulasi innerHTML DOM dinamis
        if (typeof lucide !== "undefined") lucide.createIcons();
    } catch (error) {
        console.error("Dashboard engine failure:", error);
        tableBody.innerHTML = `
            <tr>
                <td colspan="5" class="p-8 text-center text-red-400 font-mono text-xs">
                    CRITICAL_ERROR: Failed to establish handshake with database server.
                </td>
            </tr>`;
    }
}

// 3. Event Listener Utama untuk Lifecycle DOM & Handler Form Submit
document.addEventListener("DOMContentLoaded", () => {
    // Jalankan load data pertama kali
    refreshDashboardTable();

    // Integrasikan Event Form Submit untuk Tambah Artikel Baru
    const createForm = document.getElementById("createArticleForm");
    if (createForm) {
        createForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            const submitBtn = createForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;

            // Kumpulkan data value dari masing-masing element form input
            const title = document.getElementById("formTitle").value;
            let slug = document.getElementById("formSlug").value;
            const tags = document.getElementById("formTags").value;
            const content = document.getElementById("formContent").value;

            // Otomatis bikin format slug seandainya kolom dikosongkan
            if (!slug) {
                slug = title
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, "-")
                    .replace(/(^-|-$)+/g, "");
            }

            // UI State Loading
            submitBtn.textContent = "[COMPILING...]";
            submitBtn.disabled = true;

            try {
                // Panggil method pipeline create kirim data ke Supabase backend
                await ArticleService.create({ title, slug, tags, content });

                showAdminToast("✓ COMPILE_SUCCESS: Article metrics pushed.");
                window.ArticleService.closeCreateModal(); // Tutup modal lewat scope global
                await refreshDashboardTable(); // Live refresh records tabel tanpa reload halaman browser
            } catch (error) {
                console.error("Compilation submission rejected:", error);
                showAdminToast(
                    "❌ COMPILE_ERROR: Missing credentials or database drop.",
                );
            } finally {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        });
    }
});

function moveIndicator(target) {
    const indicator = document.getElementById("navIndicator");
    const nav = document.getElementById("desktopNav");

    if (!indicator || !target || !nav) return;

    const navRect = nav.getBoundingClientRect();
    const targetRect = target.getBoundingClientRect();

    indicator.style.width = `${targetRect.width}px`;
    indicator.style.transform = `translateX(${targetRect.left - navRect.left}px)`;
}

document.addEventListener("DOMContentLoaded", () => {
    const links = document.querySelectorAll("#desktopNav .nav-link");

    const active = document.querySelector("#desktopNav .nav-link.active");

    if (active) {
        moveIndicator(active);
    }

    links.forEach((link) => {
        link.addEventListener("mouseenter", () => {
            moveIndicator(link);
        });
    });

    document
        .getElementById("desktopNav")
        ?.addEventListener("mouseleave", () => {
            const active = document.querySelector(
                "#desktopNav .nav-link.active",
            );

            if (active) {
                moveIndicator(active);
            }
        });

    window.addEventListener("resize", () => {
        const active = document.querySelector("#desktopNav .nav-link.active");

        if (active) {
            moveIndicator(active);
        }
    });
});
