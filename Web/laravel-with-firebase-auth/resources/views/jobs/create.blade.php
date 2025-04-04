@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Tambah Pekerjaan</h2>
        <form action="{{ url('jobs/create') }}" method="POST" enctype="multipart/form-data">
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
                <input type="number" name="harga_pekerjaan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>
            <div class="mb-3" style="display: none">
                <label>Status</label>
                <select name="status_pekerjaan" class="form-control">
                    <option value="Tersedia">Tersida</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Gambar</label>
                <input type="text" name="name">
                <input type="file" name="image">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
        </form>
    </div>
@endsection
