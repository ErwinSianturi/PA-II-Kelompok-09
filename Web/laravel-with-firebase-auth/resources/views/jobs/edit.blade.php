@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pekerjaan</h2>
    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Pekerjaan</label>
            <input type="text" name="nama_pekerjaan" class="form-control" value="{{ $job->nama_pekerjaan }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $job->email }}" required>
        </div>
        <div class="mb-3">
            <label>Harga Pekerjaan</label>
            <input type="number" name="harga_pekerjaan" class="form-control" value="{{ $job->harga_pekerjaan }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ $job->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status_pekerjaan" class="form-control">
                <option value="open" {{ $job->status_pekerjaan == 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ $job->status_pekerjaan == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
