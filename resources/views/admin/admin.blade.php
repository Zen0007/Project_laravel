
<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel — dev.log')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        bg: '#0d0e12',
                        surface: '#16171d',
                        surfaceLight: '#1e2029',
                        neonGreen: '#00ff66',
                        textPrimary: '#ffffff',
                        textSecondary: '#a0aec0',
                        textMuted: '#64748b',
                        border: '#2d3748',
                    },
                    fontFamily: {
                        mono: ['Fira Code', 'monospace'],
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
        }

        .glass-navbar {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .page-enter {
            animation: pageFade .35s ease-out;
        }

        @keyframes pageFade {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .nav-link {
            position: relative;
            padding: .5rem 0;
            transition:
                color .25s ease,
                opacity .25s ease;
        }

        .nav-link:hover {
            opacity: .95;
        }

        #navIndicator {
            width: 0;
            will-change: transform, width;

            transition:
                transform 500ms cubic-bezier(0.22, 1, 0.36, 1),
                width 500ms cubic-bezier(0.22, 1, 0.36, 1);
        }
    </style>

    @stack('styles')
</head>

<body
    class="
        bg-bg
        text-textPrimary
        font-sans
        antialiased
        selection:bg-neonGreen/20
        selection:text-neonGreen
    "
>

    {{-- Navbar --}}
    @include('admin.navbar')


    {{-- Main Content --}}
    <main class="relative min-h-screen pt-20 page-enter">
        @yield('content')
    </main>

    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            if (typeof lucide !== "undefined") {
                lucide.createIcons();
            }

            const indicator = document.getElementById("navIndicator");
            const nav = document.getElementById("desktopNav");

            if (indicator && nav) {

                function moveIndicator(target) {

                    const navRect = nav.getBoundingClientRect();
                    const targetRect = target.getBoundingClientRect();

                    indicator.style.width =
                        `${targetRect.width}px`;

                    indicator.style.transform =
                        `translateX(${targetRect.left - navRect.left}px)`;
                }

                const active =
                    nav.querySelector(".nav-link.active");

                if (active) {
                    moveIndicator(active);
                }

                nav.querySelectorAll(".nav-link")
                    .forEach(link => {

                        link.addEventListener(
                            "mouseenter",
                            () => moveIndicator(link)
                        );

                    });

                nav.addEventListener(
                    "mouseleave",
                    () => {
                        if (active) {
                            moveIndicator(active);
                        }
                    }
                );

                window.addEventListener(
                    "resize",
                    () => {
                        if (active) {
                            moveIndicator(active);
                        }
                    }
                );
            }
        });

        window.addEventListener("scroll", () => {

            const navbar =
                document.querySelector("nav");

            if (!navbar) return;

            if (window.scrollY > 20) {

                navbar.classList.add(
                    "shadow-lg",
                    "shadow-black/20"
                );

            } else {

                navbar.classList.remove(
                    "shadow-lg",
                    "shadow-black/20"
                );
            }
        });

        window.toggleMobileMenu = function () {

            const menu =
                document.getElementById("mobileMenu");

            if (!menu) return;

            if (menu.classList.contains("max-h-0")) {

                menu.classList.remove("max-h-0");
                menu.classList.add("max-h-96");

            } else {

                menu.classList.remove("max-h-96");
                menu.classList.add("max-h-0");
            }
        };
    </script>

    @stack('scripts')
</body>
</html>

