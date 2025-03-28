@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Daftar Pekerjaan</h2>
    @if(Auth::check())
    <h3>Hi, {{ Auth::user()->email }}!</h3>
    @endif

    <a href="{{ url('jobs/create') }}" class="btn btn-primary mb-3">Tambah Pekerjaan</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
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
                        <td>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $status_classes = [
                                    'tersedia' => 'badge-primary',
                                    'dalam proses' => 'badge-warning',
                                    'selesai' => 'badge-success'
                                ];
                            @endphp
                            <span class="badge {{ $status_classes[$job->status_pekerjaan] ?? 'badge-secondary' }}">
                                {{ ucfirst($job->status_pekerjaan) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ url('jobs/' . $job->id . '/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ url('jobs/' . $job->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pekerjaan ini?');">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
