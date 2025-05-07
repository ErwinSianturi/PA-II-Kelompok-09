@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Pekerjaan</h2>
        <form action="{{ url('jobs/' . $jobs->id . '/edit') }}" method="POST" enctype="multipart/form-data" id="jobForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama Pekerjaan</label>
                <input type="text" name="nama_pekerjaan" class="form-control"
                    value="{{ old('nama_pekerjaan', $jobs->nama_pekerjaan) }}" required>
            </div>

            <div class="mb-3" style="display: none">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $jobs->email }}" readonly required>
            </div>

            <div class="mb-3">
                <label>Harga Pekerjaan</label>
                <input type="text" id="harga_pekerjaan" name="harga_pekerjaan" class="form-control"
                    value="{{ old('harga_pekerjaan', 'Rp. ' . number_format($jobs->harga_pekerjaan)) }}" required
                    oninput="formatHarga(this)" onblur="validateHarga(this)">
                <small id="hargaErrorMessage" class="form-text text-danger" style="display: none;">Harga harus antara 20.000
                    dan 1.000.000.000 </small>
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
                <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi', $jobs->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Syarat dan Ketentuan</label>
                <textarea name="syarat_ketentuan" class="form-control" required>{{ old('syarat_ketentuan', $jobs->syarat_ketentuan) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Lingkup Kerja</label>
                <textarea name="lingkup_kerja" class="form-control" required>{{ old('lingkup_kerja', $jobs->lingkup_kerja) }}</textarea>
            </div>

            <div class="mb-3" style="display: none">
                <label>Status</label>
                <select name="status_pekerjaan" class="form-control">
                    <option value="Tersedia" {{ $jobs->status_pekerjaan == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Jenis Pekerjaan</label>
                <select name="jenis_pekerjaan" class="form-control" required>
                    <option value="Kebersihan" {{ $jobs->jenis_pekerjaan == 'Kebersihan' ? 'selected' : '' }}>Kebersihan
                    </option>
                    <option value="Perbaikan Rumah" {{ $jobs->jenis_pekerjaan == 'Perbaikan Rumah' ? 'selected' : '' }}>
                        Perbaikan Rumah</option>
                    <option value="Perbaikan Kendaraan"
                        {{ $jobs->jenis_pekerjaan == 'Perbaikan Kendaraan' ? 'selected' : '' }}>Perbaikan Kendaraan
                    </option>
                    <option value="Perbaikan Elektronik"
                        {{ $jobs->jenis_pekerjaan == 'Perbaikan Elektronik' ? 'selected' : '' }}>Perbaikan Elektronik
                    </option>
                    <option value="Tutor" {{ $jobs->jenis_pekerjaan == 'Tutor' ? 'selected' : '' }}>Tutor</option>
                    <option value="Rumah Tangga" {{ $jobs->jenis_pekerjaan == 'Rumah Tangga' ? 'selected' : '' }}>Rumah
                        Tangga</option>
                    <option value="Fotografi & videografi"
                        {{ $jobs->jenis_pekerjaan == 'Fotografi & videografi' ? 'selected' : '' }}>Fotografi & videografi
                    </option>
                    <option value="Lainnya" {{ $jobs->jenis_pekerjaan == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Lama Pekerjaan dalam Jam</label>
                <input type="number" name="time" id="time" class="form-control"
                    value="{{ old('time', $jobs->time) }}" min="1" max="8" required>
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
            <input type="datetime-local" name="tanggaldanwaktu" id="tanggaldanwaktu" required
                value="{{ old('tanggaldanwaktu', \Carbon\Carbon::parse($jobs->tanggaldanwaktu)->format('Y-m-d\TH:i')) }}">

            <div class="mb-3">
                <label>Gambar 1</label>
                <input type="file" name="image1" id="image1Input">
                <img id="previewImage1" src="{{ asset($jobs->image1) }}" alt="Preview" width="100" height="100"
                    style="object-fit: cover;">
            </div>

            <div class="mb-3">
                <label>Gambar 2</label>
                <input type="file" name="image2" id="image2Input">
                <img id="previewImage2" src="{{ asset($jobs->image2) }}" alt="Preview" width="100" height="100"
                    style="object-fit: cover;">
            </div>

            <div class="mb-3">
                <label>Gambar 3</label>
                <input type="file" name="image3" id="image3Input">
                <img id="previewImage3" src="{{ asset($jobs->image3) }}" alt="Preview" width="100" height="100"
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
