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
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly
                    required>
            </div>

            <div class="mb-3">
                <label>Harga Pekerjaan</label>
                <input type="text" id="harga_pekerjaan" name="harga_pekerjaan" class="form-control" required
                    oninput="formatHarga(this)" onblur="validateHarga(this)">
                <small id="hargaErrorMessage" class="form-text text-danger" style="display: none;">Harga harus antara 20.000
                    dan 2.000.000.</small>
            </div>

            <script>
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

                document.getElementById('jobForm').addEventListener('submit', function(event) {
                    cleanHarga();
                });
            </script>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Syarat dan Ketentuan</label>
                <textarea name="syarat_ketentuan" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Lingkup Kerja</label>
                <textarea name="lingkup_kerja" class="form-control" required></textarea>
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
                <label>Lama Pekerjaan dalam Jam</label>
                <input type="number" name="time" id="time" class="form-control" max="8" required>
                <small id="timeErrorMessage" class="form-text text-danger" style="display: none;">Waktu tidak bisa lebih
                    dari 8 jam.</small>
            </div>

            <script>
                document.getElementById('time').addEventListener('input', function(event) {
                    const timeInput = event.target;
                    const errorMessage = document.getElementById('timeErrorMessage');
                    if (timeInput.value > 8) {
                        timeInput.value = 8;
                        errorMessage.style.display = 'block';
                    } else {
                        errorMessage.style.display = 'none';
                    }
                });
            </script>

            <label for="tanggaldanwaktu">Date and Time</label>
            <input type="datetime-local" name="tanggaldanwaktu" id="tanggaldanwaktu" required>

            <div class="mb-3">
                <label>Gambar 1</label>
                <input type="file" name="image1" id="image1Input">
                <img id="previewImage1" src="" alt="Preview" width="100" height="100"
                    style="object-fit: cover;">
            </div>

            <div class="mb-3">
                <label>Gambar 2</label>
                <input type="file" name="image2" id="image2Input">
                <img id="previewImage2" src="" alt="Preview" width="100" height="100"
                    style="object-fit: cover;">
            </div>

            <div class="mb-3">
                <label>Gambar 3</label>
                <input type="file" name="image3" id="image3Input">
                <img id="previewImage3" src="" alt="Preview" width="100" height="100"
                    style="object-fit: cover;">
            </div>

            <script>
                document.getElementById('image1Input').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('previewImage1');
                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.onload = () => URL.revokeObjectURL(preview.src);
                    } else {
                        preview.src = '';
                    }
                });

                document.getElementById('image2Input').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('previewImage2');
                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.onload = () => URL.revokeObjectURL(preview.src);
                    } else {
                        preview.src = '';
                    }
                });

                document.getElementById('image3Input').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('previewImage3');
                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.onload = () => URL.revokeObjectURL(preview.src);
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
