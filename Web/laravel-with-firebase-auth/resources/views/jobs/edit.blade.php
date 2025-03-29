@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pekerjaan</h2>
    <form action="{{ url('jobs/'.$jobs->id.'/edit') }}" method="POST">
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
            <input type="number" name="harga_pekerjaan" class="form-control" value="{{ $jobs->harga_pekerjaan }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $jobs->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status_pekerjaan" class="form-control">
                <option value="Tersedia">Tersida</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
    </form>
</div>
@endsection
