<!DOCTYPE html>
<html lang="id">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MS Jaya')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        * {
            scroll-behavior: smooth;
            transition: all 0.3s ease-in-out;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-white text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white border-b shadow-sm sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div  class="flex items-center space-x-3 ">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-auto">
                </div>
                
                <!-- Mobile Toggle -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-6 items-center">
                    @foreach ([['/', 'Beranda'], ['tentang', 'Tentang Kami'], ['kontak', 'Kontak']] as [$route, $label])
                        <a href="{{ url($route) }}"
                           class="text-gray-700 hover:text-green-600 font-medium transition duration-300 hover:underline underline-offset-4">{{ $label }}</a>
                    @endforeach
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-green-600 font-medium transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-yellow-500 hover:text-green-600 font-medium transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition duration-300 font-medium">Registrasi</a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden mt-2" x-show="open" x-transition>
                <div class="flex flex-col space-y-2 py-2">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-green-600 font-medium">Beranda</a>
                    <a href="{{ route('tentang') }}" class="text-gray-700 hover:text-green-600 font-medium">Tentang Kami</a>
                    <a href="{{ route('kontak') }}" class="text-gray-700 hover:text-green-600 font-medium">Kontak</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-green-600 font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 font-medium">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-green-600 font-medium">Registrasi</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    @yield('hero')

    <!-- Main Content -->
    <main class="py-16 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up" data-aos-delay="100">
            @yield('content')
        </div>
    </main>

<!-- Footer -->
<footer class="bg-green-700 dark:bg-green-800 text-white mt-16 py-10 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between gap-8 text-center md:text-left">
        
        <!-- Info Perusahaan -->
        <div class="flex-1">
            <h4 class="text-2xl text-green-300 border-green-600 font-bold mb-2">MS Jaya</h4>
            <p class="mt-4 text-sm">
                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a8 8 0 0011.314-11.314l-4.243-4.243a4 4 0 10-5.657 5.657l4.243 4.243z" />
                </svg>
                Sukamelang, Kec. Kroya, Kabupaten Indramayu, Jawa Barat 45265
            </p>
            <p class="text-sm">
                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-18 0A9 9 0 0121 12z" />
                </svg>
                <a href="mailto:info@msjaya.com" class="underline hover:text-green-200">info@msjaya.com</a>
            </p>
            <p class="text-sm">
                <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405M15 17l-1.405-1.405M15 17v3M10 17h-5l1.405-1.405M10 17l1.405-1.405M10 17v3" />
                </svg>
                <a href="https://wa.me/6281234567890" target="_blank" class="underline hover:text-green-200">+62 812 3456 7890</a>
            </p>
        </div>

        <!-- Sosial Media -->
        <div class="flex-1 flex flex-col items-center md:items-start justify-center">
            <h4 class="text-lg font-semibold mb-3">Ikuti Kami</h4>
            <div class="flex space-x-4 mt-1">
                <a href="#" class="hover:text-green-200" aria-label="Facebook">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12a10 10 0 10-11.5 9.87v-6.99h-2.4v-2.88h2.4V9.41c0-2.36 1.4-3.67 3.54-3.67 1.02 0 2.09.18 2.09.18v2.3h-1.18c-1.17 0-1.53.73-1.53 1.48v1.78h2.61l-.42 2.88h-2.19V22A10 10 0 0022 12z"/>
                    </svg>
                </a>
                <a href="#" class="hover:text-green-200" aria-label="Instagram">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm0 2h10c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3zm5 2a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6zm4.5-.1a1.1 1.1 0 11-2.2 0 1.1 1.1 0 012.2 0z"/>
                    </svg>
                </a>
                <a href="#" class="hover:text-green-200" aria-label="LinkedIn">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.98 3.5C4.98 4.88 3.88 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM0 8h5v16H0zM8 8h4v2.34h.06c.56-1.06 1.94-2.18 4-2.18 4.28 0 5.07 2.82 5.07 6.5V24h-5V15.5c0-2.06-.04-4.72-3-4.72-3 0-3.47 2.26-3.47 4.58V24H8V8z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Bottom Note -->
    <div class="text-center mt-10 text-sm text-green-200 border-t border-green-600 pt-4">
        &copy; {{ date('Y') }} <span class="font-semibold">MS Jaya</span>. Dibuat dengan ❤️.
    </div>
</footer>





    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
        });
    </script>
</body>
</html>
