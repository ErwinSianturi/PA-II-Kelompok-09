@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Profil</h2>
    <form action="{{ route('profile.update', $profil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3" style="display: none">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $profil->email }}">
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ $profil->username }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="harga_pekerjaan" class="form-control" required>
                <option value="Laki-laki" {{ $profil->harga_pekerjaan == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $profil->harga_pekerjaan == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $profil->tanggal_lahir }}" required>
        </div>

        <div class="mb-3">
            <label>Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="{{ $profil->provinsi }}" required>
        </div>

        <div class="mb-3">
            <label>Desa</label>
            <input type="text" name="desa" class="form-control" value="{{ $profil->desa }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat Lengkap</label>
            <textarea name="alamat_lengkap" class="form-control" required>{{ $profil->alamat_lengkap }}</textarea>
        </div>

        <div class="mb-3">
            <label>Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ $profil->pekerjaan }}" required>
        </div>

        <div class="mb-3">
            <label>Foto Profil (opsional)</label>
            <input type="file" name="image" class="form-control">
            @if ($profil->image)
                <div class="mt-2">
                    <img src="{{ asset($profil->image) }}" alt="Profile Image" width="150" height="150">
                    <p>Foto Profil Saat Ini</p>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Profil</button>
    </form>
</div>
@endsection
