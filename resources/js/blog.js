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
                    <p>Go's concurrency models is one of the language's most powerful features, but many developers stop at <span class="inline-code">go func()</span> and miss the deeper patterns that make concurrent Go programs truly robust.</p>
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
window.showSection = function (name) {
    console.log("Menjalankan showSection untuk:", name);

    // 1. Jalankan pemindahan class active pada Navigasi dulu (Diprioritaskan)
    const navLinks = document.querySelectorAll(".nav-link");
    if (navLinks.length > 0) {
        navLinks.forEach((link) => {
            const sectionAttr = link.getAttribute("data-section");
            if (sectionAttr === name) {
                link.classList.add("active");
                console.log(`Slider berpindah ke: ${name}`);
            } else {
                link.classList.remove("active");
            }
        });
    } else {
        console.warn(
            "Peringatan: Elemen dengan class '.nav-link' tidak ditemukan!",
        );
    }

    // 2. Jalankan perpindahan section konten dengan aman
    try {
        document.querySelectorAll('[id^="section-"]').forEach((s) => {
            s.classList.remove("section-visible");
            s.classList.add("section-hidden");
        });

        const target = document.getElementById("section-" + name);
        if (target) {
            target.classList.remove("section-hidden");
            target.classList.add("section-visible");
        } else {
            console.warn(
                `Peringatan: Element ID 'section-${name}' tidak ditemukan di HTML.`,
            );
        }
    } catch (error) {
        console.error("Terjadi error saat mengubah section konten:", error);
    }
};

// ==================== ARTICLE DETAIL ====================
window.showArticle = function (index) {
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
});
