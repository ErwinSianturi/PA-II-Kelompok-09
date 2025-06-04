@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div style="height: 5vw;"></div>
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="fas fa-briefcase me-2"></i>Masukkan Pendidikan Terakhir</h3>
                    </div>
                    <div class="card-body p-4">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Hidden field to auto-fill user_id -->
                        <form method="POST" action="{{ route('pendidikan.store') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                            <div class="row mb-3">
                                <!-- Full width for jenjang_pendidikan -->
                                <div class="col-12">
                                    <div class="form-floating mb-4">
                                        <select name="jenjang_pendidikan" id="jenjang_pendidikan"
                                            class="form-select @error('jenjang_pendidikan') is-invalid @enderror" required>
                                            <option value="" disabled selected>Pilih jenjang pendidikan</option>
                                            <option value="Tidak Sekolah"
                                                {{ old('jenjang_pendidikan') == 'Tidak Sekolah' ? 'selected' : '' }}>
                                                Tidak Sekolah</option>
                                            <option value="SD"
                                                {{ old('jenjang_pendidikan') == 'SD' ? 'selected' : '' }}>SD
                                            </option>
                                            <option value="SMP"
                                                {{ old('jenjang_pendidikan') == 'SMP' ? 'selected' : '' }}>SMP
                                            </option>
                                            <option value="SMA"
                                                {{ old('jenjang_pendidikan') == 'SMA' ? 'selected' : '' }}>SMA
                                            </option>
                                            <option value="D3"
                                                {{ old('jenjang_pendidikan') == 'D3' ? 'selected' : '' }}>D3
                                            </option>
                                            <option value="D4"
                                                {{ old('jenjang_pendidikan') == 'D4' ? 'selected' : '' }}>D4
                                            </option>
                                            <option value="S1"
                                                {{ old('jenjang_pendidikan') == 'S1' ? 'selected' : '' }}>S1
                                            </option>
                                            <option value="S2"
                                                {{ old('jenjang_pendidikan') == 'S2' ? 'selected' : '' }}>S2
                                            </option>
                                            <option value="S3"
                                                {{ old('jenjang_pendidikan') == 'S3' ? 'selected' : '' }}>S3
                                            </option>
                                        </select>
                                        <label for="jenjang_pendidikan"><i class="fas fa-graduation-cap me-2"></i>Jenjang
                                            Pendidikan</label>
                                        @error('jenjang_pendidikan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nama Institusi -->
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="nama_institusi" id="nama_institusi"
                                            class="form-control @error('nama_institusi') is-invalid @enderror"
                                            placeholder="Nama Institusi" value="{{ old('nama_institusi') }}">
                                        <label for="nama_institusi"><i class="fas fa-building me-2"></i>Nama
                                            Institusi</label>
                                        @error('nama_institusi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jurusan -->
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="jurusan" id="jurusan"
                                            class="form-control @error('jurusan') is-invalid @enderror"
                                            placeholder="Jurusan" value="{{ old('jurusan') }}">
                                        <label for="jurusan"><i class="fas fa-book me-2"></i>Jurusan</label>
                                        @error('jurusan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Simpan Pendidikan Terakhir
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 5vw;"></div>

    <!-- Footer spacing -->
    <div style="height: 80px;"></div> <!-- Adds space before the footer -->

    <!-- Include Flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Include Font Awesome if not already included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
