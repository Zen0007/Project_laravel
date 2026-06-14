import { ArticleService } from "./api";

// Initialize Lucide icons
lucide.createIcons();

async function initBlog() {
    const grid = document.getElementById("articlesGrid");
    if (!grid) return;

    try {
        console.log("status");
        // Fetch all articles from Supabase using your api.js service
        const articles = await ArticleService.getAll();

        if (articles.length === 0) {
            grid.innerHTML = `<p class="text-textSecondary font-mono text-sm col-span-full text-center">No articles found.</p>`;
            return;
        }

        // Render each article dynamically using your ArticleService template
        grid.innerHTML = articles
            .map((article) => ArticleService.renderCard(article))
            .join("");

        // Re-initialize icons for the newly injected HTML
        lucide.createIcons();
    } catch (error) {
        console.error("Error fetching articles from Supabase:", error);
        showToast("⚠️ Failed to load articles from database");
    }
}

// ==================== SECTION NAVIGATION ====================
window.showSection = function (name) {
    console.log("Menjalankan showSection untuk:", name);

    // 1. Cek apakah user sedang berada di halaman admin panel
    const isAdminPath = window.location.pathname.startsWith("/admin");

    if (isAdminPath) {
        // Matikan efek manipulasi hash bawaan SPA di area admin panel
        const e = window.event || arguments.callee.caller.arguments[0];
        if (e && e.preventDefault) e.preventDefault();
        if (window.event) window.event.preventDefault();

        if (name === "home") {
            // Mengarahkan ke '/' polos agar ditangkap oleh Auth::check() di web.php
            // sehingga dashboard admin ter-refresh / ter-load kembali dengan benar
            window.location.href = "/";
        } else {
            // Jika menekan Articles, Projects, atau About, paksa keluar ke halaman luar
            // dengan menyertakan parameter '?public=true' agar tidak di-bounce kembali ke admin
            window.location.href = "/?public=true#" + name;
        }
        return;
    }

    // =========================================================
    // LOGIKA BAWAAN SPA (HANYA BERJALAN DI HALAMAN UTAMA BLOG / )
    // =========================================================
    if (window.event) window.event.preventDefault();

    const element = document.getElementById("section-" + name);

    if (!element) {
        window.location.href = "/#" + name;
        return;
    }

    // Pemindahan class active pada Navigasi
    const navLinks = document.querySelectorAll(".nav-link");
    if (navLinks.length > 0) {
        navLinks.forEach((link) => {
            const sectionAttr = link.getAttribute("data-section");
            if (sectionAttr === name) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        });
    }

    // Perpindahan section konten dengan aman
    try {
        document.querySelectorAll('[id^="section-"]').forEach((s) => {
            s.classList.remove("section-visible");
            s.classList.add("section-hidden");
        });

        element.classList.remove("section-hidden");
        element.classList.add("section-visible");
    } catch (error) {
        console.error("Terjadi error saat mengubah section konten:", error);
    }
};

// ==================== ARTICLE DETAIL ====================
window.showArticle = async function (id) {
    try {
        const article = await ArticleService.getById(id);

        document.getElementById("articleMeta").innerHTML = `
            <div class="flex flex-wrap gap-2 mb-4">
                ${ArticleService.buildTagsHtml(article.tags)}
            </div>

            <h1 class="text-3xl md:text-4xl font-bold tracking-tight mb-3">
                ${article.title}
            </h1>

            <div class="flex items-center gap-4 font-mono text-xs text-textMuted">
                <span>
                    ${ArticleService.formatDate(article.created_at)}
                </span>
                <span>·</span>
                <span>
                    ${article.read_time ?? ""}
                </span>
            </div>
        `;

        document.getElementById("articleContent").innerHTML = article.content;
        showSection("article-detail");
    } catch (error) {
        console.error(error);
        showToast("Failed loading article");
    }
};

// ==================== TAG FILTERING ====================
window.filterArticles = function (tag) {
    document.querySelectorAll(".tag-btn").forEach((btn) => {
        btn.classList.remove(
            "active",
            "bg-neonGreen/10",
            "text-neonGreen",
            "border",
            "border-neonGreen/30",
        );
        if (btn.dataset.tag === tag) {
            btn.classList.add(
                "active",
                "bg-neonGreen/10",
                "text-neonGreen",
                "border",
                "border-neonGreen/30",
            );
        }
    });

    document.querySelectorAll(".article-card").forEach((card) => {
        const cardTags = card.dataset.tags.split(",");
        if (tag === "all" || cardTags.includes(tag)) {
            card.style.display = "block";
            card.style.animation = "fadeIn 0.3s ease";
        } else {
            card.style.display = "none";
        }
    });
};

