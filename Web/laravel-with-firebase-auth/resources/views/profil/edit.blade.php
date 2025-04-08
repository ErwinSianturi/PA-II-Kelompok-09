@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Profil</h2>
    <form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3" style="display: none">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $profile->email ?? Auth::user()->email }}">
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ $profile->username }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="harga_pekerjaan" class="form-control" required>
                <option value="" disabled hidden>Pilih Jenis Kelamin</option>
                <option value="Laki-laki" {{ $profile->harga_pekerjaan == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $profile->harga_pekerjaan == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $profile->tanggal_lahir }}" required>
        </div>

        <div class="mb-3">
            <label>Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="{{ $profile->provinsi }}" required>
        </div>

        <div class="mb-3">
            <label>Desa</label>
            <input type="text" name="desa" class="form-control" value="{{ $profile->desa }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat Lengkap</label>
            <textarea name="alamat_lengkap" class="form-control" required>{{ $profile->alamat_lengkap }}</textarea>
        </div>

        <div class="mb-3">
            <label>Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ $profile->pekerjaan }}" required>
        </div>

        <div class="mb-3">
            <label>Foto Profil (biarkan kosong jika tidak diganti)</label>
            <input type="file" name="image" class="form-control">
            @if($profile->image)
                <small class="form-text text-muted">Foto saat ini:</small>
                <img src="{{ asset('storage/' . $profile->image) }}" alt="Foto Profil" width="100" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Profil</button>
    </form>
</div>
@endsection
