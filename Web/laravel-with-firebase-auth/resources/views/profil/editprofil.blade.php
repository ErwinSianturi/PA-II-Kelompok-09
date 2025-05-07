@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="fas fa-user-edit me-2"></i>Edit Profil</h3>
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

                        <form action="{{ route('profil.update', $profil->id) }}" method="POST"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}"
                                required hidden>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-id-card me-2"></i>Informasi
                                        Dasar</h5>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="username" class="form-control" id="username"
                                            value="{{ old('username', $profil->username) }}" required>
                                        <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select name="harga_pekerjaan" class="form-select" id="jenis_kelamin" required>
                                            <option value="" disabled selected>Pilih jenis kelamin</option>
                                            <option value="Laki-laki" {{ old('harga_pekerjaan', $profil->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('harga_pekerjaan', $profil->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        <label for="jenis_kelamin"><i class="fas fa-venus-mars me-2"></i>Jenis Kelamin</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', $profil->tanggal_lahir) }}" required>
                                        <label for="tanggal_lahir"><i class="fas fa-calendar-alt me-2"></i>Tanggal
                                            Lahir</label>
                                        <div id="tanggal-error" class="invalid-feedback">
                                            Umur Anda harus minimal 18 tahun!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="WA" class="form-control" id="nomorWA"
                                            placeholder="628123456789" value="{{ old('WA', $profil->WA) }}" required>
                                        <label for="nomorWA"><i class="fab fa-whatsapp me-2"></i>Nomor WA</label>
                                        <div id="wa-error" class="invalid-feedback">
                                            Nomor WA harus terdiri dari 12 angka.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 text-primary"><i
                                            class="fas fa-map-marked-alt me-2"></i>Informasi Alamat
                                    </h5>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="kecamatan" class="form-select" id="kecamatan" required>
                                            <option value="" disabled selected>Pilih Kecamatan</option>
                                            <option value="Ajibata"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Ajibata' ? 'selected' : '' }}>
                                                Ajibata</option>
                                            <option value="Balige"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Balige' ? 'selected' : '' }}>
                                                Balige</option>
                                            <option value="Bonatua Lunasi"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Bonatua Lunasi' ? 'selected' : '' }}>
                                                Bonatua Lunasi</option>
                                            <option value="Borbor"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Borbor' ? 'selected' : '' }}>
                                                Borbor</option>
                                            <option value="Habinsaran"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Habinsaran' ? 'selected' : '' }}>
                                                Habinsaran</option>
                                            <option value="Laguboti"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Laguboti' ? 'selected' : '' }}>
                                                Laguboti</option>
                                            <option value="Lumban Julu"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Lumban Julu' ? 'selected' : '' }}>
                                                Lumban Julu</option>
                                            <option value="Nassau"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Nassau' ? 'selected' : '' }}>
                                                Nassau</option>
                                            <option value="Parmaksian"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Parmaksian' ? 'selected' : '' }}>
                                                Parmaksian</option>
                                            <option value="Pintu Pohan Meranti"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Pintu Pohan Meranti' ? 'selected' : '' }}>
                                                Pintu Pohan Meranti</option>
                                            <option value="Porsea"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Porsea' ? 'selected' : '' }}>
                                                Porsea</option>
                                            <option value="Siantar Narumonda"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Siantar Narumonda' ? 'selected' : '' }}>
                                                Siantar Narumonda</option>
                                            <option value="Sigumpar"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Sigumpar' ? 'selected' : '' }}>
                                                Sigumpar</option>
                                            <option value="Silaen"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Silaen' ? 'selected' : '' }}>
                                                Silaen</option>
                                            <option value="Tampahan"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Tampahan' ? 'selected' : '' }}>
                                                Tampahan</option>
                                            <option value="Uluan"
                                                {{ old('kecamatan', $profil->kecamatan) == 'Uluan' ? 'selected' : '' }}>
                                                Uluan</option>
                                        </select>
                                        <label for="kecamatan"><i class="fas fa-map me-2"></i>Kecamatan</label>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="desa" class="form-control" id="desa"
                                            placeholder="Nama desa" value="{{ old('WA', $profil->desa) }}" required>
                                        <label for="desa"><i class="fas fa-home me-2"></i>Desa</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea name="alamat_lengkap" class="form-control" id="alamat_lengkap" style="height: 100px"
                                            placeholder="Alamat lengkap Anda" required>{{ old('WA', $profil->alamat_lengkap) }}</textarea>
                                        <label for="alamat_lengkap"><i class="fas fa-map-marker-alt me-2"></i>Alamat
                                            Lengkap</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 text-primary"><i
                                            class="fas fa-briefcase me-2"></i>Informasi Pekerjaan</h5>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" name="pekerjaan" class="form-control" id="pekerjaan"
                                            placeholder="Pekerjaan Anda" value="{{ old('WA', $profil->pekerjaan) }}" required>
                                        <label for="pekerjaan"><i class="fas fa-user-tie me-2"></i>Pekerjaan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-camera me-2"></i>Foto
                                        Profil</h5>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="image" class="form-label"><i class="fas fa-upload me-2"></i>Upload
                                            Foto
                                            (opsional)</label>
                                        <input type="file" name="image" class="form-control" id="image">
                                        <div class="form-text text-muted">Format yang didukung: JPG, PNG, GIF. Maks 2MB.
                                        </div>
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
        // Validasi Tanggal Lahir
        const tanggalLahirInput = document.getElementById("tanggal_lahir");
        const tanggalError = document.getElementById("tanggal-error");

        tanggalLahirInput.addEventListener("change", function() {
            const today = new Date();
            const dob = new Date(tanggalLahirInput.value);
            const age = today.getFullYear() - dob.getFullYear();
            const m = today.getMonth() - dob.getMonth();

            if (age < 18 || (age === 18 && m < 0)) {
                tanggalLahirInput.classList.add("is-invalid");
                tanggalError.style.display = "block";
            } else {
                tanggalLahirInput.classList.remove("is-invalid");
                tanggalError.style.display = "none";
            }
        });

        // Validasi Nomor WA
        const nomorWAInput = document.getElementById("nomorWA");

        nomorWAInput.addEventListener("input", function() {
            const value = nomorWAInput.value;
            const isValid = /^\d{12}$/.test(value);

            if (isValid) {
                nomorWAInput.classList.remove("is-invalid");
            } else {
                nomorWAInput.classList.add("is-invalid");
            }
        });
    </script>
@endsection
