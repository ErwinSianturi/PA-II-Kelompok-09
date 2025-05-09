<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
                }
            }
        }
    </script>

    <!-- Additional libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            padding-top: 80px;
            background-color: #f8fafc;
        }

        /* Navbar styles */
        .navbar-brand {
            font-weight: 700;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            position: relative;
            font-weight: 500;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #C194E9;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        /* Button styles */
        .btn-gradient {
            background: linear-gradient(45deg, #C194E9, #9B5DE5);
            color: white;
            border: none;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(155, 93, 229, 0.4);
        }

        /* Card styles */
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Footer styles */
        .footer {
            background-color: #C194E9;
            color: white;
            border-top-left-radius: 40px;
            border-top-right-radius: 40px;
        }

        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #C194E9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #9B5DE5;
        }

        /* Scroll to top button */
        .scroll-top-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 45px;
            height: 45px;
            background: #C194E9;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(155, 93, 229, 0.3);
            z-index: 999;
        }

        .scroll-top-btn.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-top-btn:hover {
            background: #9B5DE5;
            transform: translateY(-5px);
        }

        /* Mobile menu */
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .mobile-menu-overlay.open {
            height: calc(100vh - 80px);
        }

        .mobile-menu-items {
            padding: 2rem;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .mobile-menu-overlay.open .mobile-menu-items {
            opacity: 1;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
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
                    <a href="/" class="nav-link {{ Request::is('/') ? 'text-purple-600 active' : 'text-gray-700' }} px-1 py-2">Home</a>
                    <a href="/chat" class="nav-link {{ Request::is('chat*') ? 'text-purple-600 active' : 'text-gray-700 hover:text-purple-600' }} px-1 py-2">Obrolan</a>
                    <a href="/jobs" class="nav-link {{ Request::is('jobs*') ? 'text-purple-600 active' : 'text-gray-700 hover:text-purple-600' }} px-1 py-2">Status kerja</a>
                    <a href="/profil" class="nav-link {{ Request::is('profil*') ? 'text-purple-600 active' : 'text-gray-700 hover:text-purple-600' }} px-1 py-2">Profil</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="nav-link text-gray-700 hover:text-purple-600 px-1 py-2 bg-transparent border-0">
                            Logout
                        </button>
                    </form>
                    <a href="/jobs/create">
                        <button
                            class="relative px-6 py-2 rounded-lg bg-white border border-gray-300 text-black font-medium transition duration-300 overflow-hidden group">
                            <span
                                class="relative z-10 bg-clip-text text-black group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-cyan-400 group-hover:via-lime-400 group-hover:to-orange-500 transition duration-300">
                                Memberi Pekerjaan
                            </span>
                            <span
                                class="absolute inset-0 rounded-lg pointer-events-none group-hover:bg-gradient-to-r group-hover:from-cyan-400 group-hover:via-lime-400 group-hover:to-orange-500 p-px transition duration-300"></span>
                            <span class="absolute inset-[2px] rounded-lg bg-white"></span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="mobile-menu-overlay lg:hidden">
        <div class="mobile-menu-items flex flex-col space-y-6">
            <a href="/" class="text-xl font-medium text-purple-600">Home</a>
            <a href="#" class="text-xl font-medium text-gray-700 hover:text-purple-600">Obrolan</a>
            <a href="/jobs" class="text-xl font-medium text-gray-700 hover:text-purple-600">Status kerja</a>
            <a href="/profil" class="text-xl font-medium text-gray-700 hover:text-purple-600">Profil</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xl font-medium text-gray-700 hover:text-purple-600 bg-transparent border-0 p-0">
                    Logout
                </button>
            </form>

            <a href="/jobs/create" class="mt-4">
                <button class="w-full bg-gradient-to-r from-cyan-400 via-lime-400 to-orange-500 text-white font-medium py-3 px-6 rounded-lg transition-all duration-300 hover:shadow-lg">
                    Memberi Pekerjaan
                </button>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-24">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Left Column -->
                <div class="flex flex-col gap-6">
                    <div class="flex items-center bg-white px-5 py-3 rounded-lg w-fit">
                        @include('items.footer')
                    </div>

                    <div class="flex flex-col gap-4">
                        <div class="bg-lime-400 text-black px-3 py-1.5 w-fit rounded-md font-semibold">
                            Contact us:
                        </div>

                        <ul class="space-y-3 text-white">
                            <li class="flex items-center">
                                <i class="fas fa-envelope mr-3"></i>
                                <span>Gignego@gmail.com</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone-alt mr-3"></i>
                                <span>0822-9431-1975</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt mr-3 mt-1"></i>
                                <span>Sitoluama, Laguboti, Sumatera Utara</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="flex flex-col justify-center">
                    <p class="text-2xl md:text-3xl font-medium text-center md:text-left text-white leading-relaxed">
                        "Solusi cepat untuk mencari dan menawarkan <br class="hidden md:block">
                        pekerjaan, Aman & Terverifikasi,
                        <br class="hidden md:block">Rating & Ulasan Terpercaya"
                    </p>

                    <!-- Icon -->
                    <div class="flex justify-center md:justify-start mt-8">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#ffffff" viewBox="0 0 256 256" class="transition-transform duration-300 hover:scale-110">
                            <path d="M254.3,107.91,228.78,56.85a16,16,0,0,0-21.47-7.15L182.44,62.13,130.05,48.27a8.14,8.14,0,0,0-4.1,0L73.56,62.13,48.69,49.7a16,16,0,0,0-21.47,7.15L1.7,107.9a16,16,0,0,0,7.15,21.47l27,13.51,55.49,39.63a8.06,8.06,0,0,0,2.71,1.25l64,16a8,8,0,0,0,7.6-2.1l55.07-55.08,26.42-13.21a16,16,0,0,0,7.15-21.46Zm-54.89,33.37L165,113.72a8,8,0,0,0-10.68.61C136.51,132.27,116.66,130,104,122L147.24,80h31.81l27.21,54.41ZM41.53,64,62,74.22,36.43,125.27,16,115.06Zm116,119.13L99.42,168.61l-49.2-35.14,28-56L128,64.28l9.8,2.59-45,43.68-.08.09a16,16,0,0,0,2.72,24.81c20.56,13.13,45.37,11,64.91-5L188,152.66Zm62-57.87-25.52-51L214.47,64,240,115.06Zm-87.75,92.67a8,8,0,0,1-7.75,6.06,8.13,8.13,0,0,1-1.95-.24L80.41,213.33a7.89,7.89,0,0,1-2.71-1.25L51.35,193.26a8,8,0,0,1,9.3-13l25.11,17.94L126,208.24A8,8,0,0,1,131.82,217.94Z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-10 pt-4 border-t border-white/30 text-center text-white">
                <p>© 2025 Gignego. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to top button -->
    <div id="scroll-top-btn" class="scroll-top-btn">
        <i class="fas fa-arrow-up"></i>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        // Mobile menu toggle
        const toggleButton = document.getElementById('menu-toggle');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

        toggleButton.addEventListener('click', () => {
            mobileMenuOverlay.classList.toggle('open');
            document.body.classList.toggle('overflow-hidden');

            // Animate hamburger to X
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

        // Shrink navbar on scroll
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('py-2');
                navbar.classList.remove('py-3');
            } else {
                navbar.classList.add('py-3');
                navbar.classList.remove('py-2');
            }
        });

        // Scroll to top button
        const scrollTopBtn = document.getElementById('scroll-top-btn');

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

        // Add animation to elements when they come into view
        document.addEventListener('DOMContentLoaded', () => {
            const animateElements = document.querySelectorAll('.card, .footer, h1, h2, h3');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fadeInUp');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            animateElements.forEach(element => {
                observer.observe(element);
            });
        });
        <script src="https://kit.fontawesome.com/your-kit-code.js" crossorigin="anonymous"></script>
    </script>

    @yield('scripts')

</body>
</html>
