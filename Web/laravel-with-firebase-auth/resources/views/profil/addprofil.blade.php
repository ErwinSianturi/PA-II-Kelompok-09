@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2>Tambah Profil</h2>
        <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3" style="display: none">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
            </div>

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="harga_pekerjaan" class="form-control" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required>
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
            </div>


            <div class="mb-3">
                <label>Nomor WA</label>
                <input type="text" name="WA" class="form-control" id="nomorWA" required>
                <div id="error-message" style="color: red; display: none;">Nomor WA harus terdiri dari 12 angka.</div>
            </div>

            <script>
                const nomorWAInput = document.getElementById("nomorWA");
                const errorMessage = document.getElementById("error-message");

                nomorWAInput.addEventListener("input", function() {
                    const value = nomorWAInput.value;

                    // Mengecek apakah input hanya angka dan panjangnya 12 karakter
                    const isValid = /^\d{12}$/.test(value);

                    if (isValid) {
                        errorMessage.style.display = "none"; // Menyembunyikan pesan error jika valid
                        nomorWAInput.setCustomValidity(""); // Menghapus validasi kustom
                    } else {
                        errorMessage.style.display = "block"; // Menampilkan pesan error jika tidak valid
                        nomorWAInput.setCustomValidity("Nomor WA harus terdiri dari 12 angka.");
                    }
                });
            </script>
            <div class="mb-3">
                <label>Desa</label>
                <input type="text" name="desa" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Alamat Lengkap</label>
                <textarea name="alamat_lengkap" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Foto Profil (opsional)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Tambah Profil</button>
        </form>
    </div>
@endsection
