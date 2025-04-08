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

    <nav class="fixed top-0 left-0 w-full bg-white z-50">
        <div class="container mx-auto flex justify-between items-center px-9 py-6">
            <!-- Logo -->
            <div class="text-2xl font-bold flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="GIGNEGO Logo" class="h-20 transform -translate-x-9">
            </div>
    

            <!-- Nav Menu -->
            <div class="flex items-center space-x-6 text-[16px] font-medium font-[Poppins]">
                <a href="#" class="text-purple-500">Home</a>
                <a href="#" class="text-gray-700">Obrolan</a>
                <a href="#" class="text-gray-700">Status kerja</a>
                <a href="#" class="text-gray-700">Profil</a>
                <a href="/profil" class="text-gray-700">Profil</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                <button type="submit" class="text-gray-700">Logout</button>
                            </form>
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
<<<<<<< Updated upstream
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 max-w-6xl mx-auto">
           <!-- Card Kebersihan -->
           <div class="flex flex-col md:flex-row justify-between items-center p-6 bg-[#F8F8FB] w-full max-w-5xl mx-auto"
     style="
        border-radius: 24px;
        border: 1px solid rgba(0, 0, 0, 1);  /* Stroke tipis */
        box-shadow: 0 18px 38px rgba(0, 0, 0, 0.1), 0 8px 15px rgba(0, 0, 0, 0.85); /* Shadow pekat */
     ">
=======

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-12 mt-10">
            <!-- Contoh 1 kartu -->
            <div class="p-10 bg-white rounded-xl border-2 border-gray-300 shadow-[0px_5px_10px_rgba(0,0,0,0.1)] min-h-[260px]">
                <h3 class="text-2xl font-semibold text-purple-600">Kebersihan</h3>
                <p class="text-gray-600 mt-4 text-lg">Jasa layanan kebersihan untuk rumah, kantor, dan lainnya.</p>
                <button class="mt-6 flex items-center text-purple-600 font-semibold text-lg">
                    <span>Lihat Selengkapnya</span>
                </button>
            </div>
>>>>>>> Stashed changes

  <!-- Kiri: Teks -->
  <div class="flex flex-col basis-1/2 gap-4">
    <h3 class="text-white bg-purple-600 px-4 py-1 rounded-lg text-3xl w-fit font-normal mb-4">Kebersihan</h3>
    <p class="text-gray-500 text-sm">Jasa kebersihan untuk rumah, kantor, dan area publik</p>

    <!-- Tombol -->
    <button class="flex items-center gap-2 mt-4 text-black font-semibold">
      <span class="flex items-center justify-center w-8 h-8 bg-black text-white rounded-full">
        ➤
      </span>
      Lihat Selengkapnya
    </button>
  </div>
          
            <!-- Kanan: Ikon/Gambar -->
            <div class="flex items-center justify-center basis-1/2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 299.01 299.01" class="w-24 h-24 md:w-28 md:h-28">
                <defs>
                  <linearGradient id="kebersihanGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#E325E6" />
                    <stop offset="100%" stop-color="#43AFBB" />
                  </linearGradient>
                </defs>
                <g id="XMLID_212_">
                  <g>
                    <g fill="url(#kebersihanGradient)">
                      <path d="M265.79,0H112.151c-4.028,0-7.63,1.853-10.002,4.75c2.605,2.296,4.846,4.99,6.657,7.972h156.985c0.112,0,0.204,0.092,0.204,0.205v140.806c0,0.112-0.092,0.205-0.204,0.205H120.192v12.722H265.79c7.127,0,12.927-5.799,12.927-12.927V12.927C278.717,5.799,272.918,0,265.79,0z"/>
                      <path d="M133.684,138.25l36.08-27.141c5.077-3.819,6.131-10.994,2.409-16.114c1.851-7.6,6.62-27.18,8.396-34.476l27.451,6.685c1.223,0.298,2.456-0.452,2.754-1.675l2.985-12.258c0.298-1.223-0.452-2.456-1.675-2.754l-71.59-17.435c-1.223-0.298-2.456,0.452-2.754,1.675l-2.985,12.258c-0.298,1.223,0.452,2.456,1.675,2.754l27.451,6.685c-0.383,1.573-6.569,26.971-8.943,36.72l-16.737,12.591l-0.081-16.188c-0.076-15.081-12.404-27.365-27.503-27.365c-7.162,0-56.366,0-62.393,0C26.128,62.224,20.78,77.994,20.722,89.577l-0.429,85.382c-0.033,6.419,5.145,11.648,11.563,11.681c0.02,0,0.04,0,0.06,0c6.348,0,11.588-5.141,11.621-11.564l0.429-85.383c0.007-1.238,1.013-2.237,2.25-2.233c1.237,0.003,2.238,1.008,2.238,2.244c0.001,27.769,0.005,182.647,0.005,195.359c0,7.703,6.243,13.946,13.946,13.946c7.691,0,13.946-6.228,13.946-13.946V173.588h6.022v111.475c0,7.68,6.218,13.946,13.946,13.946c7.688,0,13.946-6.227,13.946-13.946c0-182.046-0.247-82.185-0.253-195.357c0-1.341,1.085-2.428,2.425-2.432c1.341-0.004,2.432,1.078,2.439,2.419l0.198,39.327C115.124,138.594,126.093,143.961,133.684,138.25z"/>
                      <polygon points="231.512,23.778 229.738,31.243 222.272,33.017 229.738,34.791 231.512,42.256 233.286,34.791 240.751,33.017 233.286,31.243"/>
                      <polygon points="245.506,58.685 246.791,53.276 252.201,51.99 246.791,50.705 245.506,45.295 244.221,50.705 238.811,51.99 244.221,53.276"/>
                      <polygon points="235.328,69.128 233.799,75.565 227.361,77.095 233.799,78.624 235.328,85.062 236.858,78.624 243.296,77.095 236.858,75.565"/>
                      <path d="M79.52,54.535c13.22,0,24.087-10.717,24.087-24.087c0-13.303-10.784-24.087-24.087-24.087c-13.303,0-24.087,10.784-24.087,24.087C55.433,43.857,66.344,54.535,79.52,54.535z"/>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
