
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-user-plus me-2"></i>Tambah Profil</h3>
                </div>
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('addprofile.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required hidden>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-id-card me-2"></i>Informasi Dasar</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                                    <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="harga_pekerjaan" class="form-select" id="jenis_kelamin" required>
                                        <option value="" disabled selected>Pilih jenis kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <label for="jenis_kelamin"><i class="fas fa-venus-mars me-2"></i>Jenis Kelamin</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
                                    <label for="tanggal_lahir"><i class="fas fa-calendar-alt me-2"></i>Tanggal Lahir</label>
                                    <div id="tanggal-error" class="invalid-feedback">
                                        Umur Anda harus minimal 18 tahun!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="WA" class="form-control" id="nomorWA" placeholder="628123456789" required max="12" min="12">
                                    <label for="nomorWA"><i class="fab fa-whatsapp me-2"></i>Nomor WA</label>
                                    <div id="wa-error" class="invalid-feedback">
                                        Nomor WA harus terdiri dari 12 angka.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-map-marked-alt me-2"></i>Informasi Alamat</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select name="kecamatan" class="form-select" id="kecamatan" required>
                                        <option value="" disabled selected>Pilih Kecamatan</option>
                                        <option value="Ajibata">Ajibata</option>
                                        <option value="Balige">Balige</option>
                                        <option value="Bonatua Lunasi">Bonatua Lunasi</option>
                                        <option value="Borbor">Borbor</option>
                                        <option value="Habinsaran">Habinsaran</option>
                                        <option value="Laguboti">Laguboti</option>
                                        <option value="Lumban Julu">Lumban Julu</option>
                                        <option value="Nassau">Nassau</option>
                                        <option value="Parmaksian">Parmaksian</option>
                                        <option value="Pintu Pohan Meranti">Pintu Pohan Meranti</option>
                                        <option value="Porsea">Porsea</option>
                                        <option value="Siantar Narumonda">Siantar Narumonda</option>
                                        <option value="Sigumpar">Sigumpar</option>
                                        <option value="Silaen">Silaen</option>
                                        <option value="Tampahan">Tampahan</option>
                                        <option value="Uluan">Uluan</option>
                                    </select>
                                    <label for="kecamatan"><i class="fas fa-map me-2"></i>Kecamatan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="desa" class="form-control" id="desa" placeholder="Nama desa" required>
                                    <label for="desa"><i class="fas fa-home me-2"></i>Desa</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea name="alamat_lengkap" class="form-control" id="alamat_lengkap" style="height: 100px" placeholder="Alamat lengkap Anda" required></textarea>
                                    <label for="alamat_lengkap"><i class="fas fa-map-marker-alt me-2"></i>Alamat Lengkap</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-briefcase me-2"></i>Informasi Pekerjaan</h5>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" placeholder="Pekerjaan Anda" required>
                                    <label for="pekerjaan"><i class="fas fa-user-tie me-2"></i>Pekerjaan</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-camera me-2"></i>Foto Profil</h5>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="image" class="form-label"><i class="fas fa-upload me-2"></i>Upload Foto (opsional)</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                    <div class="form-text text-muted">Format yang didukung: JPG, PNG, GIF. Maks 2MB.</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Simpan Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Script untuk validasi tanggal lahir
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalLahirInput = document.getElementById("tanggal_lahir");
        const tanggalError = document.getElementById("tanggal-error");

        tanggalLahirInput.addEventListener("change", function() {
            const today = new Date();
            const dob = new Date(tanggalLahirInput.value);

            // Menghitung umur berdasarkan tanggal lahir
            const age = today.getFullYear() - dob.getFullYear();
            const m = today.getMonth() - dob.getMonth();

            // Menentukan apakah umur sudah 18 tahun atau lebih
            if (age < 18 || (age === 18 && m < 0)) {
                tanggalLahirInput.classList.add("is-invalid");
                tanggalLahirInput.setCustomValidity("Umur Anda harus minimal 18 tahun!");
            } else {
                tanggalLahirInput.classList.remove("is-invalid");
                tanggalLahirInput.setCustomValidity("");
            }
        });

        // Script untuk validasi nomor WA
        const nomorWAInput = document.getElementById("nomorWA");
        const waError = document.getElementById("wa-error");

        nomorWAInput.addEventListener("input", function() {
            const value = nomorWAInput.value;

            // Mengecek apakah input hanya angka dan panjangnya 12 karakter
            const isValid = /^\d{12}$/.test(value);

            if (isValid) {
                nomorWAInput.classList.remove("is-invalid");
                nomorWAInput.setCustomValidity("");
            } else {
                nomorWAInput.classList.add("is-invalid");
                nomorWAInput.setCustomValidity("Nomor WA harus terdiri dari 12 angka.");
            }
        });
    });
</script>

<!-- Tambahkan Font Awesome jika belum ada di layout -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

