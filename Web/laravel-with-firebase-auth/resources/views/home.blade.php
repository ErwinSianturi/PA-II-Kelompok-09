<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIGNEGO - Kerja Singkat Deal Cepat</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        </style>
</head>
<body class="bg-white text-black">

    <nav class="fixed top-0 left-0 w-full bg-white z-50 ">
        <div class="container mx-auto flex justify-between items-center px-9 py-9">
            <div class="text-2xl font-bold flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="GIGNEGO Logo" class="h-20 transform -translate-x-9">

            </div>
            
            <div class="space-x-6 text-lg font-poppins">
                <a href="#" class="text-purple-500 ">Home</a>
                <a href="#" class="text-gray-700">Obrolan</a>
                <a href="#" class="text-gray-700">Status kerja</a>
                <a href="#" class="text-gray-700">Profil</a>
                <button class="px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-sm hover:bg-gray-100 transition">
                    Memberi Pekerjaan
                </button>
            </div>
        </div>
    </nav>
    

    <section class="w-full h-screen flex items-center justify-between px-20 mb-0">
        <div class="max-w-lg">
            <h1 class="text-7xl font-bold leading-tight font-[Space_Grotesk]">
                Kerja Singkat Deal Cepat</h1>
            <p class="mt-4 text-xl text-gray-600 leading-relaxed font-light">
                Temukan pekerjaan lepas dengan mudah atau rekrut pekerja sesuai kebutuhan Anda.
                Dapatkan proyek, negosiasi langsung, dan selesaikan pekerjaan dengan efisien.
            </p>
            <button class="mt-6 px-6 py-3 bg-black text-white rounded-lg text-lg">
                Lihat Selengkapnya
            </button>
        </div>
        <div>
            <img src="{{ asset('images/gambar_atas.png') }}" alt="gambar_atas" class="w-[600px]">
        </div>
    </section>
    
    <section class="px-20 py-4">
        <div class="flex items-center gap-6">
            <h2 class="text-4xl text-white bg-purple-600 px-4 py-2 rounded-lg inline-block">
                Kategori
            </h2>
            <p class="text-gray-600 text-lg">
                Temukan layanan profesional sesuai kebutuhan Anda, semua tersedia di satu platform.
                Pilih kategori di bawah ini dan dapatkan bantuan dari berbagai pekerja.
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-12 mt-10">
            <!-- Kartu Kategori -->
            <div class="p-6 bg-white rounded-xl shadow-lg border-l-4 border-purple-400">
                <h3 class="text-xl font-semibold text-purple-600">Kebersihan</h3>
                <p class="text-gray-600 mt-2">Layanan kebersihan rumah, kantor, dan lainnya.</p>
                <button class="mt-4 flex items-center text-purple-600 font-semibold">
                    <span>Lihat Selengkapnya</span>
                </button>
            </div>
    
            <div class="p-6 bg-white rounded-xl shadow-lg border-l-4 border-purple-400">
                <h3 class="text-xl font-semibold text-purple-600">Perbaikan Rumah</h3>
                <p class="text-gray-600 mt-2">Layanan renovasi dan perbaikan rumah.</p>
                <button class="mt-4 flex items-center text-purple-600 font-semibold">
                    <span>Lihat Selengkapnya</span>
                </button>
            </div>
    
            <div class="p-6 bg-white rounded-xl shadow-lg border-l-4 border-purple-400">
                <h3 class="text-xl font-semibold text-purple-600">Perbaikan Kendaraan</h3>
                <p class="text-gray-600 mt-2">Layanan perbaikan mobil dan motor.</p>
                <button class="mt-4 flex items-center text-purple-600 font-semibold">
                    <span>Lihat Selengkapnya</span>
                </button>
            </div>
    
            <div class="p-6 bg-white rounded-xl shadow-lg border-l-4 border-purple-400">
                <h3 class="text-xl font-semibold text-purple-600">Perbaikan Elektronik</h3>
                <p class="text-gray-600 mt-2">Layanan perbaikan perangkat elektronik.</p>
                <button class="mt-4 flex items-center text-purple-600 font-semibold">
                    <span>Lihat Selengkapnya</span>
                </button>
            </div>
    
            <div class="p-6 bg-white rounded-xl shadow-lg border-l-4 border-purple-400">
                <h3 class="text-xl font-semibold text-purple-600">Tutor</h3>
                <p class="text-gray-600 mt-2">Layanan les privat dan bimbingan belajar.</p>
                <button class="mt-4 flex items-center text-purple-600 font-semibold">
                    <span>Lihat Selengkapnya</span>
                </button>
            </div>
    
            <div class="p-6 bg-white rounded-xl shadow-lg border-l-4 border-purple-400">
                <h3 class="text-xl font-semibold text-purple-600">Rumah Tangga</h3>
                <p class="text-gray-600 mt-2">Layanan asisten rumah tangga dan sejenisnya.</p>
                <button class="mt-4 flex items-center text-purple-600 font-semibold">
                    <span>Lihat Selengkapnya</span>
                </button>
            </div>
        </div>
    </section>
    

</body>
</html>