<<<<<<< Updated upstream
            
          </div>
          
            <!-- Card Perbaikan Rumah -->
            <div class="p-6 bg-white rounded-xl border shadow-lg flex flex-col md:flex-row gap-4 w-full max-w-5xl mx-auto">
  <!-- Teks (50%) -->
  <div class="flex flex-col justify-center basis-1/2">
    <h3 class="text-2xl font-semibold text-purple-600 mb-2">Perbaikan Rumah</h3>
    <p class="text-gray-600 mb-4">
      Layanan perbaikan rumah profesional, mulai dari perbaikan atap bocor, instalasi listrik, perbaikan pipa air,
      hingga renovasi interior dan eksterior.
    </p>
    <button class="mt-2 px-4 py-2 bg-purple-600 text-white rounded-lg w-fit hover:bg-purple-700 transition">
      Lihat Selengkapnya
    </button>
  </div>

  <!-- Icon (50%) -->
  <div class="flex items-center justify-center basis-1/2">
    <svg
      fill="#000000"
      version="1.1"
      id="Layer_1"
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 0 245 256"
      class="w-24 h-24"
    >
      <g id="SVGRepo_iconCarrier">
        <path
          d="M190,63.24V7h-31v27.73L122.97,1.82L1.94,110.15l18.4,20.74L39,114.04V254h167V115.08l18.36,16.85l18.89-20.22L190,63.24z M171.16,171.14h-51.37v7.71c3.46,0.35,6.22,3.34,6.22,6.91v33.17c0,3.8-3.11,6.91-6.91,6.91h-3.22c-3.8,0-6.91-3.11-6.91-6.91 v-33.17c0-3.57,2.76-6.56,6.22-6.91v-12.32h51.48v-28.56h-5.53v7.14c0,3.8-3.11,6.91-6.91,6.91H80.75c-3.8,0-6.91-3.11-6.91-6.91 v-16.36c0-3.8,3.11-6.91,6.91-6.91h73.36c3.81,0,6.91,3.11,6.91,6.91v4.61h10.14V171.14z"
        ></path>
      </g>
    </svg>
  </div>
</div>

          
    
=======

>>>>>>> Stashed changes
            <div class="p-10 bg-white rounded-xl border-2 border-gray-300 shadow-[0px_5px_10px_rgba(0,0,0,0.1)] min-h-[260px]">
                <h3 class="text-2xl font-semibold text-purple-600">Perbaikan Kendaraan</h3>
                <p class="text-gray-600 mt-4 text-lg">Layanan perbaikan mobil dan motor.</p>
                <button class="mt-6 flex items-center text-purple-600 font-semibold text-lg">
                    <span>Lihat Selengkapnya</span>
                </button>
            </div>
                

            <div class="p-10 bg-white rounded-xl border-2 border-gray-300 shadow-[0px_5px_10px_rgba(0,0,0,0.1)] min-h-[260px]">
                <h3 class="text-2xl font-semibold text-purple-600">Perbaikan Elektronik</h3>
                <p class="text-gray-600 mt-4 text-lg">Layanan perbaikan Perangkat Elektronik.</p>
                <button class="mt-6 flex items-center text-purple-600 font-semibold text-lg">
                    <span>Lihat Selengkapnya</span>
                </button>
            </div>
                

            <div class="p-10 bg-white rounded-xl border-2 border-gray-300 shadow-[0px_5px_10px_rgba(0,0,0,0.1)] min-h-[260px]">
                <h3 class="text-2xl font-semibold text-purple-600">Tutor</h3>
                <p class="text-gray-600 mt-4 text-lg">Layanan les privat dan bimbingan belajar.</p>
                <button class="mt-6 flex items-center text-purple-600 font-semibold text-lg">
                    <span>Lihat Selengkapnya</span>
                </button>
            </div>
    

            <div class="p-10 bg-white rounded-xl border-2 border-gray-300 shadow-[0px_5px_10px_rgba(0,0,0,0.1)] min-h-[260px]">
                <h3 class="text-2xl font-semibold text-purple-600">Rumah Tangga</h3>
                <p class="text-gray-600 mt-4 text-lg">Layanan asisten rumah tangga dan sejenisnya.</p>
                <button class="mt-6 flex items-center text-purple-600 font-semibold text-lg">
                    <span>Lihat Selengkapnya</span>
                </button>
            </div>
        </div>
    </section>


</body>
</html>
