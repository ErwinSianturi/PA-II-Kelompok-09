<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIGNEGO - Kerja Singkat Deal Cepat</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-white text-black">

    <nav class="fixed top-0 left-0 w-full bg-white z-50 shadow">
        <div class="container mx-auto flex justify-between items-center px-9 py-4">
            <!-- Logo -->
            <div class="text-2xl font-bold flex items-center">
                @include('items.svglogo')
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
    </nav>

    <!-- Script untuk toggle menu -->
    <script>
        const toggleButton = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');

        toggleButton.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>

<section id="fitur"
    class="w-full min-h-screen flex flex-col md:flex-row items-center justify-between px-6 md:px-20 mb-0">
    <div class="max-w-lg text-center md:text-left">
        <h1 class="text-4xl md:text-7xl font-bold leading-tight font-[Space_Grotesk]">
            Kerja Singkat Deal Cepat</h1>
        <p class="mt-11 text-base md:text-xl text-gray-600 leading-relaxed font-light">
            Temukan pekerjaan lepas dengan mudah atau rekrut pekerja sesuai kebutuhan Anda.
            Dapatkan proyek, negosiasi langsung, dan selesaikan pekerjaan dengan efisien.
        </p>
        <button onclick="document.getElementById('kategori').scrollIntoView({ behavior: 'smooth' })"
            class="mt-6 px-6 py-3 bg-black text-white rounded-lg text-lg">
            Lihat Selengkapnya
        </button>
    </div>
    <div class="w-full md:w-1/2 max-w-xl mt-10 md:mt-0">
        @include('items.toak')

    </div>
</section>

