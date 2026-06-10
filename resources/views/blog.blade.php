<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dev.log — A Programmer's Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bg: '#0a0a0a',
                        surface: '#1e1e1e',
                        surfaceLight: '#2a2a2a',
                        surfaceHover: '#333333',
                        textPrimary: '#e6e6e6',
                        textSecondary: '#888888',
                        textMuted: '#555555',
                        neonGreen: '#00FF00',
                        neonBlue: '#00D7FF',
                        neonGreenDim: '#00CC00',
                        neonBlueDim: '#00AACC',
                        border: '#2a2a2a',
                        borderLight: '#3a3a3a',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #0a0a0a; color: #e6e6e6; font-family: 'Inter', sans-serif; }
        ::selection { background: #00FF00; color: #0a0a0a; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #333; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #00FF00; }

        .font-mono { font-family: 'JetBrains Mono', monospace; }

        /* Syntax Highlighting */
        .code-block { background: #0d0d0d; border: 1px solid #2a2a2a; border-radius: 8px; overflow: hidden; }
        .code-header { background: #1a1a1a; border-bottom: 1px solid #2a2a2a; padding: 8px 16px; display: flex; align-items: center; justify-content: space-between; }
        .code-dots { display: flex; gap: 6px; }
        .code-dots span { width: 10px; height: 10px; border-radius: 50%; }
        .code-content { padding: 16px; overflow-x: auto; font-size: 13px; line-height: 1.7; }
        .code-content .keyword { color: #00D7FF; }
        .code-content .string { color: #00FF00; }
        .code-content .comment { color: #555; font-style: italic; }
        .code-content .function { color: #FFD700; }
        .code-content .type { color: #FF79C6; }
        .code-content .number { color: #BD93F9; }
        .code-content .operator { color: #FF6E6E; }
        .code-content .variable { color: #e6e6e6; }
        .code-content .package { color: #8BE9FD; }
        .code-content .decorator { color: #FF79C6; }

        /* Terminal */
        .terminal { background: #0d0d0d; border: 1px solid #2a2a2a; border-radius: 8px; overflow: hidden; }
        .terminal-header { background: #1a1a1a; border-bottom: 1px solid #2a2a2a; padding: 10px 16px; display: flex; align-items: center; gap: 8px; }
        .terminal-body { padding: 16px; font-family: 'JetBrains Mono', monospace; font-size: 13px; line-height: 1.8; }
        .terminal-prompt { color: #00FF00; }
        .terminal-cmd { color: #e6e6e6; }
        .terminal-output { color: #888; }
        .terminal-cursor { display: inline-block; width: 8px; height: 16px; background: #00FF00; animation: blink 1s infinite; vertical-align: middle; margin-left: 2px; }
        @keyframes blink { 0%, 50% { opacity: 1; } 51%, 100% { opacity: 0; } }

        /* Glow effects */
        .glow-green { text-shadow: 0 0 10px rgba(0,255,0,0.3); }
        .glow-blue { text-shadow: 0 0 10px rgba(0,215,255,0.3); }
        .border-glow-green { box-shadow: 0 0 0 1px rgba(0,255,0,0.1), 0 0 20px rgba(0,255,0,0.05); }
        .border-glow-blue { box-shadow: 0 0 0 1px rgba(0,215,255,0.1), 0 0 20px rgba(0,215,255,0.05); }

        /* Tag styles */
        .tag-golang { background: rgba(0,215,255,0.1); color: #00D7FF; border: 1px solid rgba(0,215,255,0.2); }
        .tag-rust { background: rgba(255,121,198,0.1); color: #FF79C6; border: 1px solid rgba(255,121,198,0.2); }
        .tag-python { background: rgba(255,215,0,0.1); color: #FFD700; border: 1px solid rgba(255,215,0,0.2); }
        .tag-javascript { background: rgba(0,255,0,0.1); color: #00FF00; border: 1px solid rgba(0,255,0,0.2); }
        .tag-devops { background: rgba(189,147,249,0.1); color: #BD93F9; border: 1px solid rgba(189,147,249,0.2); }
        .tag-database { background: rgba(255,110,110,0.1); color: #FF6E6E; border: 1px solid rgba(255,110,110,0.2); }

        /* Article card hover */
        .article-card { transition: all 0.3s ease; border: 1px solid #2a2a2a; }
        .article-card:hover { border-color: #3a3a3a; transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,0.3); }

        /* Nav link */
        .nav-link { position: relative; transition: color 0.2s; }
        .nav-link::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 1px; background: #00FF00; transition: width 0.3s; }
        .nav-link:hover::after, .nav-link.active::after { width: 100%; }
        .nav-link:hover, .nav-link.active { color: #00FF00; }

        /* Repo card */
        .repo-card { transition: all 0.3s ease; border: 1px solid #2a2a2a; }
        .repo-card:hover { border-color: #00D7FF; box-shadow: 0 0 20px rgba(0,215,255,0.05); }

        /* Section transitions */
        .section-hidden { display: none; }
        .section-visible { display: block; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* Typing animation */
        @keyframes typing { from { width: 0; } to { width: 100%; } }
        .typing-text { overflow: hidden; white-space: nowrap; border-right: 2px solid #00FF00; animation: typing 2.5s steps(30) forwards, blinkCaret 0.75s step-end infinite; }
        @keyframes blinkCaret { 50% { border-color: transparent; } }

        /* Grid background */
        .grid-bg {
            background-image:
                linear-gradient(rgba(0,255,0,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,255,0,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Toast notification */
        .toast {
            position: fixed; bottom: 24px; right: 24px; background: #1e1e1e;
            border: 1px solid #00FF00; color: #00FF00; padding: 12px 20px;
            border-radius: 8px; font-family: 'JetBrains Mono', monospace;
            font-size: 13px; z-index: 1000; transform: translateY(100px);
            opacity: 0; transition: all 0.3s ease;
        }
        .toast.show { transform: translateY(0); opacity: 1; }

        /* Mobile menu */
        .mobile-menu { transform: translateX(100%); transition: transform 0.3s ease; }
        .mobile-menu.open { transform: translateX(0); }

        /* Article detail inline code */
        .inline-code {
            background: #2a2a2a; padding: 2px 6px; border-radius: 4px;
            font-family: 'JetBrains Mono', monospace; font-size: 0.875em;
            color: #00D7FF; border: 1px solid #3a3a3a;
        }

        /* Progress bar */
        .reading-progress { position: fixed; top: 0; left: 0; height: 2px; background: #00FF00; z-index: 100; transition: width 0.1s; }
    </style>
</head>
<body class="grid-bg">

    <!-- Reading Progress Bar -->
    <div class="reading-progress" id="readingProgress" style="width: 0%;"></div>

    <!-- Toast -->
    <div class="toast" id="toast"></div>

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-bg/90 backdrop-blur-xl border-b border-border">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="#" onclick="showSection('home')" class="font-mono font-bold text-lg tracking-tight">
                <span class="text-neonGreen">~</span><span class="text-textPrimary">/dev.log</span>
            </a>
            <div class="hidden md:flex items-center gap-8">
                <a href="#" onclick="showSection('home')" class="nav-link active text-sm font-mono text-textSecondary" data-section="home">Home</a>
                <a href="#" onclick="showSection('articles')" class="nav-link text-sm font-mono text-textSecondary" data-section="articles">Articles</a>
                <a href="#" onclick="showSection('projects')" class="nav-link text-sm font-mono text-textSecondary" data-section="projects">Projects</a>
                <a href="#" onclick="showSection('about')" class="nav-link text-sm font-mono text-textSecondary" data-section="about">About</a>
            </div>
            <div class="hidden md:flex items-center gap-3">
                <button onclick="toggleThemeAccent()" class="p-2 rounded-lg hover:bg-surfaceLight transition-colors text-textSecondary hover:text-neonGreen" title="Toggle accent color">
                    <i data-lucide="palette" class="w-4 h-4"></i>
                </button>
                <a href="https://github.com" target="_blank" class="p-2 rounded-lg hover:bg-surfaceLight transition-colors text-textSecondary hover:text-neonGreen">
                    <i data-lucide="github" class="w-4 h-4"></i>
                </a>
            </div>
            <button onclick="toggleMobileMenu()" class="md:hidden p-2 text-textSecondary">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu fixed top-0 right-0 w-72 h-full bg-surface z-50 border-l border-border p-6" id="mobileMenu">
        <div class="flex justify-between items-center mb-8">
            <span class="font-mono text-neonGreen text-sm">Navigation</span>
            <button onclick="toggleMobileMenu()" class="text-textSecondary hover:text-neonGreen">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
        <div class="flex flex-col gap-4">
            <a href="#" onclick="showSection('home');toggleMobileMenu()" class="font-mono text-sm text-textSecondary hover:text-neonGreen transition-colors py-2">~/ Home</a>
            <a href="#" onclick="showSection('articles');toggleMobileMenu()" class="font-mono text-sm text-textSecondary hover:text-neonGreen transition-colors py-2">~/ Articles</a>
            <a href="#" onclick="showSection('projects');toggleMobileMenu()" class="font-mono text-sm text-textSecondary hover:text-neonGreen transition-colors py-2">~/ Projects</a>
            <a href="#" onclick="showSection('about');toggleMobileMenu()" class="font-mono text-sm text-textSecondary hover:text-neonGreen transition-colors py-2">~/ About</a>
        </div>
    </div>
    <div class="fixed inset-0 bg-black/50 z-40 hidden" id="mobileOverlay" onclick="toggleMobileMenu()"></div>

    <!-- ==================== HOME SECTION ==================== -->
    <section id="section-home" class="section-visible pt-16">
        <!-- Hero -->
        <div class="min-h-screen flex items-center justify-center px-6">
            <div class="max-w-4xl w-full">
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <!-- Avatar -->
                    <div class="relative flex-shrink-0">
                        <div class="w-40 h-40 rounded-2xl overflow-hidden border-2 border-neonGreen/30 border-glow-green">
                            <img src="https://icehousecorp.com/wp-content/uploads/2022/04/go-768x525.png" alt="Avatar" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-neonGreen text-bg font-mono text-xs font-bold px-2 py-1 rounded-md">
                            ONLINE
                        </div>
                    </div>

                    <!-- Intro -->
                    <div class="text-center md:text-left">
                        <div class="font-mono text-xs text-neonGreen mb-3 tracking-widest uppercase">Hello, World!</div>
                        <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-4 leading-tight">
                        My <span class="text-neonGreen glow-green">Backend Go</span>
                        </h1>
                        <p class="font-mono text-textSecondary text-sm md:text-base mb-6 leading-relaxed max-w-lg">
                            Full-stack developer & systems programmer.<br>
                            Building performant software with <span class="text-neonBlue">Go</span>, <span class="text-[#FF79C6]">Rust</span>, and <span class="text-[#FFD700]">Python</span>.<br>
                            Obsessed with distributed systems and clean code.
                        </p>

                        <!-- Terminal-style status -->
                        <div class="terminal max-w-md mb-6">
                            <div class="terminal-header">
                                <div class="code-dots">
                                    <span class="bg-[#FF5F56]"></span>
                                    <span class="bg-[#FFBD2E]"></span>
                                    <span class="bg-[#27C93F]"></span>
                                </div>
                                <span class="font-mono text-xs text-textMuted">status.sh</span>
                            </div>
                            <div class="terminal-body text-xs">
                                <div><span class="terminal-prompt">$</span> <span class="terminal-cmd">cat status.json</span></div>
                                <div class="terminal-output">{</div>
                                <div class="terminal-output">  "location": <span class="string">"San Francisco, CA"</span>,</div>
                                <div class="terminal-output">  "experience": <span class="number">8</span>,</div>
                                <div class="terminal-output">  "languages": [<span class="string">"Go"</span>, <span class="string">"Rust"</span>, <span class="string">"Python"</span>, <span class="string">"TS"</span>],</div>
                                <div class="terminal-output">  "available": <span class="keyword">true</span></div>
                                <div class="terminal-output">}</div>
                                <div><span class="terminal-prompt">$</span> <span class="terminal-cursor"></span></div>
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="flex items-center gap-3 justify-center md:justify-start">
                            <a href="#" class="p-3 rounded-xl bg-surface border border-border hover:border-neonGreen/30 hover:text-neonGreen text-textSecondary transition-all" title="GitHub">
                                <i data-lucide="github" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="p-3 rounded-xl bg-surface border border-border hover:border-neonBlue/30 hover:text-neonBlue text-textSecondary transition-all" title="Twitter/X">
                                <i data-lucide="twitter" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="p-3 rounded-xl bg-surface border border-border hover:border-neonGreen/30 hover:text-neonGreen text-textSecondary transition-all" title="LinkedIn">
                                <i data-lucide="linkedin" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="p-3 rounded-xl bg-surface border border-border hover:border-neonBlue/30 hover:text-neonBlue text-textSecondary transition-all" title="Email">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="p-3 rounded-xl bg-surface border border-border hover:border-neonGreen/30 hover:text-neonGreen text-textSecondary transition-all" title="RSS">
                                <i data-lucide="rss" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Scroll indicator -->
                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-textMuted">
                    <span class="font-mono text-xs">scroll</span>
                    <div class="w-px h-8 bg-gradient-to-b from-textMuted to-transparent animate-pulse"></div>
                </div>
            </div>
        </div>

        <!-- Latest Code Snippet Showcase -->
        <div class="max-w-6xl mx-auto px-6 pb-24">
            <div class="font-mono text-xs text-textMuted mb-4">// latest snippet</div>
            <div class="code-block border-glow-green">
                <div class="code-header">
                    <div class="code-dots">
                        <span class="bg-[#FF5F56]"></span>
                        <span class="bg-[#FFBD2E]"></span>
                        <span class="bg-[#27C93F]"></span>
                    </div>
                    <span class="font-mono text-xs text-textMuted">main.go — concurrent pipeline</span>
                    <button onclick="copyCode(this)" class="font-mono text-xs text-textMuted hover:text-neonGreen transition-colors flex items-center gap-1">
                        <i data-lucide="copy" class="w-3 h-3"></i> Copy
                    </button>
                </div>
                <div class="code-content font-mono">
<pre><span class="keyword">package</span> <span class="package">main</span>

<span class="keyword">import</span> (
    <span class="string">"fmt"</span>
    <span class="string">"sync"</span>
)

<span class="comment">// Pipeline processes data through multiple stages concurrently</span>
<span class="keyword">func</span> <span class="function">Pipeline</span>(input <span class="keyword">chan</span> <span class="type">int</span>, stages <span class="type">int</span>) <span class="keyword">chan</span> <span class="type">int</span> {
    <span class="variable">output</span> <span class="operator">:=</span> <span class="keyword">make</span>(<span class="keyword">chan</span> <span class="type">int</span>)
    <span class="keyword">var</span> <span class="variable">wg</span> <span class="type">sync.WaitGroup</span>

    <span class="keyword">for</span> <span class="variable">i</span> <span class="operator">:=</span> <span class="number">0</span>; <span class="variable">i</span> <span class="operator">&lt;</span> <span class="variable">stages</span>; <span class="variable">i</span><span class="operator">++</span> {
        <span class="variable">wg</span>.<span class="function">Add</span>(<span class="number">1</span>)
        <span class="keyword">go</span> <span class="keyword">func</span>(<span class="variable">stage</span> <span class="type">int</span>) {
            <span class="keyword">defer</span> <span class="variable">wg</span>.<span class="function">Done</span>()
            <span class="keyword">for</span> <span class="variable">val</span> <span class="operator">:=</span> <span class="keyword">range</span> <span class="variable">input</span> {
                <span class="variable">output</span> <span class="operator">&lt;-</span> <span class="variable">val</span> <span class="operator">*</span> (<span class="variable">stage</span> <span class="operator">+</span> <span class="number">1</span>)
            }
        }(<span class="variable">i</span>)
    }

    <span class="keyword">go</span> <span class="keyword">func</span>() {
        <span class="variable">wg</span>.<span class="function">Wait</span>()
        <span class="function">close</span>(<span class="variable">output</span>)
    }()

    <span class="keyword">return</span> <span class="variable">output</span>
}</pre>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== ARTICLES SECTION ==================== -->
    <section id="section-articles" class="section-hidden pt-24 pb-24">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Section Header -->
            <div class="mb-12">
                <div class="font-mono text-xs text-neonGreen mb-2 tracking-widest uppercase">Blog</div>
                <h2 class="text-3xl md:text-4xl font-bold tracking-tight mb-2">Articles</h2>
                <p class="text-textSecondary font-mono text-sm">Thoughts on code, architecture, and engineering.</p>
            </div>

            <!-- Tag Filter -->
            <div class="flex flex-wrap gap-2 mb-10" id="tagFilter">
                <button onclick="filterArticles('all')" class="tag-btn active font-mono text-xs px-4 py-2 rounded-lg bg-neonGreen/10 text-neonGreen border border-neonGreen/30 transition-all hover:bg-neonGreen/20" data-tag="all">
                    All Posts
                </button>
                <button onclick="filterArticles('golang')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-golang transition-all hover:opacity-80" data-tag="golang">
                    #golang
                </button>
                <button onclick="filterArticles('rust')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-rust transition-all hover:opacity-80" data-tag="rust">
                    #rust
                </button>
                <button onclick="filterArticles('python')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-python transition-all hover:opacity-80" data-tag="python">
                    #python
                </button>
                <button onclick="filterArticles('javascript')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-javascript transition-all hover:opacity-80" data-tag="javascript">
                    #javascript
                </button>
                <button onclick="filterArticles('devops')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-devops transition-all hover:opacity-80" data-tag="devops">
                    #devops
                </button>
                <button onclick="filterArticles('database')" class="tag-btn font-mono text-xs px-4 py-2 rounded-lg tag-database transition-all hover:opacity-80" data-tag="database">
                    #database
                </button>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="articlesGrid">
                <!-- Article 1 -->
                <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="golang" onclick="showArticle(0)">
                    <div class="h-44 bg-surfaceLight relative overflow-hidden">
                      <img src="data:image/jpeg;base64,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" alt="" class="w-full h-full object-cover opacity-60">
                      <div class="absolute top-3 left-3"><span class="tag-golang font-mono text-xs px-2 py-1 rounded-md">#golang</span></div>
                    </div>
                    <div class="p-5">
                        <div class="font-mono text-xs text-textMuted mb-2">2024-12-15 · 8 min read</div>
                        <h3 class="font-semibold text-textPrimary mb-2 leading-snug">Understanding Go Concurrency: Beyond Goroutines</h3>
                        <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">Deep dive into Go's concurrency model — channels, select statements, context propagation, and common patterns for building robust concurrent systems.</p>
                    </div>
                </article>

                <!-- Article 2 -->
                <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="rust" onclick="showArticle(1)">
                    <div class="h-44 bg-surfaceLight relative overflow-hidden">
                         <img src="data:image/png;base64,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" alt="" class="w-full h-full object-cover opacity-60">
                         <div class="absolute top-3 left-3"><span class="tag-rust font-mono text-xs px-2 py-1 rounded-md">#rust</span></div>
                    </div>
                    <div class="p-5">
                        <div class="font-mono text-xs text-textMuted mb-2">2024-12-08 · 12 min read</div>
                        <h3 class="font-semibold text-textPrimary mb-2 leading-snug">Rust Lifetimes Demystified: A Practical Guide</h3>
                        <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">Lifetime annotations don't have to be scary. Learn through practical examples how Rust's borrow checker ensures memory safety at compile time.</p>
                    </div>
                </article>

                <!-- Article 3 -->
                <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="python,devops" onclick="showArticle(2)">
                    <div class="h-44 bg-surfaceLight relative overflow-hidden">
                        <img src="data:image/png;base64,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" alt="" class="w-full h-full object-cover opacity-60">
                        <div class="absolute top-3 left-3 flex gap-1">
                            <span class="tag-python font-mono text-xs px-2 py-1 rounded-md">#python</span>
                            <span class="tag-devops font-mono text-xs px-2 py-1 rounded-md">#devops</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="font-mono text-xs text-textMuted mb-2">2024-11-29 · 10 min read</div>
                        <h3 class="font-semibold text-textPrimary mb-2 leading-snug">Async Python for High-Throughput APIs</h3>
                        <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">Building production-grade async APIs with FastAPI, handling 10k+ concurrent connections with proper resource management.</p>
                    </div>
                </article>

                <!-- Article 4 -->
                <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="golang,database" onclick="showArticle(3)">
                    <div class="h-44 bg-surfaceLight relative overflow-hidden">
                        <img src="https://picsum.photos/seed/gopgdb/600/400.jpg" alt="" class="w-full h-full object-cover opacity-60">
                        <div class="absolute top-3 left-3 flex gap-1">
                            <span class="tag-golang font-mono text-xs px-2 py-1 rounded-md">#golang</span>
                            <span class="tag-database font-mono text-xs px-2 py-1 rounded-md">#database</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="font-mono text-xs text-textMuted mb-2">2024-11-20 · 15 min read</div>
                        <h3 class="font-semibold text-textPrimary mb-2 leading-snug">Go + PostgreSQL: Connection Pooling Done Right</h3>
                        <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">Optimizing database connections in Go services — pool sizing, prepared statements, and avoiding common pitfalls in high-load scenarios.</p>
                    </div>
                </article>

                <!-- Article 5 -->
                <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="javascript" onclick="showArticle(4)">
                    <div class="h-44 bg-surfaceLight relative overflow-hidden">
                        <img src="https://picsum.photos/seed/tsedge/600/400.jpg" alt="" class="w-full h-full object-cover opacity-60">
                        <div class="absolute top-3 left-3"><span class="tag-javascript font-mono text-xs px-2 py-1 rounded-md">#javascript</span></div>
                    </div>
                    <div class="p-5">
                        <div class="font-mono text-xs text-textMuted mb-2">2024-11-12 · 7 min read</div>
                        <h3 class="font-semibold text-textPrimary mb-2 leading-snug">TypeScript Edge Runtime: Beyond Node.js</h3>
                        <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">Exploring the new wave of TypeScript runtimes — Deno, Bun, and Cloudflare Workers — and when to choose each.</p>
                    </div>
                </article>

                <!-- Article 6 -->
                <article class="article-card rounded-xl bg-surface overflow-hidden cursor-pointer" data-tags="rust,devops" onclick="showArticle(5)">
                    <div class="h-44 bg-surfaceLight relative overflow-hidden">
                        <img src="data:image/jpeg;base64,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" alt="" class="w-full h-full object-cover opacity-60">
                        <div class="absolute top-3 left-3 flex gap-1">
                            <span class="tag-rust font-mono text-xs px-2 py-1 rounded-md">#rust</span>
                            <span class="tag-devops font-mono text-xs px-2 py-1 rounded-md">#devops</span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="font-mono text-xs text-textMuted mb-2">2024-11-05 · 9 min read</div>
                        <h3 class="font-semibold text-textPrimary mb-2 leading-snug">Building CLI Tools in Rust: From Zero to Published</h3>
                        <p class="text-textSecondary text-sm leading-relaxed line-clamp-3">A complete guide to building, testing, and publishing CLI tools with Rust using Clap and Tokio.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ==================== ARTICLE DETAIL SECTION ==================== -->
    <section id="section-article-detail" class="section-hidden pt-24 pb-24">
        <div class="max-w-3xl mx-auto px-6">
            <!-- Back button -->
            <button onclick="showSection('articles')" class="font-mono text-xs text-textMuted hover:text-neonGreen transition-colors flex items-center gap-2 mb-8">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to articles
            </button>

            <!-- Article Meta -->
            <div class="mb-6" id="articleMeta"></div>

            <!-- Article Content -->
            <div class="prose-custom" id="articleContent"></div>

            <!-- Article Footer -->
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

    <!-- ==================== PROJECTS SECTION ==================== -->
    <section id="section-projects" class="section-hidden pt-24 pb-24">
        <div class="max-w-6xl mx-auto px-6">
            <div class="mb-12">
                <div class="font-mono text-xs text-neonBlue mb-2 tracking-widest uppercase">Open Source</div>
                <h2 class="text-3xl md:text-4xl font-bold tracking-tight mb-2">Projects</h2>
                <p class="text-textSecondary font-mono text-sm">Tools and libraries I've built and maintain.</p>
            </div>

            <div class="space-y-4">
                <!-- Repo 1 -->
                <div class="repo-card rounded-xl bg-surface p-6">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <i data-lucide="book-open" class="w-4 h-4 text-textMuted"></i>
                                <a href="#" class="text-neonBlue hover:underline font-mono text-sm font-medium">alexchen/go-pipeline</a>
                                <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-surfaceLight text-textMuted border border-border">Public</span>
                            </div>
                            <p class="text-textSecondary text-sm mb-4">A lightweight, composable pipeline library for Go with built-in concurrency control, error handling, and middleware support.</p>
                            <div class="flex flex-wrap items-center gap-4 font-mono text-xs text-textMuted">
                                <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-neonGreen"></span> Go</span>
                                <span class="flex items-center gap-1"><i data-lucide="star" class="w-3 h-3"></i> 2.4k</span>
                                <span class="flex items-center gap-1"><i data-lucide="git-fork" class="w-3 h-3"></i> 189</span>
                                <span class="flex items-center gap-1"><i data-lucide="circle-dot" class="w-3 h-3"></i> 12 issues</span>
                            </div>
                        </div>
                        <div class="flex gap-2 flex-shrink-0">
                            <button onclick="showToast('⭐ Starred go-pipeline')" class="font-mono text-xs px-4 py-2 rounded-lg border border-neonGreen/30 text-neonGreen hover:bg-neonGreen/10 transition-colors">
                                <i data-lucide="star" class="w-3 h-3 inline mr-1"></i>Star
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Repo 2 -->
                <div class="repo-card rounded-xl bg-surface p-6">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <i data-lucide="book-open" class="w-4 h-4 text-textMuted"></i>
                                <a href="#" class="text-neonBlue hover:underline font-mono text-sm font-medium">alexchen/rustql</a>
                                <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-surfaceLight text-textMuted border border-border">Public</span>
                            </div>
                            <p class="text-textSecondary text-sm mb-4">Type-safe SQL query builder for Rust with compile-time query validation and zero-cost abstractions over raw SQL.</p>
                            <div class="flex flex-wrap items-center gap-4 font-mono text-xs text-textMuted">
                                <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-[#FF79C6]"></span> Rust</span>
                                <span class="flex items-center gap-1"><i data-lucide="star" class="w-3 h-3"></i> 1.8k</span>
                                <span class="flex items-center gap-1"><i data-lucide="git-fork" class="w-3 h-3"></i> 97</span>
                                <span class="flex items-center gap-1"><i data-lucide="circle-dot" class="w-3 h-3"></i> 5 issues</span>
                            </div>
                        </div>
                        <div class="flex gap-2 flex-shrink-0">
                            <button onclick="showToast('⭐ Starred rustql')" class="font-mono text-xs px-4 py-2 rounded-lg border border-neonGreen/30 text-neonGreen hover:bg-neonGreen/10 transition-colors">
                                <i data-lucide="star" class="w-3 h-3 inline mr-1"></i>Star
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Repo 3 -->
                <div class="repo-card rounded-xl bg-surface p-6">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <i data-lucide="book-open" class="w-4 h-4 text-textMuted"></i>
                                <a href="#" class="text-neonBlue hover:underline font-mono text-sm font-medium">alexchen/dotfiles</a>
                                <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-surfaceLight text-textMuted border border-border">Public</span>
                            </div>
                            <p class="text-textSecondary text-sm mb-4">My personal Neovim + Tmux + Zsh configuration. Optimized for Go and Rust development with LSP, treesitter, and custom keymaps.</p>
                            <div class="flex flex-wrap items-center gap-4 font-mono text-xs text-textMuted">
                                <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-[#FFD700]"></span> Vim script</span>
                                <span class="flex items-center gap-1"><i data-lucide="star" class="w-3 h-3"></i> 945</span>
                                <span class="flex items-center gap-1"><i data-lucide="git-fork" class="w-3 h-3"></i> 234</span>
                                <span class="flex items-center gap-1"><i data-lucide="circle-dot" class="w-3 h-3"></i> 2 issues</span>
                            </div>
                        </div>
                        <div class="flex gap-2 flex-shrink-0">
                            <button onclick="showToast('⭐ Starred dotfiles')" class="font-mono text-xs px-4 py-2 rounded-lg border border-neonGreen/30 text-neonGreen hover:bg-neonGreen/10 transition-colors">
                                <i data-lucide="star" class="w-3 h-3 inline mr-1"></i>Star
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Repo 4 -->
                <div class="repo-card rounded-xl bg-surface p-6">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <i data-lucide="book-open" class="w-4 h-4 text-textMuted"></i>
                                <a href="#" class="text-neonBlue hover:underline font-mono text-sm font-medium">alexchen/async-cache</a>
                                <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-surfaceLight text-textMuted border border-border">Public</span>
                            </div>
                            <p class="text-textSecondary text-sm mb-4">High-performance async caching library for Python with TTL, LRU eviction, and support for multiple backends (Redis, Memcached, in-memory).</p>
                            <div class="flex flex-wrap items-center gap-4 font-mono text-xs text-textMuted">
                                <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-[#FFD700]"></span> Python</span>
                                <span class="flex items-center gap-1"><i data-lucide="star" class="w-3 h-3"></i> 678</span>
                                <span class="flex items-center gap-1"><i data-lucide="git-fork" class="w-3 h-3"></i> 45</span>
                                <span class="flex items-center gap-1"><i data-lucide="circle-dot" class="w-3 h-3"></i> 8 issues</span>
                            </div>
                        </div>
                        <div class="flex gap-2 flex-shrink-0">
                            <button onclick="showToast('⭐ Starred async-cache')" class="font-mono text-xs px-4 py-2 rounded-lg border border-neonGreen/30 text-neonGreen hover:bg-neonGreen/10 transition-colors">
                                <i data-lucide="star" class="w-3 h-3 inline mr-1"></i>Star
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Repo 5 -->
                <div class="repo-card rounded-xl bg-surface p-6">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <i data-lucide="book-open" class="w-4 h-4 text-textMuted"></i>
                                <a href="#" class="text-neonBlue hover:underline font-mono text-sm font-medium">alexchen/ts-bundler</a>
                                <span class="font-mono text-xs px-2 py-0.5 rounded-full bg-surfaceLight text-textMuted border border-border">Public</span>
                            </div>
                            <p class="text-textSecondary text-sm mb-4">A zero-config TypeScript bundler written in Rust. 10x faster than webpack for most projects with native tree-shaking and minification.</p>
                            <div class="flex flex-wrap items-center gap-4 font-mono text-xs text-textMuted">
                                <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-[#FF79C6]"></span> Rust</span>
                                <span class="flex items-center gap-1"><i data-lucide="star" class="w-3 h-3"></i> 3.1k</span>
                                <span class="flex items-center gap-1"><i data-lucide="git-fork" class="w-3 h-3"></i> 156</span>
                                <span class="flex items-center gap-1"><i data-lucide="circle-dot" class="w-3 h-3"></i> 21 issues</span>
                            </div>
                        </div>
                        <div class="flex gap-2 flex-shrink-0">
                            <button onclick="showToast('⭐ Starred ts-bundler')" class="font-mono text-xs px-4 py-2 rounded-lg border border-neonGreen/30 text-neonGreen hover:bg-neonGreen/10 transition-colors">
                                <i data-lucide="star" class="w-3 h-3 inline mr-1"></i>Star
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GitHub Stats -->
            <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-surface border border-border rounded-xl p-5 text-center">
                    <div class="text-2xl font-bold text-neonGreen font-mono">8.9k</div>
                    <div class="font-mono text-xs text-textMuted mt-1">Total Stars</div>
                </div>
                <div class="bg-surface border border-border rounded-xl p-5 text-center">
                    <div class="text-2xl font-bold text-neonBlue font-mono">721</div>
                    <div class="font-mono text-xs text-textMuted mt-1">Total Forks</div>
                </div>
                <div class="bg-surface border border-border rounded-xl p-5 text-center">
                    <div class="text-2xl font-bold text-neonGreen font-mono">47</div>
                    <div class="font-mono text-xs text-textMuted mt-1">Repositories</div>
                </div>
                <div class="bg-surface border border-border rounded-xl p-5 text-center">
                    <div class="text-2xl font-bold text-neonBlue font-mono">1,247</div>
                    <div class="font-mono text-xs text-textMuted mt-1">Contributions (yr)</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== ABOUT SECTION ==================== -->
    <section id="section-about" class="section-hidden pt-24 pb-24">
        <div class="max-w-6xl mx-auto px-6">
            <div class="mb-12">
                <div class="font-mono text-xs text-neonGreen mb-2 tracking-widest uppercase">About</div>
                <h2 class="text-3xl md:text-4xl font-bold tracking-tight mb-2">About Me</h2>
                <p class="text-textSecondary font-mono text-sm">Developer. Builder. Lifelong learner.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Bio -->
                    <div class="bg-surface border border-border rounded-xl p-8">
                        <h3 class="font-mono text-sm text-neonGreen mb-4 flex items-center gap-2">
                            <i data-lucide="user" class="w-4 h-4"></i> Who I Am
                        </h3>
                        <div class="text-textSecondary text-sm leading-relaxed space-y-4">
                            <p>I'm a software engineer with <span class="inline-code">8+</span> years of experience building distributed systems, APIs, and developer tools. Currently based in San Francisco, working on infrastructure tooling that powers millions of requests per day.</p>
                            <p>My journey started with C++ in university, but I quickly fell in love with <span class="inline-code">Go</span> for its simplicity and concurrency model. These days, I split my time between Go for backend services and <span class="inline-code">Rust</span> for performance-critical tools.</p>
                            <p>When I'm not coding, you'll find me contributing to open source, writing technical articles, or tinkering with homelab infrastructure.</p>
                        </div>
                    </div>

                    <!-- Experience -->
                    <div class="bg-surface border border-border rounded-xl p-8">
                        <h3 class="font-mono text-sm text-neonBlue mb-6 flex items-center gap-2">
                            <i data-lucide="briefcase" class="w-4 h-4"></i> Experience
                        </h3>
                        <div class="space-y-6">
                            <div class="relative pl-6 border-l-2 border-neonBlue/30">
                                <div class="absolute -left-[7px] top-1 w-3 h-3 rounded-full bg-neonBlue"></div>
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-1">
                                    <span class="font-medium text-sm">Senior Software Engineer</span>
                                    <span class="font-mono text-xs text-textMuted">2022 — Present</span>
                                </div>
                                <div class="font-mono text-xs text-neonBlue mb-2">CloudScale Inc.</div>
                                <p class="text-textSecondary text-sm leading-relaxed">Leading the platform team building internal distributed systems tooling. Designed and implemented a service mesh handling 50M+ daily requests.</p>
                            </div>
                            <div class="relative pl-6 border-l-2 border-border">
                                <div class="absolute -left-[7px] top-1 w-3 h-3 rounded-full bg-surfaceLight border border-border"></div>
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-1">
                                    <span class="font-medium text-sm">Software Engineer</span>
                                    <span class="font-mono text-xs text-textMuted">2019 — 2022</span>
                                </div>
                                <div class="font-mono text-xs text-textSecondary mb-2">DataPipe Systems</div>
                                <p class="text-textSecondary text-sm leading-relaxed">Built real-time data pipeline infrastructure using Go and Kafka. Reduced processing latency by 60% through architectural redesign.</p>
                            </div>
                            <div class="relative pl-6 border-l-2 border-border">
                                <div class="absolute -left-[7px] top-1 w-3 h-3 rounded-full bg-surfaceLight border border-border"></div>
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-1">
                                    <span class="font-medium text-sm">Junior Developer</span>
                                    <span class="font-mono text-xs text-textMuted">2016 — 2019</span>
                                </div>
                                <div class="font-mono text-xs text-textSecondary mb-2">WebForge Studio</div>
                                <p class="text-textSecondary text-sm leading-relaxed">Full-stack web development with Python/Django and React. Migrated legacy PHP codebase to microservices architecture.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Tech Stack -->
                    <div class="bg-surface border border-border rounded-xl p-8">
                        <h3 class="font-mono text-sm text-neonGreen mb-6 flex items-center gap-2">
                            <i data-lucide="layers" class="w-4 h-4"></i> Tech Stack
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <div class="font-mono text-xs text-textMuted mb-2 uppercase tracking-wider">Languages</div>
                                <div class="flex flex-wrap gap-2">
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-neonBlue border border-border">Go</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-[#FF79C6] border border-border">Rust</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-[#FFD700] border border-border">Python</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-neonGreen border border-border">TypeScript</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">SQL</span>
                                </div>
                            </div>
                            <div>
                                <div class="font-mono text-xs text-textMuted mb-2 uppercase tracking-wider">Frameworks</div>
                                <div class="flex flex-wrap gap-2">
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">Gin</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">Actix</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">FastAPI</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">Next.js</span>
                                </div>
                            </div>
                            <div>
                                <div class="font-mono text-xs text-textMuted mb-2 uppercase tracking-wider">Infrastructure</div>
                                <div class="flex flex-wrap gap-2">
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">Docker</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">K8s</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">Terraform</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">AWS</span>
                                </div>
                            </div>
                            <div>
                                <div class="font-mono text-xs text-textMuted mb-2 uppercase tracking-wider">Databases</div>
                                <div class="flex flex-wrap gap-2">
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">PostgreSQL</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">Redis</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">MongoDB</span>
                                </div>
                            </div>
                            <div>
                                <div class="font-mono text-xs text-textMuted mb-2 uppercase tracking-wider">Tools</div>
                                <div class="flex flex-wrap gap-2">
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">Neovim</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">Tmux</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">Git</span>
                                    <span class="font-mono text-xs px-3 py-1.5 rounded-lg bg-surfaceLight text-textSecondary border border-border">Linux</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="bg-surface border border-border rounded-xl p-8">
                        <h3 class="font-mono text-sm text-neonBlue mb-6 flex items-center gap-2">
                            <i data-lucide="send" class="w-4 h-4"></i> Contact
                        </h3>
                        <div class="space-y-4">
                            <a href="mailto:alex@devlog.io" class="flex items-center gap-3 text-sm text-textSecondary hover:text-neonGreen transition-colors group">
                                <div class="p-2 rounded-lg bg-surfaceLight group-hover:bg-neonGreen/10 transition-colors">
                                    <i data-lucide="mail" class="w-4 h-4"></i>
                                </div>
                                <span class="font-mono text-xs">alex@devlog.io</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 text-sm text-textSecondary hover:text-neonBlue transition-colors group">
                                <div class="p-2 rounded-lg bg-surfaceLight group-hover:bg-neonBlue/10 transition-colors">
                                    <i data-lucide="github" class="w-4 h-4"></i>
                                </div>
                                <span class="font-mono text-xs">github.com/alexchen</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 text-sm text-textSecondary hover:text-neonGreen transition-colors group">
                                <div class="p-2 rounded-lg bg-surfaceLight group-hover:bg-neonGreen/10 transition-colors">
                                    <i data-lucide="twitter" class="w-4 h-4"></i>
                                </div>
                                <span class="font-mono text-xs">@alexchendev</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 text-sm text-textSecondary hover:text-neonBlue transition-colors group">
                                <div class="p-2 rounded-lg bg-surfaceLight group-hover:bg-neonBlue/10 transition-colors">
                                    <i data-lucide="linkedin" class="w-4 h-4"></i>
                                </div>
                                <span class="font-mono text-xs">linkedin.com/in/alexchen</span>
                            </a>
                        </div>

                        <!-- Contact Form -->
                        <div class="mt-6 pt-6 border-t border-border">
                            <div class="font-mono text-xs text-textMuted mb-3">// send a message</div>
                            <form onsubmit="handleContactSubmit(event)" class="space-y-3">
                                <input type="text" placeholder="Your name" required class="w-full bg-surfaceLight border border-border rounded-lg px-4 py-2.5 font-mono text-xs text-textPrimary placeholder-textMuted focus:outline-none focus:border-neonGreen/50 transition-colors">
                                <input type="email" placeholder="Email address" required class="w-full bg-surfaceLight border border-border rounded-lg px-4 py-2.5 font-mono text-xs text-textPrimary placeholder-textMuted focus:outline-none focus:border-neonGreen/50 transition-colors">
                                <textarea placeholder="Your message..." rows="3" required class="w-full bg-surfaceLight border border-border rounded-lg px-4 py-2.5 font-mono text-xs text-textPrimary placeholder-textMuted focus:outline-none focus:border-neonGreen/50 transition-colors resize-none"></textarea>
                                <button type="submit" class="w-full font-mono text-xs font-medium px-4 py-2.5 rounded-lg bg-neonGreen text-bg hover:bg-neonGreenDim transition-colors">
                                    $ send_message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==================== FOOTER ==================== -->
    <footer class="border-t border-border py-12 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="font-mono text-xs text-textMuted">
                    <span class="text-neonGreen">~</span>/dev.log — Built with <span class="text-neonBlue">♥</span> and caffeine
                </div>
                <div class="flex items-center gap-4 font-mono text-xs text-textMuted">
                    <span>© 2024</span>
                    <span class="text-border">|</span>
                    <a href="#" class="hover:text-neonGreen transition-colors">RSS</a>
                    <span class="text-border">|</span>
                    <a href="#" class="hover:text-neonGreen transition-colors">Sitemap</a>
                </div>
            </div>
            <div class="mt-6 text-center font-mono text-xs text-textMuted/50">
                <span class="terminal-prompt">$</span> echo "Code is poetry" <span class="terminal-cursor"></span>
            </div>
        </div>
    </footer>

    <script>
      //
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
                    <div class="code-block my-6">
                        <div class="code-header">
                            <div class="code-dots"><span class="bg-[#FF5F56]"></span><span class="bg-[#FFBD2E]"></span><span class="bg-[#27C93F]"></span></div>
                            <span class="font-mono text-xs text-textMuted">gmp_example.go</span>
                            <button onclick="copyCode(this)" class="font-mono text-xs text-textMuted hover:text-neonGreen transition-colors flex items-center gap-1"><i data-lucide="copy" class="w-3 h-3"></i> Copy</button>
                        </div>
                        <div class="code-content font-mono"><pre><span class="keyword">package</span> <span class="package">main</span>

<span class="keyword">import</span> (
    <span class="string">"context"</span>
    <span class="string">"fmt"</span>
    <span class="string">"sync"</span>
    <span class="string">"time"</span>
)

<span class="comment">// WorkerPool manages a fixed pool of goroutines</span>
<span class="keyword">type</span> <span class="type">WorkerPool</span> <span class="keyword">struct</span> {
    <span class="variable">jobs</span>     <span class="keyword">chan</span> <span class="type">Job</span>
    <span class="variable">results</span>  <span class="keyword">chan</span> <span class="type">Result</span>
    <span class="variable">wg</span>       <span class="type">sync.WaitGroup</span>
    <span class="variable">ctx</span>      <span class="type">context.Context</span>
    <span class="variable">cancel</span>   <span class="type">context.CancelFunc</span>
}

<span class="keyword">func</span> <span class="function">NewWorkerPool</span>(<span class="variable">workers</span> <span class="type">int</span>) <span class="operator">*</span><span class="type">WorkerPool</span> {
    <span class="variable">ctx</span>, <span class="variable">cancel</span> <span class="operator">:=</span> <span class="package">context</span>.<span class="function">WithCancel</span>(<span class="package">context</span>.<span class="function">Background</span>())
    <span class="keyword">return</span> <span class="operator">&</span><span class="type">WorkerPool</span>{
        <span class="variable">jobs</span>:    <span class="keyword">make</span>(<span class="keyword">chan</span> <span class="type">Job</span>, <span class="number">100</span>),
        <span class="variable">results</span>: <span class="keyword">make</span>(<span class="keyword">chan</span> <span class="type">Result</span>, <span class="number">100</span>),
        <span class="variable">ctx</span>:     <span class="variable">ctx</span>,
        <span class="variable">cancel</span>:  <span class="variable">cancel</span>,
    }
}</pre></div>
                    </div>
                    <h3>Channel Patterns</h3>
                    <p>Channels are more than just message passing. They can implement fan-out/fan-in, pipelines, and even state machines. The key is to think of channels as <em>coordination primitives</em>, not just data pipes.</p>
                    <div class="code-block my-6">
                        <div class="code-header">
                            <div class="code-dots"><span class="bg-[#FF5F56]"></span><span class="bg-[#FFBD2E]"></span><span class="bg-[#27C93F]"></span></div>
                            <span class="font-mono text-xs text-textMuted">fan_out.go</span>
                            <button onclick="copyCode(this)" class="font-mono text-xs text-textMuted hover:text-neonGreen transition-colors flex items-center gap-1"><i data-lucide="copy" class="w-3 h-3"></i> Copy</button>
                        </div>
                        <div class="code-content font-mono"><pre><span class="comment">// FanOut distributes work across N workers</span>
<span class="keyword">func</span> <span class="function">FanOut</span>(<span class="variable">ctx</span> <span class="type">context.Context</span>, <span class="variable">input</span> <span class="keyword">chan</span> <span class="type">int</span>, <span class="variable">n</span> <span class="type">int</span>) []<span class="keyword">chan</span> <span class="type">int</span> {
    <span class="variable">outputs</span> <span class="operator">:=</span> <span class="keyword">make</span>([]<span class="keyword">chan</span> <span class="type">int</span>, <span class="variable">n</span>)
    <span class="keyword">for</span> <span class="variable">i</span> <span class="operator">:=</span> <span class="number">0</span>; <span class="variable">i</span> <span class="operator">&lt;</span> <span class="variable">n</span>; <span class="variable">i</span><span class="operator">++</span> {
        <span class="variable">outputs</span>[<span class="variable">i</span>] = <span class="keyword">make</span>(<span class="keyword">chan</span> <span class="type">int</span>)
        <span class="keyword">go</span> <span class="keyword">func</span>(<span class="variable">out</span> <span class="keyword">chan</span><span class="operator">&lt;-</span> <span class="type">int</span>) {
            <span class="keyword">defer</span> <span class="function">close</span>(<span class="variable">out</span>)
            <span class="keyword">for</span> {
                <span class="keyword">select</span> {
                <span class="keyword">case</span> <span class="operator">&lt;-</span><span class="variable">ctx</span>.<span class="function">Done</span>():
                    <span class="keyword">return</span>
                <span class="keyword">case</span> <span class="variable">val</span>, <span class="variable">ok</span> <span class="operator">:=</span> <span class="operator">&lt;-</span><span class="variable">input</span>:
                    <span class="keyword">if</span> !<span class="variable">ok</span> { <span class="keyword">return</span> }
                    <span class="variable">out</span> <span class="operator">&lt;-</span> <span class="function">process</span>(<span class="variable">val</span>)
                }
            }
        }(<span class="variable">outputs</span>[<span class="variable">i</span>])
    }
    <span class="keyword">return</span> <span class="variable">outputs</span>
}</pre></div>
                    </div>
                    <p>The combination of <span class="inline-code">context.Context</span> for cancellation and channels for coordination gives you fine-grained control over concurrent operations that's hard to achieve with raw goroutines alone.</p>
                `,
    },
    {
        title: "Rust Lifetimes Demystified: A Practical Guide",
        date: "2024-12-08",
        readTime: "12 min read",
        tags: ["rust"],
        content: `
                    <p>Lifetimes are Rust's way of ensuring that references are always valid. They don't change how your code runs — they're purely compile-time checks. Let's break them down with real examples.</p>
                    <h3>What Are Lifetimes?</h3>
                    <p>Every reference in Rust has a lifetime — the scope for which that reference is valid. Most of the time, the compiler can infer lifetimes automatically (lifetime elision). But when it can't, you need to annotate them explicitly.</p>
                    <div class="code-block my-6">
                        <div class="code-header">
                            <div class="code-dots"><span class="bg-[#FF5F56]"></span><span class="bg-[#FFBD2E]"></span><span class="bg-[#27C93F]"></span></div>
                            <span class="font-mono text-xs text-textMuted">lifetimes.rs</span>
                            <button onclick="copyCode(this)" class="font-mono text-xs text-textMuted hover:text-neonGreen transition-colors flex items-center gap-1"><i data-lucide="copy" class="w-3 h-3"></i> Copy</button>
                        </div>
                        <div class="code-content font-mono"><pre><span class="comment">// 'a is a lifetime parameter — it tells the compiler</span>
<span class="comment">// that the returned reference lives as long as the shorter</span>
<span class="comment">// of the two input references</span>
<span class="keyword">fn</span> <span class="function">longest</span>&lt;<span class="type">'a</span>&gt;(<span class="variable">x</span>: <span class="operator">&amp;</span><span class="type">'a</span> <span class="type">str</span>, <span class="variable">y</span>: <span class="operator">&amp;</span><span class="type">'a</span> <span class="type">str</span>) <span class="operator">-&gt;</span> <span class="operator">&amp;</span><span class="type">'a</span> <span class="type">str</span> {
    <span class="keyword">if</span> <span class="variable">x</span>.<span class="function">len</span>() <span class="operator">&gt;</span> <span class="variable">y</span>.<span class="function">len</span>() { <span class="variable">x</span> } <span class="keyword">else</span> { <span class="variable">y</span> }
}

<span class="comment">// Struct with a reference — needs explicit lifetime</span>
<span class="keyword">struct</span> <span class="type">Excerpt</span>&lt;<span class="type">'a</span>&gt; {
    <span class="variable">part</span>: <span class="operator">&amp;</span><span class="type">'a</span> <span class="type">str</span>,
}

<span class="keyword">impl</span>&lt;<span class="type">'a</span>&gt; <span class="type">Excerpt</span>&lt;<span class="type">'a</span>&gt; {
    <span class="keyword">fn</span> <span class="function">level</span>(&<span class="keyword">self</span>) <span class="operator">-&gt;</span> <span class="type">i32</span> {
        <span class="number">3</span>
    }
}</pre></div>
                    </div>
                    <h3>Common Patterns</h3>
                    <p>The <span class="inline-code">'static</span> lifetime means the reference lives for the entire program duration. String literals have this lifetime. But be careful — reaching for <span class="inline-code">'static</span> too often is a code smell.</p>
                    <p>Instead, learn to use bounded lifetimes with generics. The pattern of <span class="inline-code">&'a T</span> where <span class="inline-code">T: 'a</span> ensures type parameters don't outlive the reference.</p>
                `,
    },
    {
        title: "Async Python for High-Throughput APIs",
        date: "2024-11-29",
        readTime: "10 min read",
        tags: ["python", "devops"],
        content: `
                    <p>Python's async/await syntax has matured significantly. With FastAPI and proper async patterns, you can handle thousands of concurrent connections on a single server.</p>
                    <div class="code-block my-6">
                        <div class="code-header">
                            <div class="code-dots"><span class="bg-[#FF5F56]"></span><span class="bg-[#FFBD2E]"></span><span class="bg-[#27C93F]"></span></div>
                            <span class="font-mono text-xs text-textMuted">main.py</span>
                            <button onclick="copyCode(this)" class="font-mono text-xs text-textMuted hover:text-neonGreen transition-colors flex items-center gap-1"><i data-lucide="copy" class="w-3 h-3"></i> Copy</button>
                        </div>
                        <div class="code-content font-mono"><pre><span class="keyword">from</span> <span class="package">fastapi</span> <span class="keyword">import</span> <span class="type">FastAPI</span>, <span class="type">HTTPException</span>
<span class="keyword">from</span> <span class="package">contextlib</span> <span class="keyword">import</span> <span class="function">asynccontextmanager</span>
<span class="keyword">import</span> <span class="package">asyncpg</span>

<span class="decorator">@asynccontextmanager</span>
<span class="keyword">async</span> <span class="keyword">def</span> <span class="function">lifespan</span>(<span class="variable">app</span>: <span class="type">FastAPI</span>):
    <span class="comment"># Startup: create connection pool</span>
    <span class="variable">app</span>.<span class="variable">state</span>.<span class="variable">pool</span> = <span class="keyword">await</span> <span class="package">asyncpg</span>.<span class="function">create_pool</span>(
        <span class="variable">dsn</span>=<span class="string">"postgresql://..."</span>,
        <span class="variable">min_size</span>=<span class="number">5</span>,
        <span class="variable">max_size</span>=<span class="number">20</span>,
    )
    <span class="keyword">yield</span>
    <span class="comment"># Shutdown: close pool</span>
    <span class="keyword">await</span> <span class="variable">app</span>.<span class="variable">state</span>.<span class="variable">pool</span>.<span class="function">close</span>()

<span class="variable">app</span> = <span class="type">FastAPI</span>(<span class="variable">lifespan</span>=<span class="function">lifespan</span>)

<span class="decorator">@app.get</span>(<span class="string">"/users/{user_id}"</span>)
<span class="keyword">async</span> <span class="keyword">def</span> <span class="function">get_user</span>(<span class="variable">user_id</span>: <span class="type">int</span>):
    <span class="keyword">async with</span> <span class="variable">app</span>.<span class="variable">state</span>.<span class="variable">pool</span>.<span class="function">acquire</span>() <span class="keyword">as</span> <span class="variable">conn</span>:
        <span class="variable">row</span> = <span class="keyword">await</span> <span class="variable">conn</span>.<span class="function">fetchrow</span>(
            <span class="string">"SELECT * FROM users WHERE id = $1"</span>, <span class="variable">user_id</span>
        )
    <span class="keyword">if</span> <span class="keyword">not</span> <span class="variable">row</span>:
        <span class="keyword">raise</span> <span class="type">HTTPException</span>(<span class="variable">status_code</span>=<span class="number">404</span>)
    <span class="keyword">return</span> <span class="keyword">dict</span>(<span class="variable">row</span>)</pre></div>
                    </div>
                    <p>The key insight: async Python shines when your workload is I/O bound. For CPU-bound tasks, you still need <span class="inline-code">ProcessPoolExecutor</span> to avoid blocking the event loop.</p>
                `,
    },
    {
        title: "Go + PostgreSQL: Connection Pooling Done Right",
        date: "2024-11-20",
        readTime: "15 min read",
        tags: ["golang", "database"],
        content: `
                    <p>Database connection pooling in Go seems simple — until you're handling 10k QPS and things start falling apart. Here's what I've learned from running PostgreSQL at scale.</p>
                    <div class="code-block my-6">
                        <div class="code-header">
                            <div class="code-dots"><span class="bg-[#FF5F56]"></span><span class="bg-[#FFBD2E]"></span><span class="bg-[#27C93F]"></span></div>
                            <span class="font-mono text-xs text-textMuted">db_pool.go</span>
                            <button onclick="copyCode(this)" class="font-mono text-xs text-textMuted hover:text-neonGreen transition-colors flex items-center gap-1"><i data-lucide="copy" class="w-3 h-3"></i> Copy</button>
                        </div>
                        <div class="code-content font-mono"><pre><span class="keyword">package</span> <span class="package">db</span>

<span class="keyword">import</span> (
    <span class="string">"database/sql"</span>
    <span class="string">"fmt"</span>
    <span class="string">"time"</span>
    <span class="package">_</span> <span class="string">"github.com/lib/pq"</span>
)

<span class="keyword">type</span> <span class="type">Config</span> <span class="keyword">struct</span> {
    <span class="variable">Host</span>     <span class="type">string</span>
    <span class="variable">Port</span>     <span class="type">int</span>
    <span class="variable">User</span>     <span class="type">string</span>
    <span class="variable">Password</span> <span class="type">string</span>
    <span class="variable">DBName</span>   <span class="type">string</span>
    <span class="variable">MaxOpen</span>  <span class="type">int</span>
    <span class="variable">MaxIdle</span>  <span class="type">int</span>
    <span class="variable">MaxLife</span>  <span class="type">time.Duration</span>
}

<span class="keyword">func</span> <span class="function">NewPool</span>(<span class="variable">cfg</span> <span class="type">Config</span>) (<span class="operator">*</span><span class="type">sql.DB</span>, <span class="type">error</span>) {
    <span class="variable">dsn</span> <span class="operator">:=</span> <span class="package">fmt</span>.<span class="function">Sprintf</span>(
        <span class="string">"host=%s port=%d user=%s password=%s dbname=%s sslmode=disable"</span>,
        <span class="variable">cfg</span>.<span class="variable">Host</span>, <span class="variable">cfg</span>.<span class="variable">Port</span>, <span class="variable">cfg</span>.<span class="variable">User</span>, <span class="variable">cfg</span>.<span class="variable">Password</span>, <span class="variable">cfg</span>.<span class="variable">DBName</span>,
    )
    <span class="variable">db</span>, <span class="variable">err</span> <span class="operator">:=</span> <span class="package">sql</span>.<span class="function">Open</span>(<span class="string">"postgres"</span>, <span class="variable">dsn</span>)
    <span class="keyword">if</span> <span class="variable">err</span> <span class="operator">!=</span> <span class="keyword">nil</span> {
        <span class="keyword">return</span> <span class="keyword">nil</span>, <span class="variable">err</span>
    }
    <span class="variable">db</span>.<span class="function">SetMaxOpenConns</span>(<span class="variable">cfg</span>.<span class="variable">MaxOpen</span>)
    <span class="variable">db</span>.<span class="function">SetMaxIdleConns</span>(<span class="variable">cfg</span>.<span class="variable">MaxIdle</span>)
    <span class="variable">db</span>.<span class="function">SetConnMaxLifetime</span>(<span class="variable">cfg</span>.<span class="variable">MaxLife</span>)
    <span class="keyword">return</span> <span class="variable">db</span>, <span class="keyword">nil</span>
}</pre></div>
                    </div>
                    <p>The golden rule: <span class="inline-code">MaxOpen</span> should be roughly <span class="inline-code">(CPU cores × 2) + effective_spindle_count</span>. For cloud databases, start with 25 and tune from there.</p>
                `,
    },
    {
        title: "TypeScript Edge Runtime: Beyond Node.js",
        date: "2024-11-12",
        readTime: "7 min read",
        tags: ["javascript"],
        content: `
                    <p>The JavaScript runtime landscape has exploded. Deno, Bun, and Cloudflare Workers each bring unique strengths. Let's compare them honestly.</p>
                    <div class="code-block my-6">
                        <div class="code-header">
                            <div class="code-dots"><span class="bg-[#FF5F56]"></span><span class="bg-[#FFBD2E]"></span><span class="bg-[#27C93F]"></span></div>
                            <span class="font-mono text-xs text-textMuted">benchmark.ts</span>
                            <button onclick="copyCode(this)" class="font-mono text-xs text-textMuted hover:text-neonGreen transition-colors flex items-center gap-1"><i data-lucide="copy" class="w-3 h-3"></i> Copy</button>
                        </div>
                        <div class="code-content font-mono"><pre><span class="comment">// Simple HTTP server comparison</span>

<span class="comment">// Deno — built-in TypeScript, secure by default</span>
<span class="variable">Deno</span>.<span class="function">serve</span>({ <span class="variable">port</span>: <span class="number">8000</span> }, (<span class="variable">req</span>) <span class="operator">=></span> {
  <span class="keyword">return</span> <span class="keyword">new</span> <span class="type">Response</span>(<span class="string">"Hello from Deno!"</span>, {
    <span class="variable">headers</span>: { <span class="string">"content-type"</span>: <span class="string">"text/plain"</span> },
  });
});

<span class="comment">// Bun — fastest startup, Node compatibility</span>
<span class="variable">Bun</span>.<span class="function">serve</span>({
  <span class="variable">port</span>: <span class="number">8001</span>,
  <span class="function">fetch</span>(<span class="variable">req</span>) {
    <span class="keyword">return</span> <span class="keyword">new</span> <span class="type">Response</span>(<span class="string">"Hello from Bun!"</span>);
  },
});</pre></div>
                    </div>
                    <p>My recommendation: Use <strong>Deno</strong> for new projects that value security and simplicity. Use <strong>Bun</strong> when you need maximum performance and Node.js compatibility. Use <strong>Cloudflare Workers</strong> for edge-deployed, low-latency APIs.</p>
                `,
    },
    {
        title: "Building CLI Tools in Rust: From Zero to Published",
        date: "2024-11-05",
        readTime: "9 min read",
        tags: ["rust", "devops"],
        content: `
                    <p>Rust is an excellent choice for CLI tools — fast startup, single binary output, and incredible ecosystem with <span class="inline-code">clap</span> for argument parsing and <span class="inline-code">tokio</span> for async.</p>
                    <div class="code-block my-6">
                        <div class="code-header">
                            <div class="code-dots"><span class="bg-[#FF5F56]"></span><span class="bg-[#FFBD2E]"></span><span class="bg-[#27C93F]"></span></div>
                            <span class="font-mono text-xs text-textMuted">main.rs</span>
                            <button onclick="copyCode(this)" class="font-mono text-xs text-textMuted hover:text-neonGreen transition-colors flex items-center gap-1"><i data-lucide="copy" class="w-3 h-3"></i> Copy</button>
                        </div>
                        <div class="code-content font-mono"><pre><span class="keyword">use</span> <span class="package">clap</span>::{<span class="type">Parser</span>, <span class="type">Subcommand</span>};

<span class="decorator">#[derive(Parser)]</span>
<span class="decorator">#[command(name = "forge")]</span>
<span class="decorator">#[command(about = "A fast project scaffolding tool")]</span>
<span class="keyword">struct</span> <span class="type">Cli</span> {
    <span class="decorator">#[command(subcommand)]</span>
    <span class="variable">command</span>: <span class="type">Commands</span>,
}

<span class="decorator">#[derive(Subcommand)]</span>
<span class="keyword">enum</span> <span class="type">Commands</span> {
    <span class="comment">/// Create a new project</span>
    <span class="function">New</span> {
        <span class="variable">name</span>: <span class="type">String</span>,
        <span class="decorator">#[arg(short, long, default_value = "rust")]</span>
        <span class="variable">template</span>: <span class="type">String</span>,
    },
    <span class="comment">/// List available templates</span>
    <span class="function">List</span>,
}

<span class="decorator">#[tokio::main]</span>
<span class="keyword">async fn</span> <span class="function">main</span>() <span class="operator">-></span> <span class="type">Result</span>&lt;(), <span class="type">Box</span>&lt;<span class="keyword">dyn</span> <span class="type">std::error::Error</span>&gt;&gt; {
    <span class="keyword">let</span> <span class="variable">cli</span> = <span class="type">Cli</span>::<span class="function">parse</span>();
    <span class="keyword">match</span> <span class="variable">cli</span>.<span class="variable">command</span> {
        <span class="type">Commands</span>::<span class="function">New</span> { <span class="variable">name</span>, <span class="variable">template</span> } <span class="operator">=></span> {
            <span class="function">create_project</span>(<span class="operator">&</span><span class="variable">name</span>, <span class="operator">&</span><span class="variable">template</span>).<span class="keyword">await</span>?;
        }
        <span class="type">Commands</span>::<span class="function">List</span> <span class="operator">=></span> {
            <span class="function">list_templates</span>().<span class="keyword">await</span>?;
        }
    }
    <span class="type">Ok</span>(())
}</pre></div>
                    </div>
                    <p>With <span class="inline-code">cargo install</span>, your users get a native binary with zero runtime dependencies. Cross-compilation with <span class="inline-code">cross</span> makes distributing to multiple platforms trivial.</p>
                `,
    },
];

// ==================== SECTION NAVIGATION ====================
function showSection(name) {
    // Hide all sections
    document.querySelectorAll('[id^="section-"]').forEach((s) => {
        s.classList.remove("section-visible");
        s.classList.add("section-hidden");
    });

    // Show target section
    const target = document.getElementById("section-" + name);
    if (target) {
        target.classList.remove("section-hidden");
        target.classList.add("section-visible");
    }

    // Update nav links
    document.querySelectorAll(".nav-link").forEach((l) => {
        l.classList.remove("active");
        if (l.dataset.section === name) l.classList.add("active");
    });

    // Scroll to top
    window.scrollTo({ top: 0, behavior: "smooth" });

    // Re-init lucide icons for new content
    setTimeout(() => lucide.createIcons(), 50);
}

// ==================== ARTICLE DETAIL ====================
function showArticle(index) {
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
}

// ==================== TAG FILTERING ====================
function filterArticles(tag) {
    // Update button styles
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

    // Filter articles
    document.querySelectorAll(".article-card").forEach((card) => {
        const cardTags = card.dataset.tags.split(",");
        if (tag === "all" || cardTags.includes(tag)) {
            card.style.display = "block";
            card.style.animation = "fadeIn 0.3s ease";
        } else {
            card.style.display = "none";
        }
    });
}

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
function toggleMobileMenu() {
    const menu = document.getElementById("mobileMenu");
    const overlay = document.getElementById("mobileOverlay");
    menu.classList.toggle("open");
    overlay.classList.toggle("hidden");
}

// ==================== THEME ACCENT TOGGLE ====================
let accentMode = 0;
function toggleThemeAccent() {
    accentMode = (accentMode + 1) % 3;
    const root = document.documentElement.style;
    if (accentMode === 0) {
        // Default: green + blue
        root.setProperty("--neon-primary", "#00FF00");
        root.setProperty("--neon-secondary", "#00D7FF");
        showToast("🎨 Theme: Terminal Green");
    } else if (accentMode === 1) {
        // Cyberpunk: pink + cyan
        root.setProperty("--neon-primary", "#FF79C6");
        root.setProperty("--neon-secondary", "#8BE9FD");
        showToast("🎨 Theme: Cyberpunk Pink");
    } else {
        // Warm: amber + orange
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

    </script>
</body>
</html>