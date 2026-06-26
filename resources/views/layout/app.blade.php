<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'dev.log — A Programmer\'s Blog')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.469.0/umd/lucide.min.js"></script>
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
<body class="grid-bg flex flex-col min-h-screen">

    {{-- PROGRESS BAR --}}
    <div class="reading-progress" id="readingProgress"></div>

    {{-- TOAST --}}
    <div class="toast" id="toast"></div>

    {{-- NAVBAR (WAJIB Z-INDEX) --}}
    @include('partials.navbar')

    {{-- MAIN CONTENT --}}
    <main class="flex-1 relative">
        @yield('content')
    </main>

    {{-- FOOTER (HARUS DI LUAR SECTION) --}}
    @include('partials.footer')

    @stack('scripts')
<script type="module" src="{{ asset('js/blog.js') }}" defer></script>
</body>
</html>