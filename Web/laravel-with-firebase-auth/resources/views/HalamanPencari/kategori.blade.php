@extends('layouts.app')

@section('content')
    <div class="container py-4">
        @if (Auth::check())
            <h3>Hi, {{ Auth::user()->email }}! </h3>
            <h3>Semoga mendapat yang sesuai</h3>
        @endif

        <a href="{{ url('jobs/create') }}" class="btn btn-primary mb-3">Tambah Pekerjaan</a>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Pekerjaan</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td>
                                    @if ($job->image)
                                        <img src="{{ asset($job->image) }}" width="100" height="100"
                                        style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>

                                <td>{{ $job->nama_pekerjaan }}</td>
                                <td>{{ $job->deskripsi }}</td>
                                <td>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</td>
                                <td>{{$job->email}}</td>
                                <td>
                                    @php
                                        $status_classes = [
                                            'tersedia' => 'badge-primary',
                                            'dalam proses' => 'badge-warning',
                                            'selesai' => 'badge-success',
                                        ];
                                    @endphp
                                    <span class="badge {{ $status_classes[$job->status_pekerjaan] ?? 'badge-secondary' }}">
                                        {{ ucfirst($job->status_pekerjaan) }}
                                    </span>
                                </td>
                                <td>{{$job->jenis_pekerjaan}}</td>
                                <td>
                                    <a href="{{ url('jobs/' . $job->id . '/edit') }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ url('jobs/' . $job->id . '/delete') }}"
                                        class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
    </div>
@endsection
