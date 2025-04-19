@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Edit Profil</h2>
        <form action="{{ url('profil/' . $profil->id . '/edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3" style="display: none">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $profil->email }}" readonly>
            </div>

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username', $profil->username) }}"
                    required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="harga_pekerjaan" class="form-control" required>
                    <option value="Laki-laki"
                        {{ old('harga_pekerjaan', $profil->harga_pekerjaan) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan"
                        {{ old('harga_pekerjaan', $profil->harga_pekerjaan) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control"
                    value="{{ old('tanggal_lahir', $profil->tanggal_lahir) }}" required>
                <div id="error-message" style="color: red; display: none;">Umur Anda harus minimal 18 tahun!</div>
            </div>

            <script>
                // Mendapatkan elemen input tanggal lahir dan error message
                const tanggalLahirInput = document.getElementById("tanggal_lahir");
                const errorMessage = document.getElementById("error-message");

                // Fungsi untuk memvalidasi tanggal lahir
                tanggalLahirInput.addEventListener("change", function() {
                    const today = new Date();
                    const dob = new Date(tanggalLahirInput.value);

                    // Menghitung umur berdasarkan tanggal lahir
                    const age = today.getFullYear() - dob.getFullYear();
                    const m = today.getMonth() - dob.getMonth();

                    // Menentukan apakah umur sudah 18 tahun atau lebih
                    if (age < 18 || (age === 18 && m < 0)) {
                        errorMessage.style.display = "block"; // Menampilkan pesan error
                        tanggalLahirInput.setCustomValidity("Umur Anda harus minimal 18 tahun!");
                    } else {
                        errorMessage.style.display = "none"; // Menyembunyikan pesan error
                        tanggalLahirInput.setCustomValidity(""); // Menghapus validasi kustom
                    }
                });
            </script>

            <div class="mb-3">
                <label>Kecamatan</label>
                <select name="kecamatan" class="form-control" required>
                    <option value="Ajibata" {{ old('kecamatan', $profil->kecamatan) == 'Ajibata' ? 'selected' : '' }}>
                        Ajibata</option>
                    <option value="Balige" {{ old('kecamatan', $profil->kecamatan) == 'Balige' ? 'selected' : '' }}>Balige
                    </option>
                    <option value="Bonatua Lunasi"
                        {{ old('kecamatan', $profil->kecamatan) == 'Bonatua Lunasi' ? 'selected' : '' }}>Bonatua Lunasi
                    </option>
                    <option value="Borbor" {{ old('kecamatan', $profil->kecamatan) == 'Borbor' ? 'selected' : '' }}>Borbor
                    </option>
                    <option value="Habinsaran"
                        {{ old('kecamatan', $profil->kecamatan) == 'Habinsaran' ? 'selected' : '' }}>Habinsaran</option>
                    <option value="Laguboti" {{ old('kecamatan', $profil->kecamatan) == 'Laguboti' ? 'selected' : '' }}>
                        Laguboti</option>
                    <option value="Lumban Julu"
                        {{ old('kecamatan', $profil->kecamatan) == 'Lumban Julu' ? 'selected' : '' }}>Lumban Julu</option>
                    <option value="Nassau" {{ old('kecamatan', $profil->kecamatan) == 'Nassau' ? 'selected' : '' }}>Nassau
                    </option>
                    <option value="Parmaksian"
                        {{ old('kecamatan', $profil->kecamatan) == 'Parmaksian' ? 'selected' : '' }}>Parmaksian</option>
                    <option value="Pintu Pohan Meranti"
                        {{ old('kecamatan', $profil->kecamatan) == 'Pintu Pohan Meranti' ? 'selected' : '' }}>Pintu Pohan
                        Meranti</option>
                    <option value="Porsea" {{ old('kecamatan', $profil->kecamatan) == 'Porsea' ? 'selected' : '' }}>Porsea
                    </option>
                    <option value="Siantar Narumonda"
                        {{ old('kecamatan', $profil->kecamatan) == 'Siantar Narumonda' ? 'selected' : '' }}>Siantar
                        Narumonda</option>
                    <option value="Sigumpar" {{ old('kecamatan', $profil->kecamatan) == 'Sigumpar' ? 'selected' : '' }}>
                        Sigumpar</option>
                    <option value="Silaen" {{ old('kecamatan', $profil->kecamatan) == 'Silaen' ? 'selected' : '' }}>Silaen
                    </option>
                    <option value="Tampahan" {{ old('kecamatan', $profil->kecamatan) == 'Tampahan' ? 'selected' : '' }}>
                        Tampahan</option>
                    <option value="Uluan" {{ old('kecamatan', $profil->kecamatan) == 'Uluan' ? 'selected' : '' }}>Uluan
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label>Nomor WA</label>
                <input type="tel" name="WA" class="form-control" required pattern="^\d{12}$" title="Nomor WA harus terdiri dari 12 angka" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                <div class="invalid-feedback">Nomor WA harus terdiri dari 12 angka.</div>
            </div>

            <div class="mb-3">
                <label>Desa</label>
                <input type="text" name="desa" class="form-control" value="{{ old('desa', $profil->desa) }}"
                    required>
            </div>

            <div class="mb-3">
                <label>Alamat Lengkap</label>
                <textarea name="alamat_lengkap" class="form-control" required>{{ old('alamat_lengkap', $profil->alamat_lengkap) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control"
                    value="{{ old('pekerjaan', $profil->pekerjaan) }}" required>
            </div>

            <div class="mb-3">
                <label>Foto Profil (opsional)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Profil</button>
        </form>
    </div>
@endsection
