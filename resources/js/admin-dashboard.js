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
// Helper fungsi untuk mencegah XSS Injection
function escapeHTML(str) {
    if (!str) return "";
    return String(str)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

async function refreshDashboardTable() {
    const tableBody = document.getElementById("articlesTableBody");
    const statTotal = document.getElementById("statTotalArticles");
    const logCountText = document.getElementById("tableLogCount");

    if (!tableBody) return;

    try {
        // 1. Panggil API service
        const result = await ArticleService.getAll();

        // 2. Ekstrak array data dari dalam objek response envelope
        const articles = result.data || [];

        // Update counter stat komponen
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

        // Mapping array data ke dalam baris HTML element tabel
        tableBody.innerHTML = articles
            .map((article) => {
                let tagsArray = [];
                // Cek tags dari root properti article, ATAU coba parse jika disimpan di dalam JSON content
                let sourceTags = article.tags;

                if (!sourceTags && article.content) {
                    // Pastikan content adalah string DAN terlihat seperti format JSON (diawali '{' atau '[')
                    // Jika diawali '<', berarti itu HTML, jadi lewati saja (jangan di-parse)
                    const isString = typeof article.content === "string";
                    const isJsonLikely =
                        isString &&
                        (article.content.trim().startsWith("{") ||
                            article.content.trim().startsWith("["));

                    if (isJsonLikely) {
                        try {
                            const parsedContent = JSON.parse(article.content);
                            sourceTags = parsedContent.tags;
                        } catch (e) {
                            // Biarkan kosong jika memang gagal parse JSON yang valid
                        }
                    } else if (!isString) {
                        // Jika content ternyata sudah berupa objek literal dari database (bukan string)
                        sourceTags = article.content.tags;
                    }
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
                                      `<span class="text-[10px] text-neonGreen/80 bg-neonGreen/5 px-1.5 py-0.5 rounded border border-neonGreen/10 mr-1">#${escapeHTML(t)}</span>`,
                              )
                              .join("")
                        : '<span class="text-textMuted/40">-</span>';

                // Gunakan escapeHTML pada variabel dinamis yang berasal dari input user
                return `
                <tr class="hover:bg-surfaceLight/20 transition-colors border-b border-border/30 font-mono text-sm">
                    <td class="p-4 text-neonGreen font-bold">#${escapeHTML(String(article.id).slice(-4))}</td>
                    <td class="p-4 font-medium text-textPrimary max-w-xs truncate">${escapeHTML(article.title)}</td>
                    <td class="p-4 hidden sm:table-cell text-textSecondary/70 truncate max-w-[150px]">/${escapeHTML(article.slug)}</td>
                    <td class="p-4">${tagBadges}</td>
                    <td class="p-4 text-right space-x-2 whitespace-nowrap">
                    <button onclick="handleEditClick('${escapeHTML(article.id)}')" class="text-textPrimary hover:text-neonGreen transition">[edit]</button>   
                    <button onclick="ArticleService.handleDeleteArticle('${escapeHTML(article.id)}')" class="text-red-400/70 hover:text-red-400 transition">
                            [delete]
                        </button>
                    </td>
                </tr>`;
            })
            .join("");

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

// Variabel global sementara untuk menyimpan ID artikel yang sedang diedit
let currentEditingId = null;

async function handleEditClick(id) {
    currentEditingId = id;
    console.log("Fetching ID:", id);
    try {
        const response = await ArticleService.getById(id);
        console.log("API Response:", response);

        // FIXED: Jika response.data undefined, gunakan langsung objek response-nya
        const article = response.data || response;

        if (!article) {
            throw new Error("Data artikel tidak ditemukan.");
        }

        openEditModal(article);
    } catch (error) {
        console.error("Failed to fetch article details:", error);
        alert("Gagal mengambil data artikel.");
    }
}

// Pastikan tetap ter-expose ke global scope
window.handleEditClick = handleEditClick;

// 1. Fungsi untuk membaca file baru yang dipilih oleh user (Preview Lokal)
function previewSelectedImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("editImagePreview");
    const placeholder = document.getElementById("imagePlaceholderText");
    const nameText = document.getElementById("editImageName");

    if (file) {
        nameText.textContent = file.name;
        preview.src = URL.createObjectURL(file);
        preview.classList.remove("hidden");
        placeholder.classList.add("hidden");
    }
}

// 2. Modifikasi fungsi openEditModal yang sudah ada untuk memuat gambar dari database
function openEditModal(article) {
    const modal = document.getElementById("editArticleModal");

    // Reset input file dan teks nama file dari sesi sebelumnya
    document.getElementById("editImageInput").value = "";
    document.getElementById("editImageName").textContent = "No file chosen";

    document.getElementById("editTitle").value = article.title || "";
    document.getElementById("editSlug").value = article.slug || "";

    // LOGIK PREVIEW GAMBAR DARI DATABASE
    const preview = document.getElementById("editImagePreview");
    const placeholder = document.getElementById("imagePlaceholderText");

    // Asumsi properti dari database bernama article.image_url atau article.image
    const currentImageUrl = article.image_url || article.image;

    if (currentImageUrl) {
        preview.src = currentImageUrl;
        preview.classList.remove("hidden");
        placeholder.classList.add("hidden");
    } else {
        preview.src = "";
        preview.classList.add("hidden");
        placeholder.classList.remove("hidden");
    }

    // Penanganan tags
    if (Array.isArray(article.tags)) {
        document.getElementById("editTags").value = article.tags.join(", ");
    } else {
        document.getElementById("editTags").value = article.tags || "";
    }

    // Penanganan content
    if (article.content && typeof article.content === "object") {
        document.getElementById("editContent").value = JSON.stringify(
            article.content,
            null,
            2,
        );
    } else {
        document.getElementById("editContent").value = article.content || "";
    }

    modal.classList.remove("hidden");
}

// Daftarkan fungsi preview ke global scope window
window.previewSelectedImage = previewSelectedImage;

function closeEditModal() {
    const modal = document.getElementById("editArticleModal");
    modal.classList.add("hidden");
    currentEditingId = null; // Reset ID
}

// Handler saat tombol submit [execute_update] ditekan
async function handleEditFormSubmit(event) {
    event.preventDefault(); // Mencegah reload halaman

    if (!currentEditingId) return;

    // Ambil data dari form
    const title = document.getElementById("editTitle").value;
    const slug = document.getElementById("editSlug").value;
    const tagsInput = document.getElementById("editTags").value;
    const content = document.getElementById("editContent").value;

    // Proses string tag menjadi array
    const tags = tagsInput
        .split(",")
        .map((t) => t.trim())
        .filter((t) => t !== "");

    // Susun payload sesuai struktur yang diharapkan oleh ArticleService.update
    const updatedPayload = {
        title,
        slug,
        tags,
        content, // Di service kamu sudah ada logic auto-parse JSON jika ini string, jadi aman dilempar langsung
    };

    try {
        // Eksekusi fungsi update yang kamu buat tadi
        await ArticleService.update(currentEditingId, updatedPayload);

        // Tutup modal dan refresh tabel agar data terbaru muncul
        closeEditModal();
        await refreshDashboardTable();

        // Opsional: Beri notifikasi sukses bergaya log terminal
        console.log(
            `[SYSTEM] Article #${currentEditingId} successfully updated.`,
        );
    } catch (error) {
        console.error("Failed to commit article update:", error);
        alert(`Error: ${error.message || "Failed to update article"}`);
    }
}

window.closeEditModal = closeEditModal;
window.handleEditFormSubmit = handleEditFormSubmit;

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
    if (event) event.preventDefault();

    const targetLink = event.currentTarget;
    const navContainer = document.getElementById("desktopNav");
    const indicator = document.getElementById("navIndicator");

    if (!targetLink || !navContainer || !indicator) return;

    // 1. KALKULASI PRESISI (Gunakan ini sebagai satu-satunya pengatur posisi)
    const targetRect = targetLink.getBoundingClientRect();
    const containerRect = navContainer.getBoundingClientRect();

    const relativeLeft = targetRect.left - containerRect.left;
    const targetWidth = targetRect.width;

    // Terapkan posisi baru yang presisi
    indicator.style.left = `${relativeLeft}px`;
    indicator.style.width = `${targetWidth}px`;

    // 2. Ambil semua kontainer seksi admin
    const dashboardSection = document.getElementById("admin-section-dashboard");
    const articlesSection = document.getElementById("admin-section-articles");

    if (!dashboardSection || !articlesSection) {
        console.error("Error: Kontainer seksi admin tidak ditemukan di DOM!");
        return;
    }

    // 3. Sembunyikan atau tampilkan seksi berdasarkan tabName
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

    // 4. Atur ulang class active text pada menu Navbar Desktop
    document.querySelectorAll("#desktopNav .nav-link").forEach((link) => {
        link.classList.remove("active", "text-neonGreen", "font-bold");
        link.classList.add("text-textSecondary");
    });

    // 5. Set menu yang sedang aktif saat ini (Hapus bagian penimpaan posisi indicator di sini)
    const clickedLink = document.querySelector(
        `#desktopNav .nav-link[data-tab="${tabName}"]`,
    );
    if (clickedLink) {
        clickedLink.classList.add("active", "text-neonGreen", "font-bold");
        clickedLink.classList.remove("text-textSecondary");

        // PENTING: Bagian penimpaan indicator.style.left dengan offsetLeft SUDAH DIHAPUS
        // agar tidak merusak koordinat presisi yang sudah dihitung di atas.
    }
};

// Otomatis posisikan kursor saat pertama kali halaman admin dimuat
document.addEventListener("DOMContentLoaded", () => {
    const activeLink = document.querySelector("#desktopNav .nav-link.active");
    if (activeLink) {
        // Beri jeda 200ms agar browser selesai merender font teks terlebih dahulu
        setTimeout(() => {
            const navContainer = document.getElementById("desktopNav");
            const indicator = document.getElementById("navIndicator");
            if (navContainer && indicator) {
                const targetRect = activeLink.getBoundingClientRect();
                const containerRect = navContainer.getBoundingClientRect();
                indicator.style.left = `${targetRect.left - containerRect.left}px`;
                indicator.style.width = `${targetRect.width}px`;
            }
        }, 200);
    }
});