<section id="kategori" class="px-20 py-4">
    <div class="flex items-center gap-6">
        <h2 class="text-4xl text-white bg-purple-600 px-4 py-2 rounded-lg inline-block">
            Kategori
        </h2>
        <p class="text-gray-600 text-lg">
            Temukan layanan profesional sesuai kebutuhan Anda, semua tersedia di satu platform.
            Pilih kategori di bawah ini dan dapatkan bantuan dari berbagai pekerja.
        </p>




    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-16 p-6 max-w-7xl mx-auto">
        <!-- Card Kebersihan -->
            <div class="flex flex-col md:flex-row justify-between items-center px-8 py-3 bg-[#F8F8FB] w-full h-auto rounded-[30px] transition transform duration-300 hover:scale-105"
                style="border: 1px solid rgba(0, 0, 0, 1); box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1), 0 8px 3px rgba(0, 0, 0, 0.85);">

                <!-- Kiri: Teks -->
                <div class="flex flex-col basis-1/2 gap-2">
                    <h3 class="text-white bg-purple-600 px-4 py-1 rounded-lg text-3xl w-fit font-normal mb-6">Kebersihan
                    </h3>
                    <p class="text-gray-500 text-sm">Jasa kebersihan untuk rumah, kantor, area publik dan lainnya</p>

                    <!-- Tombol -->
                    <a href="{{ route('category.show', ['jenis_pekerjaan' => 'kebersihan']) }}">
                        <button class="flex items-center gap-2 mt-4 bg-white text-black font-semibold px-4 py-2 rounded-lg">
                            <span class="flex items-center justify-center w-8 h-8 bg-black text-white rounded-full">➤</span>
                            Lihat Selengkapnya
                        </button>
                    </a>

                </div>

                <!-- Kanan: Ikon -->
                <div class="flex items-center justify-center basis-1/2">
                    <div class="w-full max-w-[112px] md:max-w-[128px] h-auto">
                        @include('items.kebersihan')
                    </div>
                </div>
            </div>

        <!-- Card Perbaikan Rumah -->
        <div class="flex flex-col md:flex-row justify-between items-center px-8 py-3 bg-[#F2E7FF] w-full h-auto rounded-[30px] transition transform duration-300 hover:scale-105"
            style="border: 1px solid rgba(0, 0, 0, 1); box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1), 0 8px 3px rgba(0, 0, 0, 0.85); min-width: 200px;">

            <!-- Kiri: Teks -->
            <div class="flex flex-col basis-1/2 gap-2">
                <h3 class="text-black bg-white px-4 py-1 rounded-lg text-3xl w-fit font-normal mb-6">Perbaikan Rumah
                </h3>
                <p class="text-gray-500 text-sm">Layanan perbaikan rumah profesional, mulai dari perbaikan atap bocor,
                    instalasi listrik, perbaikan pipa air, hingga renovasi interior dan eksterior.</p>

                <!-- Tombol -->
                <a href="{{ route('category.show', ['jenis_pekerjaan' => 'Perbaikan Rumah']) }}">
                <button class="flex items-center gap-2 mt-4 text-black font-semibold">
                    <span class="flex items-center justify-center w-8 h-8 bg-black text-white rounded-full">➤</span>
                    Lihat Selengkapnya
                </button>
            </div>
        </a>

            <!-- Kanan: Ikon -->
            <div class="flex items-center justify-center basis-1/2 mt-6 md:mt-0">
                <div
                    class="bg-gradient-to-b from-cyan-400 to-purple-600 rounded-2xl w-full max-w-[112px] md:max-w-[128px] aspect-square p-3 sm:p-4 md:p-5">
                    @include('items.perbaikanrumah')
                </div>
            </div>
        </div>

        <!-- Card Perbaikan Kendaraan -->
        <div class="flex flex-col md:flex-row justify-between items-center px-8 py-3 bg-[#F8F8FB] w-full h-auto rounded-[30px] transition transform duration-300 hover:scale-105"
            style="border: 1px solid rgba(0, 0, 0, 1); box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1), 0 8px 3px rgba(0, 0, 0, 0.85);">

            <!-- Kiri: Teks -->
            <div class="flex flex-col basis-1/2 gap-2">
                <h3 class="text-white bg-purple-600 px-4 py-1 rounded-lg text-3xl w-fit font-normal mb-6">Perbaikan
                    Kendaraan</h3>
                <p class="text-gray-500 text-sm">Layanan servis dan perbaikan kendaraan, mulai dari
                    ganti oli, perbaikan mesin, servis rem, pengecatan bodi,
                    hingga perbaikan AC mobil dan motor</p>

                <!-- Tombol -->
                <a href="{{ route('category.show', ['jenis_pekerjaan' => 'Perbaikan Kendaraan']) }}">
                <button class="flex items-center gap-2 mt-4 text-black font-semibold">
                    <span class="flex items-center justify-center w-8 h-8 bg-black text-white rounded-full">➤</span>
                    Lihat Selengkapnya
                </button>
            </div>
        </a>

            <!-- Kanan: Ikon dengan background (responsif) -->
            <div class="flex items-center justify-center basis-1/2 mt-6 md:mt-0">
                <div
                    class="bg-gradient-to-b from-purple-400 to-purple-900 rounded-2xl w-full max-w-[96px] md:max-w-[128px] aspect-square p-3 sm:p-4 md:p-5">
                    @include('items.kendaraan')
                </div>
            </div>
        </div>
        <!-- Card Perbaikan Elektronik -->
        <div class="flex flex-col md:flex-row justify-between items-center px-8 py-3 bg-[#F3F3F3] w-full h-auto rounded-[30px] transition transform duration-300 hover:scale-105"
            style="border: 1px solid rgba(0, 0, 0, 1); box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1), 0 8px 3px rgba(0, 0, 0, 0.85);">

            <!-- Kiri: Teks -->
            <div class="flex flex-col basis-1/2 gap-2">
                <h3 class="text-white bg-purple-600 px-4 py-1 rounded-lg text-3xl w-fit font-normal mb-6">Perbaikan
                    Elektronik</h3>
                <p class="text-gray-500 text-sm">Layanan perbaikan perangkat elektronik seperti TV, komputer, dan
                    perangkat lainnya.</p>

                <!-- Tombol -->
                <a href="{{ route('category.show', ['jenis_pekerjaan' => 'Perbaikan Elektronik']) }}">
                <button class="flex items-center gap-2 mt-4 text-black font-semibold">
                    <span class="flex items-center justify-center w-8 h-8 bg-black text-white rounded-full">➤</span>
                    Lihat Selengkapnya
                </button>
            </div>
        </a>

            <!-- Kanan: Ikon -->
            <div class="flex items-center justify-center basis-1/2 mt-6 md:mt-0">
                <div class="w-full max-w-[152px] md:max-w-[178px] aspect-square p-3 sm:p-4 md:p-5">
                    @include('items.elektronik')
                </div>
            </div>
        </div>

        <!-- Card Tutor -->
        <div class="flex flex-col md:flex-row justify-between items-center px-8 py-3 bg-[#F2E7FF] w-full h-auto rounded-[30px] transition transform duration-300 hover:scale-105"
            style="border: 1px solid rgba(0, 0, 0, 1); box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1), 0 8px 3px rgba(0, 0, 0, 0.85);">

            <!-- Kiri: Teks -->
            <div class="flex flex-col basis-1/2 gap-2">
                <h3 class="text-black bg-white px-4 py-1 rounded-lg text-3xl w-fit font-normal mb-6">Tutor</h3>
                <p class="text-gray-500 text-sm">Layanan les privat dan bimbingan belajar untuk berbagai mata
                    pelajaran.</p>

                <!-- Tombol -->
                <a href="{{ route('category.show', ['jenis_pekerjaan' => 'Tutor']) }}">
                <button class="flex items-center gap-2 mt-4 text-black font-semibold">
                    <span class="flex items-center justify-center w-8 h-8 bg-black text-white rounded-full">➤</span>
                    Lihat Selengkapnya
                </button>
            </div>
        </a>

            <!-- Kanan: Ikon -->
            <div class="flex items-center justify-center basis-1/2 mt-6 md:mt-0">
                <div class="w-full max-w-[152px] md:max-w-[178px] aspect-square p-3 sm:p-4 md:p-5">
                    @include('items.tutor')
                </div>
            </div>
        </div>

        <!-- Card Rumah Tangga -->
        <div class="flex flex-col md:flex-row justify-between items-center px-8 py-3 bg-[#F1FDFF] w-full h-auto rounded-[30px] transition transform duration-300 hover:scale-105"
            style="border: 1px solid rgba(0, 0, 0, 1); box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1), 0 8px 3px rgba(0, 0, 0, 0.85);">

            <!-- Kiri: Teks -->
            <div class="flex flex-col basis-1/2 gap-2">
                <h3 class="text-white bg-purple-600 px-4 py-1 rounded-lg text-3xl w-fit font-normal mb-6">Rumah Tangga
                </h3>
                <p class="text-gray-500 text-sm">Layanan bantuan rumah tangga seperti
                    mencuci, menyetrika,memasak, membersihkan
                    rumah, hingga merawat anak dan lansia.</p>

                <!-- Tombol -->
                <a href="{{ route('category.show', ['jenis_pekerjaan' => 'Rumah Tangga']) }}">
                <button class="flex items-center gap-2 mt-4 text-black font-semibold">
                    <span class="flex items-center justify-center w-8 h-8 bg-black text-white rounded-full">➤</span>
                    Lihat Selengkapnya
                </button>
            </div>
        </a>
            <!-- Kanan: Ikon -->
            <div class="flex items-center justify-center basis-1/2 mt-6 md:mt-0">
                <div class="w-full max-w-[592px] md:max-w-[178px] aspect-square p-3 sm:p-4 md:p-5">
                    @include('items.rumahtangga')
                </div>
            </div>
        </div>
        <!-- Card Fotografi & Videografi -->
        <div class="flex flex-col md:flex-row justify-between items-center px-8 py-3 bg-[#F1FDFF] w-full h-auto rounded-[30px] transition transform duration-300 hover:scale-105"
            style="border: 1px solid rgba(0, 0, 0, 1); box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1), 0 8px 3px rgba(0, 0, 0, 0.85);">

            <!-- Kiri: Teks -->
            <div class="flex flex-col basis-1/2 gap-2">
                <h3 class="text-white bg-purple-600 px-4 py-1 rounded-lg text-3xl w-fit font-normal mb-6">Fotografi &
                    Videografi</h3>
                <p class="text-gray-500 text-sm">Layanan profesional untuk fotografi dan
                    videografi, mulai dari pemotretan produk,
                    pernikahan, acara keluarga, hingga pembuatan
                    video promosi dan konten kreatif.</p>

                <!-- Tombol -->
                <a href="{{ route('category.show', ['jenis_pekerjaan' => 'Fotografi & videografi']) }}">
                <button class="flex items-center gap-2 mt-4 text-black font-semibold">
                    <span class="flex items-center justify-center w-8 h-8 bg-black text-white rounded-full">➤</span>
                    Lihat Selengkapnya
                </button>
            </div>
        </a>
            <!-- Kanan: Ikon -->
            <div class="flex items-center justify-center basis-1/2 mt-6 md:mt-0">
                <div class="w-full max-w-[152px] md:max-w-[178px] aspect-square p-3 sm:p-4 md:p-5">
                    @include('items.poto')
                </div>
            </div>
        </div>


        <!-- Card Lainnya -->
        <div class="flex flex-col md:flex-row justify-between items-center px-6 md:px-8 py-4 bg-[#F2E7FF] w-full h-auto rounded-[30px] transition transform duration-300 hover:scale-105"
            style="border: 1px solid rgba(0, 0, 0, 1); box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1), 0 8px 3px rgba(0, 0, 0, 0.85);">


            <!-- Kiri: Teks -->
            <div class="flex flex-col basis-full md:basis-1/2 gap-2">
                <h3
                    class="text-black bg-white px-4 py-1 rounded-lg text-2xl md:text-3xl w-fit font-normal mb-4 md:mb-6">
                    Lainnya</h3>
                <p class="text-gray-500 text-sm md:text-base leading-relaxed">
                    Beragam layanan tambahan sesuai kebutuhan Anda, mulai dari pengetikan dokumen, penerjemahan, hingga
                    konsultasi profesional.
                    Temukan solusi terbaik dengan tenaga ahli yang siap membantu.
                </p>

                <!-- Tombol -->
                <a href="{{ route('category.show', ['jenis_pekerjaan' => 'Lainnya']) }}">
                <button class="flex items-center gap-2 mt-4 text-black font-semibold hover:underline">
                    <span class="flex items-center justify-center w-8 h-8 bg-black text-white rounded-full">➤</span>
                    Lihat Selengkapnya
                </button>
            </div>
        </a>

            <!-- Kanan: Ikon -->
            <div class="flex items-center justify-center basis-full md:basis-1/2 mt-6 md:mt-0">
                <div class="w-full max-w-[220px] md:max-w-[250px] aspect-square p-3 sm:p-4 md:p-5">
                    @include('items.lain')
                </div>
            </div>
        </div>
