// Initialize Lucide icons
lucide.createIcons();

// ==================== ARTICLES DATA ====================
const articles = [
    {
        title: "Understanding Go Concurrency: Beyond Goroutines",
        date: "2024-12-15",
        readTime: "8 min read",
        tags: ["golang"],
        content: `
            <p>Go's concurrency model is one of the language's most powerful features, but many developers stop at <span class="inline-code">go func()</span> and miss the deeper patterns that make concurrent Go programs truly robust.</p>
            <h3>The GMP Model</h3>
            <p>Go's runtime uses the GMP scheduling model: <strong>G</strong>oroutines, <strong>M</strong>achine threads, and <strong>P</strong>rocessors. Understanding this helps you write more efficient concurrent code.</p>
        `,
    },
    {
        title: "Rust Lifetimes Demystified: A Practical Guide",
        date: "2024-12-08",
        readTime: "12 min read",
        tags: ["rust"],
        content: `
            <p>Lifetimes are Rust's way of ensuring that references are always valid. They don't change how your code runs — they're purely compile-time checks. Let's break them down with real examples.</p>
        `,
    },
    {
        title: "Async Python for High-Throughput APIs",
        date: "2024-11-29",
        readTime: "10 min read",
        tags: ["python", "devops"],
        content: `
            <p>Python's async/await syntax has matured significantly. With FastAPI and proper async patterns, you can handle thousands of concurrent connections on a single server.</p>
        `,
    },
    {
        title: "Go + PostgreSQL: Connection Pooling Done Right",
        date: "2024-11-20",
        readTime: "15 min read",
        tags: ["golang", "database"],
        content: `
            <p>Database connection pooling in Go seems simple — until you're handling 10k QPS and things start falling apart. Here's what I've learned from running PostgreSQL at scale.</p>
        `,
    },
    {
        title: "Building CLI Tools in Rust: From Zero to Published",
        date: "2024-11-05",
        readTime: "9 min read",
        tags: ["rust", "devops"],
        content: `
            <p>Rust is an excellent choice for CLI tools — fast startup, single binary output, and incredible ecosystem with <span class="inline-code">clap</span> for argument parsing and <span class="inline-code">tokio</span> for async.</p>
        `,
    },
];

// ==================== SECTION NAVIGATION ====================
window.showSection = function (name) {
    document.querySelectorAll('[id^="section-"]').forEach((s) => {
        s.classList.remove("section-visible");
        s.classList.add("section-hidden");
    });

    const target = document.getElementById("section-" + name);
    if (target) {
        target.classList.remove("section-hidden");
        target.classList.add("section-visible");
    }

    document.querySelectorAll(".nav-link").forEach((l) => {
        l.classList.remove("active");
        if (l.dataset.section === name) l.classList.add("active");
    });

    window.scrollTo({ top: 0, behavior: "smooth" });
    setTimeout(() => lucide.createIcons(), 50);
};

// ==================== ARTICLE DETAIL ====================
window.showArticle = function showArticle(index) {
    const article = articles[index];
    const metaEl = document.getElementById("articleMeta");
    const contentEl = document.getElementById("articleContent");

    let tagsHtml = article.tags
        .map((t) => {
            const classMap = {
                golang: "tag-golang",
                rust: "tag-rust",
                python: "tag-python",
                javascript: "tag-javascript",
                devops: "tag-devops",
                database: "tag-database",
            };
            return `<span class="${classMap[t] || ""} font-mono text-xs px-2 py-1 rounded-md">#${t}</span>`;
        })
        .join(" ");

    metaEl.innerHTML = `
        <div class="flex flex-wrap gap-2 mb-4">${tagsHtml}</div>
        <h1 class="text-3xl md:text-4xl font-bold tracking-tight mb-3 leading-tight">${article.title}</h1>
        <div class="flex items-center gap-4 font-mono text-xs text-textMuted">
            <span>${article.date}</span>
            <span class="text-border">·</span>
            <span>${article.readTime}</span>
            <span class="text-border">·</span>
            <span>Alex Chen</span>
        </div>
    `;

    contentEl.innerHTML = article.content;
    showSection("article-detail");
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
function copyCode(btn) {
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
}

// ==================== TOAST ====================
function showToast(message) {
    const toast = document.getElementById("toast");
    toast.textContent = message;
    toast.classList.add("show");
    setTimeout(() => toast.classList.remove("show"), 2500);
}

// ==================== MOBILE MENU ====================
window.toggleMobileMenu = function () {
    const menu = document.getElementById("mobileMenu");
    const overlay = document.getElementById("mobileOverlay");

    menu.classList.toggle("open");
    overlay.classList.toggle("hidden");

    console.log("hellow");
};

// ==================== THEME ACCENT TOGGLE ====================
let accentMode = 0;
function toggleThemeAccent() {
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
}

// ==================== READING PROGRESS ====================
window.addEventListener("scroll", () => {
    const scrollTop = document.documentElement.scrollTop;
    const scrollHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;
    const progress = (scrollTop / scrollHeight) * 100;
    document.getElementById("readingProgress").style.width = progress + "%";
});

// ==================== CONTACT FORM ====================
function handleContactSubmit(e) {
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
}

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
