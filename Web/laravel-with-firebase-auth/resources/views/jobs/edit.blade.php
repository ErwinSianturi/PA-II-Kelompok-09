@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Pekerjaan</h2>
        <form action="{{ url('jobs/' . $jobs->id . '/edit') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama Pekerjaan</label>
                <input type="text" name="nama_pekerjaan" class="form-control" value="{{ $jobs->nama_pekerjaan }}" required>
            </div>
            <div class="mb-3" style="display: none">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $jobs->email }}" required>
            </div>
            <div class="mb-3">
                <label>Harga Pekerjaan</label>
                <input type="number" name="harga_pekerjaan" class="form-control" value="{{ $jobs->harga_pekerjaan }}"
                    required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required>{{ $jobs->deskripsi }}</textarea>
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status_pekerjaan" class="form-control">
                    <option value="Tersedia" {{ $jobs->status_pekerjaan == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Tidak Tersedia" {{ $jobs->status_pekerjaan == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak
                        Tersedia</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Gambar</label>
                <input type="file" name="image" id="imageInput">

                <!-- Show old image from DB initially -->
                <img id="previewImage" src="{{ asset($jobs->image) }}" alt="Preview" width="100" height="100"
                    style="object-fit: cover;">
            </div>

            <script>
                document.getElementById('imageInput').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('previewImage');

                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.onload = () => URL.revokeObjectURL(preview.src); // Free memory
                    }
                });
            </script>



            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
        </form>
    </div>
@endsection
