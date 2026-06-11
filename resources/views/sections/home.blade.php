{{-- ==================== HOME SECTION ==================== --}}
<section id="section-home" class="section-visible pt-16">
    {{-- Hero --}}
    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="max-w-4xl w-full">
            <div class="flex flex-col md:flex-row items-center gap-12">
                {{-- Avatar --}}
                <div class="relative flex-shrink-0">
                    <div class="w-40 h-40 rounded-2xl overflow-hidden border-2 border-neonGreen/30 border-glow-green">
                        <img src="https://icehousecorp.com/wp-content/uploads/2022/04/go-768x525.png" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-2 -right-2 bg-neonGreen text-bg font-mono text-xs font-bold px-2 py-1 rounded-md">
                        ONLINE
                    </div>
                </div>

                {{-- Intro --}}
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

                    {{-- Terminal Status --}}
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

                    {{-- Social Links --}}
                    <div class="flex items-center gap-3 justify-center md:justify-start">
                        <a href="#" class="p-3 rounded-xl bg-surface border border-border hover:border-neonGreen/30 hover:text-neonGreen text-textSecondary transition-all" title="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="p-3 rounded-xl bg-surface border border-border hover:border-neonBlue/30 hover:text-neonBlue text-textSecondary transition-all" title="Twitter/X">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                        <a href="#" class="p-3 rounded-xl bg-surface border border-border hover:border-neonGreen/30 hover:text-neonGreen text-textSecondary transition-all" title="LinkedIn">
                            <i class="fab fa-linkedin"></i>
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

            {{-- Scroll Indicator --}}
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-textMuted">
                <span class="font-mono text-xs">scroll</span>
                <div class="w-px h-8 bg-gradient-to-b from-textMuted to-transparent animate-pulse"></div>
            </div>
        </div>
    </div>

    {{-- Latest Code Snippet --}}
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
