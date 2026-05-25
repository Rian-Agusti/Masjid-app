<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')

    <style>
        /* Custom animations */
        @keyframes fadeSlideUp {
            0% {
                opacity: 0;
                transform: translateY(12px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-slide-up {
            animation: fadeSlideUp 0.5s cubic-bezier(0.2, 0.9, 0.4, 1.1) forwards;
        }
    </style>
</head>

<body class="bg-slate-900 text-slate-200 antialiased">
    <div class="min-h-screen flex">
        @include('components.sidebar')

        <div class="flex-1 flex flex-col transition-all duration-300 ease-out">
            @include('components.navbar')

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                <div
                    class="max-w-7xl mx-auto bg-slate-800/30 backdrop-blur-sm rounded-2xl shadow-2xl shadow-black/20 transition-all duration-300 hover:shadow-slate-700/20 animate-fade-slide-up">
                    <div class="p-5 sm:p-6 lg:p-8">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Remix Icon (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Scripts -->
    @stack('scripts')

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>

</html>