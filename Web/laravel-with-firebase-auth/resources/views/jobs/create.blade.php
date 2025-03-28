@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Tambah Pekerjaan</h2>
    <form action="{{ url('jobs/create') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Pekerjaan</label>
            <input type="text" name="nama_pekerjaan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly required>
        </div>
        <div class="mb-3">
            <label>Harga Pekerjaan</label>
            <input type="number" name="harga_pekerjaan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status_pekerjaan" class="form-control">
                <option value="Tersedia">Tersida</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
