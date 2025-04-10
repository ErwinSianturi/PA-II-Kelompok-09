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
            <input type="text" name="username" class="form-control" value="{{ old('username', $profil->username) }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="harga_pekerjaan" class="form-control" required>
                <option value="Laki-laki" {{ old('harga_pekerjaan', $profil->harga_pekerjaan) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('harga_pekerjaan', $profil->harga_pekerjaan) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $profil->tanggal_lahir) }}" required>
        </div>

        <div class="mb-3">
            <label>Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $profil->provinsi) }}" required>
        </div>

        <div class="mb-3">
            <label>Desa</label>
            <input type="text" name="desa" class="form-control" value="{{ old('desa', $profil->desa) }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat Lengkap</label>
            <textarea name="alamat_lengkap" class="form-control" required>{{ old('alamat_lengkap', $profil->alamat_lengkap) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $profil->pekerjaan) }}" required>
        </div>

        <div class="mb-3">
            <label>Foto Profil (opsional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Profil</button>
    </form>
</div>
@endsection
