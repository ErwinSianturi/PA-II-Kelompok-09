@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Profil</h2>
    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3" style="display: none" >
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="harga_pekerjaan" class="form-control"  required>
                <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Provinsi</label>
            <input type="text" name="provinsi" class="form-control" required>
        </div>

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

        <button type="submit" class="btn btn-primary">Simpan Profil</button>
    </form>
</div>
@endsection