// ==================== COPY CODE ====================
window.copyCode = function (btn) {
    const codeBlock = btn.closest(".code-block");
    const code = codeBlock.querySelector("pre").textContent;
    navigator.clipboard.writeText(code).then(() => {
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i data-lucide="check" class="w-3 h-3"></i> Copied!';
        btn.classList.add("text-neonGreen");
        lucide.createIcons();
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove("text-neonGreen");
            lucide.createIcons();
        }, 2000);
    });
};

// ==================== TOAST ====================
function showToast(message) {
    const toast = document.getElementById("toast");

    if (!toast) return;

    toast.textContent = message;
    toast.classList.add("show");

    setTimeout(() => {
        toast.classList.remove("show");
    }, 2500);
}

// ==================== MOBILE MENU ====================
window.toggleMobileMenu = function () {
    const menu = document.getElementById("mobileMenu");
    const overlay = document.getElementById("mobileOverlay");

    if (!menu || !overlay) {
        console.error("Mobile menu elements not found");
        return;
    }

    menu.classList.toggle("open");
    overlay.classList.toggle("hidden");
};

// ==================== THEME ACCENT TOGGLE ====================
let accentMode = 0;
window.toggleThemeAccent = function () {
    accentMode = (accentMode + 1) % 3;
    const root = document.documentElement.style;
    if (accentMode === 0) {
        root.setProperty("--neon-primary", "#00FF00");
        root.setProperty("--neon-secondary", "#00D7FF");
        showToast("🎨 Theme: Terminal Green");
    } else if (accentMode === 1) {
        root.setProperty("--neon-primary", "#FF79C6");
        root.setProperty("--neon-secondary", "#8BE9FD");
        showToast("🎨 Theme: Cyberpunk Pink");
    } else {
        root.setProperty("--neon-primary", "#FFD700");
        root.setProperty("--neon-secondary", "#FF6E6E");
        showToast("🎨 Theme: Warm Amber");
    }
};

// ==================== READING PROGRESS ====================
window.addEventListener("scroll", () => {
    const progressBar = document.getElementById("readingProgress");

    if (!progressBar) return;

    const scrollTop = document.documentElement.scrollTop;
    const scrollHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

    const progress = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;

    progressBar.style.width = `${progress}%`;
});

// ==================== CONTACT FORM ====================
window.handleContactSubmit = function (e) {
    e.preventDefault();
    const form = e.target;
    const btn = form.querySelector('button[type="submit"]');
    const originalText = btn.textContent;
    btn.textContent = "$ sending...";
    btn.disabled = true;

    setTimeout(() => {
        btn.textContent = "$ sent ✓";
        btn.classList.remove("bg-neonGreen", "hover:bg-neonGreenDim");
        btn.classList.add("bg-neonBlue");
        showToast("✉️ Message sent successfully!");
        form.reset();

        setTimeout(() => {
            btn.textContent = originalText;
            btn.disabled = false;
            btn.classList.add("bg-neonGreen", "hover:bg-neonGreenDim");
            btn.classList.remove("bg-neonBlue");
        }, 2000);
    }, 1200);
};

// window.toggleMobileMenu = toggleMobileMenu;
// window.showSection = showSection;
// window.showArticle = showArticle;
// window.filterArticles = filterArticles;
// window.copyCode = copyCode;
// window.handleContactSubmit = handleContactSubmit;
// window.toggleThemeAccent = toggleThemeAccent;

// ==================== KEYBOARD SHORTCUTS ====================
document.addEventListener("keydown", (e) => {
    if (e.target.tagName === "INPUT" || e.target.tagName === "TEXTAREA") return;
    if (e.key === "1") showSection("home");
    if (e.key === "2") showSection("articles");
    if (e.key === "3") showSection("projects");
    if (e.key === "4") showSection("about");
    if (e.key === "/") {
        e.preventDefault();
        showToast("⌨️ Shortcuts: 1=Home, 2=Articles, 3=Projects, 4=About");
    }
});
document.addEventListener("DOMContentLoaded", () => {
    lucide.createIcons();
    initBlog(); // <-- Trigger the Supabase data fetch right here
});
