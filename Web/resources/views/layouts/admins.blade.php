<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GIGNEGO - Kerja Singkat Deal Cepat</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#C194E9',
                        secondary: '#9B5DE5',
                        accent: '#00F5A0',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        fadeInUp: 'fadeInUp 0.5s ease-out forwards',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        }
                    }
                }
            }
        }
    </script>

    <!-- Additional libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        html, body {
            height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            padding-top: 80px;
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .navbar-brand {
            font-weight: 700;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        /* Mobile menu overlay */
        .mobile-menu-overlay {
            position: fixed;
            top: 80px;
            left: 0;
            width: 100%;
            height: 0;
            background-color: white;
            overflow: hidden;
            transition: height 0.3s ease;
            z-index: 40;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .mobile-menu-overlay.open {
            height: calc(100vh - 80px);
        }

        .mobile-menu-items {
            padding: 2rem;
        }

        /* Scroll to top button */
        #scroll-top-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background-color: #C194E9;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 30;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        #scroll-top-btn.visible {
            opacity: 1;
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: #9B5DE5;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: #9B5DE5;
            left: 0;
            bottom: -2px;
            transition: width 0.3s ease;
        }

        .nav-link:hover:after, .nav-link.active:after {
            width: 100%;
        }
    </style>
</head>

<body>
    <nav id="navbar" class="fixed top-0 left-0 w-full bg-white z-50 shadow-md transition-all duration-300">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="/" class="navbar-brand flex items-center space-x-2">
                    @include('items.svglogo')
                </a>

                <!-- Mobile Menu Toggle -->
                <button id="menu-toggle" class="lg:hidden focus:outline-none">
                    <div class="w-6 h-6 flex flex-col justify-between">
                        <span class="w-full h-0.5 bg-gray-800 transition-all duration-300"></span>
                        <span class="w-full h-0.5 bg-gray-800 transition-all duration-300"></span>
                        <span class="w-full h-0.5 bg-gray-800 transition-all duration-300"></span>
                    </div>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/admin" class="nav-link {{ request()->is('admin*') ? 'text-purple-600 active' : 'text-gray-700' }} px-1 py-2">Home</a>
                    @auth
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="nav-link text-gray-700 hover:text-purple-600 px-1 py-2 bg-transparent border-0">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-link text-gray-700 hover:text-purple-600 px-1 py-2">Login</a>
                        <a href="{{ route('register') }}" class="nav-link text-gray-700 hover:text-purple-600 px-1 py-2">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="mobile-menu-overlay lg:hidden">
        <div class="mobile-menu-items flex flex-col space-y-6">
            <a href="/" class="text-xl font-medium {{ request()->is('/') ? 'text-purple-600' : 'text-gray-700 hover:text-purple-600' }}">Home</a>
            <a href="/obrolan" class="text-xl font-medium {{ request()->is('obrolan*') ? 'text-purple-600' : 'text-gray-700 hover:text-purple-600' }}">Obrolan</a>
            <a href="/jobs" class="text-xl font-medium {{ request()->is('jobs*') ? 'text-purple-600' : 'text-gray-700 hover:text-purple-600' }}">Status kerja</a>
            <a href="/profil" class="text-xl font-medium {{ request()->is('profil*') ? 'text-purple-600' : 'text-gray-700 hover:text-purple-600' }}">Profil</a>

            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-xl font-medium text-gray-700 hover:text-purple-600 bg-transparent border-0 p-0">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-xl font-medium text-gray-700 hover:text-purple-600">Login</a>
                <a href="{{ route('register') }}" class="text-xl font-medium text-gray-700 hover:text-purple-600">Register</a>
            @endauth

            <a href="/jobs/create" class="mt-4">
                <button class="w-full bg-gradient-to-r from-cyan-400 via-lime-400 to-orange-500 text-white font-medium py-3 px-6 rounded-lg transition-all duration-300 hover:shadow-lg">
                    Memberi Pekerjaan
                </button>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 flex-1">
        @yield('content')
    </main>



    <!-- Scroll to top button -->
    <button id="scroll-top-btn" class="shadow-md">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        // Mobile menu toggle
        const toggleButton = document.getElementById('menu-toggle');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

        if (toggleButton && mobileMenuOverlay) {
            toggleButton.addEventListener('click', () => {
                mobileMenuOverlay.classList.toggle('open');
                document.body.classList.toggle('overflow-hidden');

                toggleButton.querySelectorAll('span').forEach((span, index) => {
                    if (mobileMenuOverlay.classList.contains('open')) {
                        if (index === 0) span.style.transform = 'rotate(45deg) translate(5px, 5px)';
                        if (index === 1) span.style.opacity = '0';
                        if (index === 2) span.style.transform = 'rotate(-45deg) translate(5px, -5px)';
                    } else {
                        span.style.transform = 'none';
                        span.style.opacity = '1';
                    }
                });
            });
        }

        // Shrink navbar on scroll
        const navbar = document.getElementById('navbar');
        if (navbar) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('py-2');
                    navbar.classList.remove('py-3');
                } else {
                    navbar.classList.add('py-3');
                    navbar.classList.remove('py-2');
                }
            });
        }

        // Scroll to top button
        const scrollTopBtn = document.getElementById('scroll-top-btn');
        if (scrollTopBtn) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    scrollTopBtn.classList.add('visible');
                } else {
                    scrollTopBtn.classList.remove('visible');
                }
            });

            scrollTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Add animation to elements when they come into view
        document.addEventListener('DOMContentLoaded', () => {
            const animateElements = document.querySelectorAll('.card, .footer, h1, h2, h3');

            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate-fadeInUp');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.1
                });

                animateElements.forEach(element => {
                    observer.observe(element);
                });
            } else {
                // Fallback untuk browser yang tidak mendukung IntersectionObserver
                animateElements.forEach(element => {
                    element.classList.add('animate-fadeInUp');
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
