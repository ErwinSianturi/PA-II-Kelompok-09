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