{{-- ==================== ABOUT SECTION ==================== --}}
<section id="section-about" class="section-hidden pt-24 pb-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-12">
            <div class="font-mono text-xs text-neonGreen mb-2 tracking-widest uppercase">About</div>
            <h2 class="text-3xl md:text-4xl font-bold tracking-tight mb-2">About Me</h2>
            <p class="text-textSecondary font-mono text-sm">Developer. Builder. Lifelong learner.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Bio --}}
                <div class="bg-surface border border-border rounded-xl p-8">
                    <h3 class="font-mono text-sm text-neonGreen mb-4 flex items-center gap-2">
                        <i data-lucide="user" class="w-4 h-4"></i> Who I Am
                    </h3>
                    <div class="text-textSecondary text-sm leading-relaxed space-y-4">
                        <p>I'm a software engineer with <span class="inline-code">8+</span> years of experience building distributed systems, APIs, and developer tools.</p>
                        <p>My journey started with C++ in university, but I quickly fell in love with <span class="inline-code">Go</span> for its simplicity and concurrency model. These days, I split my time between Go for backend services and <span class="inline-code">Rust</span> for performance-critical tools.</p>
                        <p>When I'm not coding, you'll find me contributing to open source, writing technical articles, or tinkering with homelab infrastructure.</p>
                    </div>
                </div>

                {{-- Experience --}}
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

            {{-- Right Column --}}
            <div class="space-y-8">

                {{-- Tech Stack --}}
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
                    </div>
                </div>

                {{-- Contact --}}
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

                    {{-- Contact Form --}}
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
