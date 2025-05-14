@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        {{-- Bagian Header, Quote --}}
        <div
            class="flex flex-col md:flex-row justify-between items-center md:items-start mb-32 md:space-x-10 space-y-10 md:space-y-6">
            {{-- Kiri: Teks & Tanggal --}}
            <div class="w-full md:w-1/2 flex flex-col items-center md:items-start space-y-24 mt-14">
                {{-- Judul dan Quote --}}
                <div class="text-center md:text-left space-y-16">
                    <h1 class="text-5xl md:text-7xl font-bold text-red-600 mb-20"><i>{{ $jenis_pekerjaan }}</i></h1>
                    <p class="italic text-black text-xl md:text-3xl leading-relaxed mb-16">
                        "Jelajahi ratusan peluang kerja setiap hari!<br>
                        Temukan proyek impianmu dan raih penghasilan <br>lebih!"
                    </p>
                </div>

                <div x-data="dateSelector()" x-init="init()" class="relative flex justify-center space-x-4 mt-10">
                    <!-- Panah Atas (mengarah ke bawah 🔻) -->
                    <div class="absolute top-full mt-2 transition-all duration-300 ease-in-out"
                        :style="`left: ${arrowX}px; transform: translateX(-50%)`">
                        <!-- bentuk 🔻 -->
                        <div
                            class="w-0 h-0 border-l-8 border-r-8 border-b-[12px] border-l-transparent border-r-transparent border-b-red-500">
                        </div>
                    </div>

                    <!-- Panah Bawah (sekarang benar-benar di atas dan mengarah ke atas 🔺) -->
                    <div class="absolute bottom-full mb-2 transition-all duration-300 ease-in-out"
                        :style="`left: ${arrowX}px; transform: translateX(-145%)`">
                        <!-- bentuk 🔺 -->
                        <div
                            class="w-0 h-0 border-l-8 border-r-8 border-t-[12px] border-l-transparent border-r-transparent border-t-red-500">
                        </div>
                    </div>

                    <template x-for="(date, index) in dates" :key="index">
                        <div @click="selectedDate = index; $nextTick(() => updateArrow($el))" x-init="$nextTick(() => { if (selectedDate === index) updateArrow($el) })"
                            :class="selectedDate === index ?
                                'scale-110 bg-purple-500 text-white shadow-lg' :
                                'bg-purple-100 text-black shadow-md'"
                            class="relative px-6 py-4 rounded-xl text-center transform transition-transform duration-300 cursor-pointer">
                            <p class="text-lg font-semibold" x-text="date.bulan"></p>
                            <p class="text-3xl font-bold" x-text="date.tanggal"></p>
                            <p class="text-md" x-text="date.hari"></p>
                        </div>
                    </template>
                </div>
            </div>
            {{-- Kanan: Gambar SVG --}}
            <div class="w-full md:w-1/2 flex justify-center md:justify-end">
                @include('items.daftarkerja')
            </div>
        </div>
    </div>

    <div x-data="{ activeTab: 'semua' }" class="max-w-screen-2xl mx-auto px-4 md:px-1">
        {{-- Status Pekerjaan --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10 text-left">
            {{-- Card 1: Semua --}}
            <div @click="activeTab = 'semua'"
                :class="activeTab === 'semua' ? 'ring-4 ring-blue-400 transform scale-105' : ''"
                class="block bg-blue-100 rounded-2xl p-8 min-h-[220px] shadow transition-transform duration-300 hover:shadow-xl hover:-translate-y-2 cursor-pointer">
                <div class="w-14 h-14 rounded-full flex items-center justify-center mb-6">
                    @include('items.semua')
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div>
                        <h3 class="text-blue-600 font-bold text-2xl mb-3">Semua</h3>
                        <p class="text-lg text-black">Segala pekerjaan ditampilkan di sini</p>
                    </div>
                </div>
            </div>

            {{-- Card 2: Tersedia --}}
            <div @click="activeTab = 'Tersedia'"
                :class="activeTab === 'Tersedia' ? 'ring-4 ring-purple-400 transform scale-105' : ''"
                class="block bg-[#F2E7FF] rounded-2xl p-8 min-h-[220px] shadow transition-transform duration-300 hover:shadow-xl hover:-translate-y-2 cursor-pointer">
                <div class="w-14 h-14 bg-purple-300 rounded-full flex items-center justify-center mb-6">
                    @include('items.tersedia')
                </div>
                <h3 class="text-purple-600 font-bold text-2xl mb-3">Tersedia</h3>
                <p class="text-lg text-black">Beberapa pekerjaan yang tersedia</p>
            </div>

            {{-- Card 3: Dalam Proses --}}
            <div @click="activeTab = 'Dalam Proses'"
                :class="activeTab === 'Dalam Proses' ? 'ring-4 ring-orange-400 transform scale-105' : ''"
                class="block bg-[#FFE9DE] rounded-2xl p-8 min-h-[220px] shadow transition-transform duration-300 hover:shadow-xl hover:-translate-y-2 cursor-pointer">
                <div class="w-14 h-14 rounded-full flex items-center justify-center mb-6">
                    @include('items.proses')
                </div>
                <h3 class="text-orange-600 font-bold text-2xl mb-3">Dalam Proses</h3>
                <p class="text-lg text-black">Pekerjaan ini sedang berjalan</p>
            </div>

            {{-- Card 4: Selesai --}}
            <div @click="activeTab = 'Selesai'"
                :class="activeTab === 'Selesai' ? 'ring-4 ring-green-400 transform scale-105' : ''"
                class="block bg-[#E7FFEC] rounded-2xl p-8 min-h-[220px] shadow transition-transform duration-300 hover:shadow-xl hover:-translate-y-2 cursor-pointer">
                <div class="w-14 h-14 rounded-full flex items-center justify-center mb-6">
                    @include('items.selesai')
                </div>
                <h3 class="text-green-600 font-bold text-2xl mb-3">Selesai</h3>
                <p class="text-lg text-black">Pekerjaan yang sudah selesai</p>
            </div>
        </div>

        {{-- Daftar Pekerjaan --}}
        <h2 class="text-2xl font-semibold mb-6">Jenis Pekerjaan: {{ ucfirst($jenis_pekerjaan) }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($jobs as $job)
                <a href="{{ url('/jobs/' . $job->id . '/detail') }}"
                    x-show="activeTab === 'semua' || activeTab === '{{ $job->status_pekerjaan }}'"
                    class="transform transition-transform duration-300 hover:scale-105 block">
                    <div
                        class="bg-white rounded-2xl shadow-lg p-6 flex items-start justify-between relative min-h-[180px] hover:shadow-xl cursor-pointer">
                        {{-- Ikon atas kanan --}}
                        <div class="absolute top-3 right-3 p-1">
                            @if ($job->status_pekerjaan == 'Tersedia')
                                @include('items.tersedia')
                            @elseif ($job->status_pekerjaan == 'Dalam Proses')
                                @include('items.proses')
                            @elseif ($job->status_pekerjaan == 'Selesai')
                                @include('items.selesai')
                            @else
                                @include('items.tersedia')
                            @endif
                        </div>

                        {{-- Gambar --}}
                        <img src="{{ asset($job->image1) }}" alt="Job Image"
                            class="w-16 h-16 rounded-full object-cover mr-5">

                        {{-- Info pekerjaan --}}
                        <div class="flex-1">
                            <h5 class="text-lg font-semibold text-gray-800 mb-1">{{ $job->nama_pekerjaan }}</h5>
                            <p class="text-base text-gray-600 line-clamp-2">{{ $job->deskripsi }}</p>

                            {{-- Waktu --}}
                            <div class="mt-3 flex items-center text-purple-600 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.25a.75.75 0 00.44.68l3.25 1.5a.75.75 0 10.62-1.36l-2.81-1.29V5.25z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ \Carbon\Carbon::parse($job->tanggaldanwaktu)->format('H.i') }} WIB
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="absolute bottom-3 right-3">
                            @php
                                $statusLabel = $job->status_pekerjaan ?? 'Tersedia';
                                $statusConfig = [
                                    'Tersedia' => [
                                        'bg' => 'bg-purple-100',
                                        'text' => 'text-purple-800',
                                        'label' => 'Tersedia',
                                    ],
                                    'Dalam Proses' => [
                                        'bg' => 'bg-yellow-100',
                                        'text' => 'text-yellow-800',
                                        'label' => 'Dalam Proses',
                                    ],
                                    'Selesai' => [
                                        'bg' => 'bg-green-100',
                                        'text' => 'text-green-800',
                                        'label' => 'Selesai',
                                    ],
                                ];
                                $config = $statusConfig[$statusLabel] ?? $statusConfig['Tersedia'];
                            @endphp
                            <span
                                class="{{ $config['bg'] }} {{ $config['text'] }} text-sm px-4 py-1.5 rounded-full font-semibold">
                                {{ $config['label'] }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function dateSelector() {
            return {
                selectedDate: 0,
                arrowX: 0,
                dates: [],
                updateArrow(el) {
                    const rect = el.getBoundingClientRect();
                    const parentRect = el.parentElement.getBoundingClientRect();
                    this.arrowX = rect.left - parentRect.left + rect.width / 2;
                },
                init() {
                    // Reset array dates
                    this.dates = [];
                    const hariList = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    const bulanList = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                        'September', 'Oktober', 'November', 'Desember'
                    ];
                    const now = new Date();

                    for (let i = 0; i < 3; i++) {
                        const date = new Date(now);
                        date.setDate(now.getDate() + i);
                        this.dates.push({
                            hari: hariList[date.getDay()],
                            tanggal: date.getDate(),
                            bulan: bulanList[date.getMonth()]
                        });
                    }
                }
            }
        }
    </script>
@endpush
