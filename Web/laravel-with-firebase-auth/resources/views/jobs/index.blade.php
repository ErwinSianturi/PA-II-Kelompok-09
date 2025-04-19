@extends('layouts.app')

@section('content')



    <div class="container py-4">
        @if (Auth::check())
            <h3>Hi, {{ Auth::user()->email }}!</h3>
            <h4>Berikut daftar pekerjaan yang kamu posting</h4>
        @endif

        <a href="{{ url('jobs/create') }}" class="btn btn-primary mb-3">Tambah Pekerjaan</a>

        <!-- Tabel Pekerjaan Tersedia -->
        <h5>Pekerjaan Tersedia</h5>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Gambar 1</th>
                            <th>Nama Pekerjaan</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Waktu</th>
                            <th>Jumlah Pendaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs->where('status_pekerjaan', 'Tersedia') as $job)
                            <tr>
                                <td>
                                    @if ($job->image1)
                                        <img src="{{ asset($job->image1) }}" width="100" height="100" style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $job->nama_pekerjaan }}</td>
                                <td>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ ucfirst($job->status_pekerjaan) }}</span>
                                </td>
                                <td>{{ $job->jenis_pekerjaan }}</td>
                                <td>{{ $job->time }}</td>
                                <td>{{ $job->applications->count() }}</td>
                                <td>
                                    <a href="{{ url('jobs/' . $job->id . '/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ url('jobs/' . $job->id . '/delete') }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                                    <a href="{{ url('jobs/' . $job->id . '/applicants') }}" class="btn btn-sm btn-info">View Applicants</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Pekerjaan Dalam Proses -->
        <h5>Pekerjaan Dalam Proses</h5>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Gambar 1</th>
                            <th>Nama Pekerjaan</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Waktu</th>
                            <th>Jumlah Pendaftar</th>
                            <th>Email Pengambil</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs->where('status_pekerjaan', 'Dalam Proses') as $job)
                            <tr>
                                <td>
                                    @if ($job->image1)
                                        <img src="{{ asset($job->image1) }}" width="100" height="100" style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $job->nama_pekerjaan }}</td>
                                <td>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-warning">{{ ucfirst($job->status_pekerjaan) }}</span>
                                </td>
                                <td>{{ $job->jenis_pekerjaan }}</td>
                                <td>{{ $job->time }}</td>
                                <td>{{ $job->applications->count() }}</td>
                                <td>{{ $job->email_pengambil }}</td>
                                <td>
                                    Mulai pekerjaan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabel Pekerjaan Selesai -->
        <h5>Pekerjaan Selesai</h5>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Gambar 1</th>
                            <th>Nama Pekerjaan</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Waktu</th>
                            <th>Jumlah Pendaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs->where('status_pekerjaan', 'Selesai') as $job)
                            <tr>
                                <td>
                                    @if ($job->image1)
                                        <img src="{{ asset($job->image1) }}" width="100" height="100" style="object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $job->nama_pekerjaan }}</td>
                                <td>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-success">{{ ucfirst($job->status_pekerjaan) }}</span>
                                </td>
                                <td>{{ $job->jenis_pekerjaan }}</td>
                                <td>{{ $job->time }}</td>
                                <td>{{ $job->applications->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
    </div>
@endsection
