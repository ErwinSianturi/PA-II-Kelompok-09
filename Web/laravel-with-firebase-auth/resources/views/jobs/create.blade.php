@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Tambah Pekerjaan</h2>
        <form action="{{ url('jobs/create') }}" method="POST" enctype="multipart/form-data" id="jobForm">
            @csrf
            <div class="mb-3">
                <label>Nama Pekerjaan</label>
                <input type="text" name="nama_pekerjaan" class="form-control" required>
            </div>
            <div class="mb-3" style="display: none">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly required>
            </div>
            <div class="mb-3">
                <label>Harga Pekerjaan</label>
                <input type="text" id="harga_pekerjaan" name="harga_pekerjaan" class="form-control" required oninput="formatHarga(this)">
            </div>

            <script>
                // Fungsi untuk memformat input agar tampil seperti Rp. 100.000.000
                function formatHarga(input) {
                    let value = input.value.replace(/[^0-9]/g, ''); // Hapus semua karakter non-angka
                    if (value) {
                        value = parseInt(value).toLocaleString(); // Format angka dengan pemisah ribuan
                        input.value = 'Rp. ' + value; // Tambahkan prefix "Rp."
                    }
                }

                // Fungsi untuk menghapus simbol "Rp." dan mengembalikan angka murni saat form disubmit
                function cleanHarga() {
                    let input = document.getElementById('harga_pekerjaan');
                    let value = input.value.replace(/[^0-9]/g, ''); // Hapus simbol mata uang dan format lain
                    input.value = value; // Set nilai input menjadi angka saja
                }

                // Event listener untuk memastikan nilai yang dikirim adalah angka murni
                document.getElementById('jobForm').addEventListener('submit', function(event) {
                    cleanHarga(); // Bersihkan simbol mata uang sebelum form disubmit
                });
            </script>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>
            <div class="mb-3" style="display: none">
                <label>Status</label>
                <select name="status_pekerjaan" class="form-control">
                    <option value="Tersedia">Tersedia</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Jenis Pekerjaan</label>
                <select name="jenis_pekerjaan" class="form-control" required>
                    <option value="Kebersihan">Kebersihan</option>
                    <option value="Perbaikan Rumah">Perbaikan Rumah</option>
                    <option value="Perbaikan Kendaraan">Perbaikan Kendaraan</option>
                    <option value="Perbaikan Elektronik">Perbaikan Elektronik</option>
                    <option value="Tutor">Tutor</option>
                    <option value="Rumah Tangga">Rumah Tangga</option>
                    <option value="Fotografi & videografi">Fotografi & videografi</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Gambar</label>
                <input type="file" name="image" id="imageInput">
                <img id="previewImage" src="" alt="Preview" width="100" height="100" style="object-fit: cover;">
            </div>

            <script>
                document.getElementById('imageInput').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('previewImage');

                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.onload = () => URL.revokeObjectURL(preview.src); // Free memory
                    } else {
                        preview.src = '';
                    }
                });
            </script>

            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
        </form>
    </div>
@endsection
