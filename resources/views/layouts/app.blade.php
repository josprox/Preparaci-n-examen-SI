<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'NeuroSmart Trainer' }}</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..900;1,400..900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Tailwind & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --m3-primary: #6750A4;
                --m3-on-primary: #FFFFFF;
                --m3-primary-container: #EADDFF;
                --m3-on-primary-container: #21005D;
                --m3-surface: #FEF7FF;
                --m3-on-surface: #1D1B20;
                --m3-surface-variant: #E7E0EC;
                --m3-on-surface-variant: #49454F;
                --m3-outline: #79747E;
                --m3-background: #FEF7FF;
                --m3-on-background: #1D1B20;

                /* Pedagogic Color Tokens */
                --color-input-x: #0284c7; /* Azul */
                --color-weight-w: #7c3aed; /* Morado */
                --color-bias-b: #ea580c; /* Naranja */
                --color-output-y: #16a34a; /* Verde */
                --color-output-calc: #06b6d4; /* Cian */
                --color-error-err: #dc2626; /* Rojo */
                --color-delta-del: #db2777; /* Rosa */
                --color-update-upd: #eab308; /* Amarillo */
                --color-zero: #6b7280; /* Gris */
            }

            .dark {
                --m3-primary: #D0BCFF;
                --m3-on-primary: #381E72;
                --m3-primary-container: #4F378B;
                --m3-on-primary-container: #EADDFF;
                --m3-surface: #141218;
                --m3-on-surface: #E6E1E5;
                --m3-surface-variant: #49454F;
                --m3-on-surface-variant: #CAC4D0;
                --m3-outline: #938F99;
                --m3-background: #141218;
                --m3-on-background: #E6E1E5;
            }

            body {
                font-family: 'Instrument Sans', sans-serif;
                background-color: var(--m3-background);
                color: var(--m3-on-background);
                transition: background-color 0.3s, color 0.3s;
            }

            .font-outfit {
                font-family: 'Outfit', sans-serif;
            }

            /* Pedagogical Badges */
            .badge-input { background-color: var(--color-input-x); color: white; }
            .badge-weight { background-color: var(--color-weight-w); color: white; }
            .badge-bias { background-color: var(--color-bias-b); color: white; }
            .badge-output { background-color: var(--color-output-y); color: white; }
            .badge-output-calc { background-color: var(--color-output-calc); color: white; }
            .badge-error { background-color: var(--color-error-err); color: white; }
            .badge-delta { background-color: var(--color-delta-del); color: white; }
            .badge-update { background-color: var(--color-update-upd); color: #1c1917; }
            .badge-zero { background-color: var(--color-zero); color: white; }

            /* Print Styles for Exam Mode */
            @media print {
                body {
                    background: white !important;
                    color: black !important;
                    font-size: 12pt;
                }
                .no-print {
                    display: none !important;
                }
                .print-container {
                    width: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    box-shadow: none !important;
                    border: none !important;
                }
                .page-break {
                    page-break-after: always;
                }
                h1, h2, h3 {
                    page-break-after: avoid;
                }
                table, img, svg {
                    page-break-inside: avoid;
                }
            }
        </style>
        <script>
            // Theme initial check
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
        <!-- KaTeX Math Renderer -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body, {delimiters: [{left: '$$', right: '$$', display: true}, {left: '$', right: '$', display: false}, {left: '\\(', right: '\\)', display: false}, {left: '\\[', right: '\\]', display: true}]});"></script>
    </head>
    <body class="h-full flex flex-col">

        <!-- Top App Bar -->
        <header class="no-print bg-[var(--m3-surface)] border-b border-gray-200 dark:border-gray-800 px-4 py-3 flex items-center justify-between sticky top-0 z-50">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-xl font-bold font-outfit text-[var(--m3-primary)]">
                    <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                        <path d="M12 3c-4.97 0-9 4.03-9 9 0 2.12.74 4.07 1.97 5.61L4.35 19.4c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l1.9-1.9C9.07 19.58 10.48 20 12 20c4.97 0 9-4.03 9-9s-4.03-9-9-9zm0 15c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm-1-8h2v5h-2zm0-3h2v2h-2z"/>
                    </svg>
                    <span class="text-base sm:text-lg md:text-xl">NeuroSmart Trainer</span>
                </a>
            </div>

            <div class="flex items-center gap-2 sm:gap-4">
                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex items-center gap-4">
                    <a href="{{ route('guide.index') }}" class="text-sm font-semibold hover:text-[var(--m3-primary)] text-gray-600 dark:text-gray-300 font-outfit">
                        Guía
                    </a>
                    <a href="{{ route('media.index') }}" class="text-sm font-semibold hover:text-[var(--m3-primary)] text-gray-600 dark:text-gray-300 font-outfit">
                        Multimedia
                    </a>
                    <a href="{{ route('history.index') }}" class="text-sm font-semibold hover:text-[var(--m3-primary)] text-gray-600 dark:text-gray-300 font-outfit">
                        Historial
                    </a>
                </nav>

                <!-- Dark Mode Toggle -->
                <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none rounded-full p-2">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464a1 1 0 10-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>

                <!-- Mobile Menu Button (Hamburger) -->
                <button id="mobile-menu-button" type="button" class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none rounded-full p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </header>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden bg-[var(--m3-surface)] border-b border-gray-200 dark:border-gray-800 px-4 py-3 flex flex-col gap-3 transition-all duration-300">
            <a href="{{ route('guide.index') }}" class="text-sm font-semibold hover:text-[var(--m3-primary)] text-gray-600 dark:text-gray-300 font-outfit py-1.5 border-b border-gray-100 dark:border-gray-850">
                Guía de Estudio
            </a>
            <a href="{{ route('media.index') }}" class="text-sm font-semibold hover:text-[var(--m3-primary)] text-gray-600 dark:text-gray-300 font-outfit py-1.5 border-b border-gray-100 dark:border-gray-850">
                Multimedia
            </a>
            <a href="{{ route('history.index') }}" class="text-sm font-semibold hover:text-[var(--m3-primary)] text-gray-600 dark:text-gray-300 font-outfit py-1.5">
                Historial
            </a>
        </div>

        <!-- Main Wrapper -->
        <main class="flex-1 overflow-auto p-4 md:p-6 max-w-7xl w-full mx-auto print-container">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="no-print bg-[var(--m3-surface)] border-t border-gray-200 dark:border-gray-800 text-center py-4 text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} NeuroSmart Trainer &middot; Diseñado para Sistemas Inteligentes y Redes Neuronales.</p>
        </footer>

        <!-- Native Bottom Navigation Fallback (for mobile builds) -->
        <div class="no-print">
            <native:bottom-nav>
                <native:bottom-nav-item id="home" icon="home" label="Inicio" url="/" :active="request()->is('/')" />
                <native:bottom-nav-item id="guide" icon="book-open" label="Guía" url="/guide" :active="request()->is('guide*')" />
                <native:bottom-nav-item id="media" icon="video" label="Multimedia" url="/media" :active="request()->is('media*')" />
                <native:bottom-nav-item id="history" icon="history" label="Historial" url="/history" :active="request()->is('history*')" />
            </native:bottom-nav>
        </div>

        <script>
            // Theme toggle script
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

            if (document.documentElement.classList.contains('dark')) {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }

            var themeToggleBtn = document.getElementById('theme-toggle');

            themeToggleBtn.addEventListener('click', function() {
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');

                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
            });

            // Mobile menu toggle script
            var mobileMenuBtn = document.getElementById('mobile-menu-button');
            var mobileMenu = document.getElementById('mobile-menu');

            // Ocultar botón de menú hamburguesa si corre dentro de la app nativa (Capacitor/Android)
            if (window.Capacitor || window.webkit?.messageHandlers?.cordova) {
                if (mobileMenuBtn) {
                    mobileMenuBtn.style.setProperty('display', 'none', 'important');
                }
            }

            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        </script>
    </body>
</html>
