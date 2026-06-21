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
// 2. Fungsi Utama Merender Data Tabel & Statistik Dashboard
async function refreshDashboardTable() {
    const tableBody = document.getElementById("articlesTableBody");
    const statTotal = document.getElementById("statTotalArticles");
    const logCountText = document.getElementById("tableLogCount");

    if (!tableBody) return;

    try {
        // 1. Panggil API service
        const result = await ArticleService.getAll();

        // 2. FIXED: Ekstrak array data dari dalam objek response envelope
        const articles = result.data || [];

        // Update counter stat komponen di atas tabel menggunakan array yang valid
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

                // Cek tags dari root properti article, ATAU coba parse jika disimpan di dalam JSON content
                let sourceTags = article.tags;
                if (!sourceTags && article.content) {
                    try {
                        const parsedContent =
                            typeof article.content === "string"
                                ? JSON.parse(article.content)
                                : article.content;
                        sourceTags = parsedContent.tags;
                    } catch (e) {}
                }

                if (Array.isArray(sourceTags)) {
                    tagsArray = sourceTags;
                } else if (
                    typeof sourceTags === "string" &&
                    sourceTags.trim() !== ""
                ) {
                    tagsArray = sourceTags.split(",").map((t) => t.trim());
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

function initNavIndicator() {
    const nav = document.getElementById("desktopNav");
    const indicator = document.getElementById("navIndicator");

    if (!nav || !indicator) return;

    const links = nav.querySelectorAll(".nav-link");
    const active = nav.querySelector(".nav-link.active");

    const move = (target) => {
        if (!target) return;

        const navRect = nav.getBoundingClientRect();
        const targetRect = target.getBoundingClientRect();

        indicator.style.width = `${targetRect.width}px`;
        indicator.style.transform = `translateX(${targetRect.left - navRect.left}px)`;
    };

    // initial position
    if (active) {
        requestAnimationFrame(() => move(active));
    }

    // hover effect
    links.forEach((link) => {
        link.addEventListener("mouseenter", () => move(link));
    });

    // reset on leave
    nav.addEventListener("mouseleave", () => {
        if (active) move(active);
    });

    // responsive fix
    window.addEventListener("resize", () => {
        const activeNow = nav.querySelector(".nav-link.active");
        if (activeNow) move(activeNow);
    });
}
function initMobileMenu() {
    const btn = document.getElementById("mobileMenuBtn");
    const menu = document.getElementById("mobileMenu");

    if (!btn || !menu) return;

    let open = false;

    btn.addEventListener("click", () => {
        open = !open;

        if (open) {
            menu.style.maxHeight = menu.scrollHeight + "px";
            btn.innerHTML = '<i data-lucide="x"></i>';
        } else {
            menu.style.maxHeight = "0px";
            btn.innerHTML = '<i data-lucide="menu"></i>';
        }

        if (window.lucide) lucide.createIcons();
    });
}

// 3. Event Listener Utama untuk Lifecycle DOM & Handler Form Submit
document.addEventListener("DOMContentLoaded", () => {
    // =====================================================
    // 1. DASHBOARD INIT
    // =====================================================
    refreshDashboardTable?.();

    // =====================================================
    // 2. CREATE ARTICLE FORM
    // =====================================================
    const createForm = document.getElementById("createArticleForm");

    if (createForm) {
        createForm.addEventListener("submit", async (e) => {
            e.preventDefault();

            const submitBtn = createForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;

            const title = document.getElementById("formTitle").value;
            let slug = document.getElementById("formSlug").value;
            const tagsInput = document.getElementById("formTags").value;
            const contentRaw = document.getElementById("formContent").value;

            if (!slug) {
                slug = title
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, "-")
                    .replace(/(^-|-$)+/g, "");
            }

            submitBtn.textContent = "[COMPILING...]";
            submitBtn.disabled = true;

            try {
                // 1. Pecah string tags input dari koma menjadi Array bersih (lowercase & tanpa spasi ekstra)
                const tagsArray = tagsInput
                    ? tagsInput
                          .split(",")
                          .map((t) => t.trim().toLowerCase())
                          .filter((t) => t !== "")
                    : [];

                // 2. Bungkus teks artikel dan array tags ke dalam satu objek terstruktur
                const structuredContent = {
                    text: contentRaw,
                    tags: tagsArray,
                };

                // 3. Kirim data yang sudah matang ke database melalui service
                await ArticleService.create({
                    title: title,
                    slug: slug,
                    content: structuredContent, // content sekarang membawa data teks + tags
                    excerpt: contentRaw.substring(0, 150) + "...", // otomatis membuat cuplikan teks
                });

                showAdminToast("✓ COMPILE_SUCCESS");

                // Tutup modal form admin
                window.ArticleService?.closeCreateModal?.();

                // Refresh tabel dashboard agar baris data baru langsung muncul
                await refreshDashboardTable?.();
            } catch (err) {
                console.error(err);
                showAdminToast("❌ COMPILE_ERROR");
            } finally {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        });
    }

    // =====================================================
    // 3. NAV INDICATOR SYSTEM (OPTIMIZED)
    // =====================================================
    initNavIndicator();

    // =====================================================
    // 4. MOBILE MENU
    // =====================================================
    initMobileMenu();
});

function moveIndicator(target) {
    const nav = document.getElementById("desktopNav");
    const indicator = document.getElementById("navIndicator");

    if (!nav || !indicator || !target) return;

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
// Mobile Burger Menu
document.addEventListener("DOMContentLoaded", () => {
    const mobileBtn = document.getElementById("mobileMenuBtn");
    const mobileMenu = document.getElementById("mobileMenu");

    if (!mobileBtn || !mobileMenu) return;

    let isOpen = false;

    mobileBtn.addEventListener("click", () => {
        isOpen = !isOpen;

        if (isOpen) {
            mobileMenu.style.maxHeight = mobileMenu.scrollHeight + "px";

            mobileBtn.innerHTML = '<i data-lucide="x" class="w-6 h-6"></i>';
        } else {
            mobileMenu.style.maxHeight = "0px";

            mobileBtn.innerHTML = '<i data-lucide="menu" class="w-6 h-6"></i>';
        }

        if (typeof lucide !== "undefined") {
            lucide.createIcons();
        }
    });
});
// Tab Switcher untuk SPA Admin Area
window.switchAdminTab = function (event, tabName) {
    if (event) {
        event.preventDefault(); // Mencegah full page reload/restart
    }

    console.log("Switching tab to:", tabName); // Untuk debugging di console browser

    // 1. Ambil semua kontainer seksi admin
    const dashboardSection = document.getElementById("admin-section-dashboard");
    const articlesSection = document.getElementById("admin-section-articles");

    if (!dashboardSection || !articlesSection) {
        console.error("Error: Kontainer seksi admin tidak ditemukan di DOM!");
        return;
    }

    // 2. Sembunyikan atau tampilkan seksi berdasarkan tabName
    if (tabName === "dashboard") {
        dashboardSection.classList.remove("hidden", "section-hidden");
        dashboardSection.classList.add("section-visible");

        articlesSection.classList.remove("section-visible");
        articlesSection.classList.add("hidden", "section-hidden");
    } else if (tabName === "articles") {
        articlesSection.classList.remove("hidden", "section-hidden");
        articlesSection.classList.add("section-visible");

        dashboardSection.classList.remove("section-visible");
        dashboardSection.classList.add("hidden", "section-hidden");

        // Picu pemuatan ulang data tabel jika fungsinya tersedia
        if (typeof refreshDashboardTable === "function") {
            refreshDashboardTable();
        }
    }

    // 3. Atur ulang class active text pada menu Navbar Desktop
    document.querySelectorAll("#desktopNav .nav-link").forEach((link) => {
        link.classList.remove("active", "text-neonGreen", "font-bold");
        link.classList.add("text-textSecondary");
    });

    // 4. Set menu yang sedang aktif saat ini
    const clickedLink = document.querySelector(
        `#desktopNav .nav-link[data-tab="${tabName}"]`,
    );
    if (clickedLink) {
        clickedLink.classList.add("active", "text-neonGreen", "font-bold");
        clickedLink.classList.remove("text-textSecondary");

        // Picu animasi garis bawah (navIndicator) bawaan kamu
        const indicator = document.getElementById("navIndicator");
        if (indicator) {
            indicator.style.width = `${clickedLink.offsetWidth}px`;
            indicator.style.left = `${clickedLink.offsetLeft}px`;
        }
    }
};

// Pastikan ketika halaman pertama kali dimuat, inisialisasi tab awal berjalan dengan aman
document.addEventListener("DOMContentLoaded", () => {
    // Jalankan default tab ke dashboard tanpa memicu event mouseenter/leave bermasalah
    const activeLink = document.querySelector("#desktopNav .nav-link.active");
    if (activeLink) {
        const defaultTab = activeLink.getAttribute("data-tab") || "dashboard";
        window.switchAdminTab(null, defaultTab);
    }
});
