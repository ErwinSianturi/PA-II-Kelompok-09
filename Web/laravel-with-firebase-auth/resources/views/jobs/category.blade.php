@extends('layouts.navbar')

@section('content')
    <div class="container mx-auto px-4 py-8">

        {{-- Bagian Header, Quote, dan Tanggal --}}
        <div
            class="flex flex-col md:flex-row justify-between items-center md:items-start mb-32 md:space-x-10 space-y-10 md:space-y-6">
            {{-- Kiri: Teks & Tanggal --}}
            <div class="w-full md:w-1/2 flex flex-col items-center md:items-start space-y-24 mt-14">
                {{-- Judul dan Quote --}}
                <div class="text-center md:text-left space-y-16">
                    <h1 class="text-5xl md:text-7xl font-bold text-red-600 mb-20"><i>Kebersihan</i></h1>
                    <p class="italic text-black text-xl md:text-3xl leading-relaxed mb-16">
                        "Jelajahi ratusan peluang kerja setiap hari!<br>
                        Temukan proyek impianmu dan raih penghasilan <br>lebih!"
                    </p>
                </div>

                {{-- Tanggal --}}
                <div x-data="datePicker()" x-init="init()"
                    class="flex justify-center md:justify-start items-center space-x-4" x-ref="dateWrapper">
                    <template x-for="(day, index) in dates" :key="index">
                        <div :ref="'date' + index" @click="selectDate(index)"
                            class="rounded-xl p-4 text-center cursor-pointer transition-all"
                            :class="selected === index ?
                                'bg-gradient-to-r from-purple-500 to-purple-700 text-white scale-105 shadow-md w-28' :
                                'bg-purple-200 text-black w-24'">
                            <div class="text-lg font-semibold" x-text="day.bulan"></div>
                            <div class="text-2xl font-bold" x-text="day.tanggal"></div>
                            <div class="text-sm" x-text="day.hari"></div>
                        </div>
                    </template>
                </div>
            </div>
            {{-- Kanan: Gambar SVG --}}
            <div class="w-full md:w-1/2 flex justify-center md:justify-end">
                @include('items.daftarkerja')
            </div>
        </div>

        <script>
            function datePicker() {
                return {
                    selected: 1,
                    dates: [{
                            bulan: 'Maret',
                            tanggal: 7,
                            hari: 'Jumat'
                        },
                        {
                            bulan: 'Maret',
                            tanggal: 8,
                            hari: 'Sabtu'
                        },
                        {
                            bulan: 'Maret',
                            tanggal: 9,
                            hari: 'Minggu'
                        },
                    ],
                    arrowStyleTop: '',
                    arrowStyleBottom: '',

                    init() {
                        this.$nextTick(() => this.updateArrow());
                    },

                    selectDate(index) {
                        this.selected = index;
                        this.$nextTick(() => this.updateArrow());
                    },

                    updateArrow() {
                        const wrapper = this.$refs.dateWrapper;
                        const el = this.$refs['date' + this.selected];

                        if (el && wrapper) {
                            const elOffset = el.offsetLeft;
                            const elWidth = el.offsetWidth;

                            // 8px adalah setengah lebar panah (border-r-8)
                            const arrowLeft = elOffset + (elWidth / 2) - 8;

                            this.arrowStyleTop = left: ${arrowLeft}px;;
                            this.arrowStyleBottom = left: ${arrowLeft}px;;
                        }
                    }
                }
            }
        </script>
    </div>

    <div class="max-w-screen-2xl mx-auto px-4 md:px-1">
        {{-- Status Pekerjaan --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10 text-left">

            {{-- Card 1: Semua --}}
            <a href="#"
                class="block bg-blue-100 rounded-2xl p-8 min-h-[220px] shadow transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="w-14 h-14 rounded-full flex items-center justify-center mb-6">
                    @include('items.semua')
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div>
                        <h3 class="text-blue-600 font-bold text-2xl mb-3">Semua</h3>
                        <p class="text-lg text-black">Segala pekerjaan ditampilkan di sini</p>
                    </div>
                </div>
            </a>

            {{-- Card 2: Tersedia --}}
            <a href="#"
                class="block bg-[#F2E7FF] rounded-2xl p-8 min-h-[220px] shadow transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="w-14 h-14 bg-purple-300 rounded-full flex items-center justify-center mb-6">
                    @include('items.tersedia')
                </div>
                <h3 class="text-purple-600 font-bold text-2xl mb-3">Tersedia</h3>
                <p class="text-lg text-black">Beberapa pekerjaan yang tersedia</p>
            </a>

            {{-- Card 3: Dalam Proses --}}
            <a href="#"
                class="block bg-[#FFE9DE] rounded-2xl p-8 min-h-[220px] shadow transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="w-14 h-14 rounded-full flex items-center justify-center mb-6">
                    @include('items.proses')
                </div>
                <h3 class="text-orange-600 font-bold text-2xl mb-3">Dalam Proses</h3>
                <p class="text-lg text-black">Pekerjaan ini sedang berjalan</p>
            </a>

            {{-- Card 4: Selesai --}}
            <a href="#"
                class="block bg-[#E7FFEC] rounded-2xl p-8 min-h-[220px] shadow transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                <div class="w-14 h-14 rounded-full flex items-center justify-center mb-6">
                    @include('items.selesai')
                </div>
                <h3 class="text-green-600 font-bold text-2xl mb-3">Selesai</h3>
                <p class="text-lg text-black">Pekerjaan yang sudah selesai</p>
            </a>

        </div>


        {{-- Daftar Pekerjaan --}}
        <h2 class="text-2xl font-semibold mb-6">Jenis Pekerjaan: {{ ucfirst($jenis_pekerjaan) }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($jobs as $job)
                <a href="{{ url('/jobs/' . $job->id) }}" class="transform transition-transform duration-300 hover:scale-105 block">
                    <div class="bg-white rounded-2xl shadow-lg p-6 flex items-start justify-between relative min-h-[180px] hover:shadow-xl cursor-pointer">
        
                        {{-- Ikon atas kanan --}}
                        <div class="absolute top-3 right-3 p-1">
                            @if ($job->status == 'tersedia')
                                @include('items.tersedia')
                            @elseif ($job->status == 'proses')
                                @include('items.proses')
                            @elseif ($job->status == 'selesai')
                                @include('items.selesai')
                            @else
                                @include('items.tersedia')
                            @endif
                        </div>
        
                        {{-- Gambar --}}
                        <img src="{{ asset($job->image) }}" alt="Job Image" class="w-16 h-16 rounded-full object-cover mr-5">
        
                        {{-- Info pekerjaan --}}
                        <div class="flex-1">
                            <h5 class="text-lg font-semibold text-gray-800 mb-1">{{ $job->nama_pekerjaan }}</h5>
                            <p class="text-base text-gray-600 line-clamp-2">{{ $job->deskripsi }}</p>
        
                            {{-- Waktu --}}
                            <div class="mt-3 flex items-center text-purple-600 text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-12.75a.75.75 0 00-1.5 0v4.25a.75.75 0 00.44.68l3.25 1.5a.75.75 0 10.62-1.36l-2.81-1.29V5.25z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ \Carbon\Carbon::parse($job->waktu_pekerjaan)->format('H.i') }} WIB
                            </div>
                        </div>
        
                        {{-- Status --}}
                        <div class="absolute bottom-3 right-3">
                            @php
                                $statusLabel = $job->status ?? 'tersedia';
                                $statusConfig = [
                                    'tersedia' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'label' => 'Tersedia'],
                                    'proses' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'label' => 'Dalam Proses'],
                                    'selesai' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'label' => 'Selesai'],
                                ];
                                $config = $statusConfig[$statusLabel] ?? $statusConfig['tersedia'];
                            @endphp
                            <span class="{{ $config['bg'] }} {{ $config['text'] }} text-sm px-4 py-1.5 rounded-full font-semibold">
                                {{ $config['label'] }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>