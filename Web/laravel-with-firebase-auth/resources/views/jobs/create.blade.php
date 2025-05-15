@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto max-w-3xl px-4">
            <!-- Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-center text-gray-800">
                    <span class="border-b-4 border-indigo-500 pb-2">Create Pekerjaan</span>
                </h2>
            </div>

            <!-- Main Form -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <form id="jobForm" action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <!-- Basic Information Section -->
                    <div class="border-b pb-6">
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">Informasi Dasar</h3>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pekerjaan</label>
                                <input type="text" name="nama_pekerjaan"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Pekerjaan</label>
                                <select name="jenis_pekerjaan"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                    required>
                                    @foreach (['Kebersihan', 'Perbaikan Rumah', 'Perbaikan Kendaraan', 'Perbaikan Elektronik', 'Tutor', 'Rumah Tangga', 'Fotografi & videografi', 'Lainnya'] as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Price and Time Section -->
                    <div class="border-b pb-6">
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">Harga dan Waktu</h3>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Harga Pekerjaan</label>
                                <div class="relative">
                                    <input type="text" id="harga_pekerjaan" name="harga_pekerjaan"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                        required oninput="formatHarga(this)" onblur="validateHarga(this)">
                                    <small id="hargaErrorMessage" class="text-red-500 text-sm mt-1" style="display: none">
                                        Harga harus antara 20.000 dan 1.000.000.000
                                    </small>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lama Pekerjaan (Jam)</label>
                                <input type="number" name="time" id="time"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                    min="1" max="12" required>
                                <small id="timeErrorMessage" class="text-red-500 text-sm mt-1" style="display: none">
                                    Waktu tidak bisa lebih dari 12 jam.
                                </small>
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal dan Waktu</label>
                                <input type="datetime-local" name="tanggaldanwaktu" id="tanggaldanwaktu" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                                    min="<?php echo date('Y-m-d\TH:i', strtotime('+0 days')); ?>" max="<?php echo date('Y-m-d\TH:i', strtotime('+3 days')); ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="border-b pb-6">
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">Deskripsi Pekerjaan</h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea name="deskripsi" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Syarat dan Ketentuan</label>
                                <textarea name="syarat_ketentuan" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                                <textarea name="lokasi" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Images Section -->
                    <div>
                        <h3 class="text-xl font-semibold mb-4 text-gray-700">Gambar Pekerjaan</h3>
                        <h4 class="text-xs font-semibold mb-4 text-gray-400"> Minimal 1 Gambar</h4>
                        <div class="grid gap-6 md:grid-cols-3">
                            @for ($i = 1; $i <= 3; $i++)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar
                                        {{ $i }}</label>
                                    <div class="space-y-2">
                                        <img id="previewImage{{ $i }}" alt="Preview"
                                            class="w-full h-40 object-cover rounded-lg">
                                        <input type="file" name="image{{ $i }}"
                                            id="image{{ $i }}Input"
                                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Hidden Fields -->
                    <div style="display: none">
                        <input type="email" name="email" value="{{ Auth::user()->email }}" readonly required>
                        <select name="status_pekerjaan">
                            <option value="Tersedia">Tersedia</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit"
                            class="w-full p-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Create
                            Job</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Your existing JavaScript for price formatting and validation
        function formatHarga(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            if (value) {
                value = parseInt(value).toLocaleString();
                input.value = 'Rp. ' + value;
            }
        }

        function validateHarga(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            const min = 20000;
            const max = 1000000000;
            const errorMessage = document.getElementById('hargaErrorMessage');
            if (value < min || value > max || value === "") {
                errorMessage.style.display = 'block';
                input.value = '';
            } else {
                errorMessage.style.display = 'none';
            }
        }

        function cleanHarga() {
            let input = document.getElementById('harga_pekerjaan');
            let value = input.value.replace(/[^0-9]/g, '');
            input.value = value;
        }

        // Form submission handler
        document.getElementById('jobForm').addEventListener('submit', function(event) {
            cleanHarga();
        });

        // Time input validation
        document.getElementById('time').addEventListener('input', function(event) {
            const timeInput = event.target;
            const errorMessage = document.getElementById('timeErrorMessage');
            if (timeInput.value > 12) {
                timeInput.value = 12;
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        });

        // Image preview handlers
        for (let i = 1; i <= 3; i++) {
            document.getElementById(`image${i}Input`).addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById(`previewImage${i}`);
                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.onload = () => URL.revokeObjectURL(preview.src);
                }
            });
        }
    </script>
@endsection