</section>

<section id="kategori" class="px-20 py-4">
    <div class="flex items-center gap-6">
        <h2 class="text-4xl text-white bg-purple-600 px-4 py-2 rounded-lg inline-block mt-16 mb-16">
            Saran Pekerjaan
        </h2>
        <p class="text-gray-600 text-lg mt-4 mb-4">
            Beberapa saran pekerjaan yang tersedia dan yang mungkin<br>
            valid untuk anda.
        </p>
    </div>
</section>

<!-- saran pekerjaan -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-16 p-6 max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-center px-8 py-12 w-[800px] md:w-[1250px] h-auto rounded-[30px] transition transform duration-300 hover:scale-105"
        style="background-image: linear-gradient(to right, #7321DA, #AD7E80, #3A42D2);">
        <!-- Kiri: Teks -->
        <div class="flex flex-col basis-1/2 gap-2">
            <h3 class="text-white px-4 py-1 rounded-lg text-3xl w-fit font-normal mb-6">Mengecat Rumah</h3>
            <p class="text-white text-sm">“Suka bekerja di luar ruangan??”
                <br>
                kami mencari tenaga pengecatan rumah<br>
                untuk membantu dalam renovasi
            </p>

            <!-- Tombol -->
            <button class="flex items-center gap-2 mt-4 bg-white text-black font-semibold w-fit px-4 py-2 rounded-lg">
                Lihat Selengkapnya
            </button>
        </div>

        <!-- Kanan: Ikon -->
        <div class="flex items-center justify-center basis-1/2">
            <div class="w-full max-w-[112px] md:max-w-[128px] h-auto">
                @include('items.sarankerja1')
            </div>
        </div>
    </div>
    </body>

</html>
