@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pekerjaan</h2>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary">Tambah Pekerjaan</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama Pekerjaan</th>
                <th>Email</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->nama_pekerjaan }}</td>
                <td>{{ $job->email }}</td>
                <td>{{ number_format($job->harga_pekerjaan, 2) }}</td>
                <td>{{ ucfirst($job->status_pekerjaan) }}</td>
                <td>
                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
