@extends('layouts.app')

@section('content')
    <!-- Tabs -->
    <ul class="nav nav-tabs mt-4" id="jobTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="posted-tab" data-bs-toggle="tab" data-bs-target="#posted" type="button"
                role="tab">Postingan</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="taken-tab" data-bs-toggle="tab" data-bs-target="#taken" type="button"
                role="tab">Apply Diterima</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ongoing-tab" data-bs-toggle="tab" data-bs-target="#ongoing" type="button"
                role="tab">Dalam Proses</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button"
                role="tab">Selesai</button>
        </li>
    </ul>

    <!-- Tab Contents -->
    <div class="tab-content mt-3" id="jobTabsContent">
        <!-- Tab: Pekerjaan yang Diposting -->
        <div class="tab-pane fade show active" id="posted" role="tabpanel">
            <div class="card mb-3">
                <div class="card-body">
                    <a href="{{ url('jobs/create') }}" class="btn btn-primary mb-3">Tambah Pekerjaan</a>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Gambar</th>
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
                            @foreach ($postedJobs as $job)
                                <tr>
                                    <td>
                                        @if ($job->image1)
                                            <img src="{{ asset($job->image1) }}" width="100" height="100"
                                                style="object-fit: cover;">
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
                                        <a href="{{ url('jobs/' . $job->id . '/edit') }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{ url('jobs/' . $job->id . '/delete') }}" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                                        <a href="{{ url('jobs/' . $job->id . '/applicants') }}"
                                            class="btn btn-sm btn-info">View Applicants</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab: Pekerjaan yang Diambil -->
        <div class="tab-pane fade" id="taken" role="tabpanel">
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Gambar</th>
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
                            @foreach ($takenJobs as $job)
                                <tr>
                                    <td>
                                        @if ($job->image1)
                                            <img src="{{ asset($job->image1) }}" width="100" height="100"
                                                style="object-fit: cover;">
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
                                        @if ($job->email_pengambil == Auth::user()->email)
                                            <span class="badge badge-success">Sedang Dikerjakan</span>
                                        @else
                                            <span class="badge badge-secondary">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab: Pekerjaan yang Sedang Dikerjakan -->
        <div class="tab-pane fade" id="ongoing" role="tabpanel">
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Pekerjaan</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Status Pekerja</th>
                                <th>Waktu</th>
                                <th>Email Pengambil</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ongoingJobs as $job)
                                <tr>
                                    <td>
                                        @if ($job->image1)
                                            <img src="{{ asset($job->image1) }}" width="100" height="100"
                                                style="object-fit: cover;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $job->nama_pekerjaan }}</td>
                                    <td>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ ucfirst($job->status_pekerjaan) }}</span>
                                    </td>
                                    <td>{{ $job->status_pekerja }}</td>
                                    <td>{{ $job->time }}</td>
                                    <td>{{ $job->email_pengambil }}</td>
                                    <td>
                                        <!-- Tombol Mulai hanya jika status_pekerja bukan "Bekerja" -->
                                        @if($job->status_pekerja != 'Bekerja')
                                            <form action="{{ url('jobs/' . $job->id . '/start') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-primary">Mulai</button>
                                            </form>
                                        @endif

                                        <!-- Tombol Pekerjaan Selesai hanya jika status_pekerja "Bekerja" -->
                                        @if($job->status_pekerja == 'Bekerja')
                                            <form action="{{ url('jobs/' . $job->id . '/finish') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-success">Pekerjaan Selesai</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab: Pekerjaan yang Selesai -->
        <div class="tab-pane fade" id="completed" role="tabpanel">
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Pekerjaan</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Status Pembayaran</th>
                                <th>Waktu</th>
                                <th>Jumlah Pendaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doneJobs as $job)
                                <tr>
                                    <td>
                                        @if ($job->image1)
                                            <img src="{{ asset($job->image1) }}" width="100" height="100"
                                                style="object-fit: cover;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $job->nama_pekerjaan }}</td>
                                    <td>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge badge-success">{{ ucfirst($job->status_pekerjaan) }}</span>
                                    </td>
                                    <td>{{ $job->status}}</td>
                                    <td>{{ $job->time }}</td>
                                    <td>{{ $job->applications->count() }}</td>
                                    <td>
                                        @if($job->status == 'success')
                                            <button>Sudah dibayar</button>
                                        @else
                                        <a href="{{ url('jobs/' . $job->id . '/bayar') }}"
                                            class="btn btn-sm btn-info">Bayar</a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
