<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="pt-20">
<nav id="home" class="fixed top-0 left-0 w-full bg-white z-50 shadow">
    <div class="container mx-auto flex justify-between items-center px-9 py-4">
        <!-- Logo -->
        <div class="text-2xl font-bold flex items-center">
            <a href="/home">
                @include('items.svglogo')
            </a>
        </div>

        <button id="menu-toggle" class="md:hidden text-black focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Menu Items -->
        <div id="menu"
            class="hidden md:flex md:items-center w-full md:w-auto mt-4 md:mt-0 space-y-4 md:space-y-0 md:space-x-8 text-lg">
            <a href="#" class="text-purple-500">Home</a>
            <a href="#" class="text-gray-700 block hover:text-purple-500">Obrolan</a>
            <a href="/jobs" class="text-gray-700 block hover:text-purple-500">Status kerja</a>
            <a href="/profil" class="text-gray-700 block hover:text-purple-500">Profil</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                <button type="submit" class="text-gray-700 hover:text-purple-500">Logout</button>
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
</nav><main class="container mx-auto mt-10">
    @yield('content')
</main>
@stack('scripts')
</body>
</html>

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
                    <a href="/"
                        class="nav-link {{ Request::is('/') ? 'text-purple-600 active' : 'text-gray-700' }} px-1 py-2">Home</a>
                    <a href="/obrolan"
                        class="nav-link {{ Request::is('obrolan*') ? 'text-purple-600 active' : 'text-gray-700 hover:text-purple-600' }} px-1 py-2">Obrolan</a>
                    <a href="/jobs"
                        class="nav-link {{ Request::is('jobs*') ? 'text-purple-600 active' : 'text-gray-700 hover:text-purple-600' }} px-1 py-2">Status
                        kerja</a>
                    <a href="/profil"
                        class="nav-link {{ Request::is('profil*') ? 'text-purple-600 active' : 'text-gray-700 hover:text-purple-600' }} px-1 py-2">Profil</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="nav-link text-gray-700 hover:text-purple-600 px-1 py-2 bg-transparent border-0">
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
                <button type="submit"
                    class="text-xl font-medium text-gray-700 hover:text-purple-600 bg-transparent border-0 p-0">
                    Logout
                </button>
            </form>

            <a href="/jobs/create" class="mt-4">
                <button
                    class="w-full bg-gradient-to-r from-cyan-400 via-lime-400 to-orange-500 text-white font-medium py-3 px-6 rounded-lg transition-all duration-300 hover:shadow-lg">
                    Memberi Pekerjaan
                </button>
            </a>
        </div>
    </div>
