<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'dev.log — A Programmer\'s Blog')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

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

    @vite(['resources/css/blog.css', 'resources/js/blog.js'])

    @stack('styles')
</head>
<body class="grid-bg">

    {{-- Reading Progress Bar --}}
    <div class="reading-progress" id="readingProgress" style="width: 0%;"></div>

    {{-- Toast Notification --}}
    <div class="toast" id="toast"></div>

    {{-- Navigation --}}
    @include('partials.navbar')

    {{-- Mobile Menu --}}
    @include('partials.mobile-menu')

    {{-- Main Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('partials.footer')

    {{-- <script src="{{ asset('js/blog.js') }}"></script> --}}
    @stack('scripts')
</body>
</html>
