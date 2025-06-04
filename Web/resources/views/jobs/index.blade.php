@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0"><i class="fas fa-tasks me-2"></i>Manajemen Pekerjaan</h2>
            <a href="{{ url('jobs/create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Posting Pekerjaan
            </a>
        </div>
        <div class="container mt-5">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="mainTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="manage-jobs-tab" data-bs-toggle="tab" href="#manage-jobs" role="tab"
                        aria-controls="manage-jobs" aria-selected="true">
                        Manajemen Pekerjaan
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="taken-jobs-tab" data-bs-toggle="tab" href="#taken-jobs" role="tab"
                        aria-controls="taken-jobs" aria-selected="false">
                        Status Pekerjaan Diambil
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content mt-3" id="mainTabsContent">
                {{-- Yang Di Post --}}
                <div class="tab-pane fade show active" id="manage-jobs" role="tabpanel" aria-labelledby="manage-jobs-tab">
                    <h3>Daftar Pekerjaan yang Kamu Posting</h3>
                    <div style="height: 20px"></div>
                    <div class="card shadow-sm">
                        <div class="card-header bg-white p-0">
                            <ul class="nav nav-tabs nav-fill" id="jobTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active px-4 py-3" id="posted-tab" data-bs-toggle="tab"
                                        data-bs-target="#posted" type="button" role="tab">
                                        <i class="fas fa-clipboard-list me-2"></i>Postingan
                                        <span class="badge bg-primary ms-2">{{ count($postedJobs) }}</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-4 py-3" id="ongoing-tab" data-bs-toggle="tab"
                                        data-bs-target="#ongoing" type="button" role="tab">
                                        <i class="fas fa-spinner me-2"></i>Dalam Proses
                                        <span class="badge bg-warning ms-2">{{ count($ongoingJobs) }}</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-4 py-3" id="completed-tab" data-bs-toggle="tab"
                                        data-bs-target="#completed" type="button" role="tab">
                                        <i class="fas fa-flag-checkered me-2"></i>Selesai
                                        <span class="badge bg-info ms-2">{{ count($doneJobs) }}</span>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body p-4">
                            <div class="tab-content" id="jobTabsContent">
                                <!-- Posted Jobs Tab -->
                                <div class="tab-pane fade show active" id="posted" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <th>Harga</th>
                                                    <th>Status</th>
                                                    <th>Jenis</th>
                                                    <th>Waktu</th>
                                                    <th>Pendaftar</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($postedJobs as $job)
                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img src="{{ asset($job->image1) }}" class="rounded me-3"
                                                                width="60" height="60" style="object-fit: cover;">
                                                            <div>
                                                                <h6 class="mb-0">{{ $job->nama_pekerjaan }}</h6>
                                                                <small class="text-muted">ID:
                                                                    #{{ $job->id }}</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="fw-bold">Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge bg-primary">{{ ucfirst($job->status_pekerjaan) }}</span>
                                                        </td>
                                                        <td>{{ $job->jenis_pekerjaan }}</td>
                                                        <td>{{ $job->time }}</td>
                                                        <td>
                                                            <span
                                                                class="badge bg-secondary">{{$job->applications->count()}}</span>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ url('jobs/' . $job->id . '/edit') }}"
                                                                    class="btn btn-sm btn-outline-warning">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="{{ url('jobs/' . $job->id . '/applicants') }}"
                                                                    class="btn btn-sm btn-outline-info">
                                                                    <i class="fas fa-users"></i>
                                                                </a>
                                                                <a href="{{ url('jobs/' . $job->id . '/delete') }}"
                                                                    class="btn btn-sm btn-outline-danger"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pekerjaan ini?')">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <i class="fas fa-clipboard fa-3x mb-3"></i>
                                                                <p>Belum ada pekerjaan yang diposting</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Ongoing Jobs Tab -->
                                <div class="tab-pane fade" id="ongoing" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <th>Harga</th>
                                                    <th>Status</th>
                                                    <th>Jenis</th>
                                                    <th>Waktu</th>
                                                    <th>Pendaftar</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($ongoingJobs as $job)
                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img src="{{ asset($job->image1) }}" class="rounded me-3"
                                                                width="60" height="60" style="object-fit: cover;">
                                                            <div>
                                                                <h6 class="mb-0">{{ $job->nama_pekerjaan }}</h6>
                                                                <small class="text-muted">ID:
                                                                    #{{ $job->id }}</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="fw-bold">Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge bg-success">{{ ucfirst($job->status_pekerjaan) }}</span>
                                                        </td>
                                                        <td>{{ $job->jenis_pekerjaan }}</td>
                                                        <td>{{ $job->time }}</td>
                                                        <td>
                                                            <span
                                                                class="badge bg-secondary">{{ $job->applications->count() }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <div class="btn-group">
                                                                    <div class="btn-group">
                                                                        @if ($job->status_pekerja != 'Bekerja')
                                                                            <form
                                                                                action="{{ url('jobs/' . $job->id . '/start') }}"
                                                                                method="POST" id="startForm">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <button type="submit"
                                                                                    class="btn btn-sm btn-primary"
                                                                                    id="startButton">Mulai</button>
                                                                            </form>
                                                                        @endif

                                                                        <!-- Tombol Pekerjaan Selesai hanya jika status_pekerja "Bekerja" -->
                                                                        @if ($job->status_pekerja == 'Bekerja')
                                                                            <form
                                                                                action="{{ url('jobs/' . $job->id . '/finish') }}"
                                                                                method="POST" id="finishForm">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <button type="submit"
                                                                                    class="btn btn-sm btn-success">Pekerjaan
                                                                                    Selesai</button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <i class="fas fa-clipboard fa-3x mb-3"></i>
                                                                <p>Belum ada pekerjaan yang diterima</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Completed Jobs Tab -->
                                <div class="tab-pane fade" id="completed" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <th>Harga</th>
                                                    <th>Status</th>
                                                    <th>Status Pembayaran</th>
                                                    <th>Pekerja</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($doneJobs as $job)
                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <img src="{{ asset($job->image1) }}" class="rounded me-3"
                                                                width="60" height="60" style="object-fit: cover;">
                                                            <div>
                                                                <h6 class="mb-0">{{ $job->nama_pekerjaan }}</h6>
                                                                <small class="text-muted">ID:
                                                                    #{{ $job->id }}</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="fw-bold">Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge bg-info">{{ ucfirst($job->status_pekerjaan) }}</span>
                                                        </td>
                                                        <td>{{ $job->status }}</td>
                                                        <td>
                                                            <span
                                                                class="badge bg-secondary">{{ $job->email_pengambil }}</span>
                                                        </td>
                                                        <td>
                                                            @if ($job->status == 'success')
                                                                <p>Telah Dibayar</p>
                                                            @else
                                                                <div class="btn-group">
                                                                    <a href="{{ url('jobs/' . $job->id . '/bayar') }}"
                                                                        class="btn btn-sm btn-info">Bayar</a>
                                                                </div>
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <i class="fas fa-clipboard fa-3x mb-3"></i>
                                                                <p>Belum ada pekerjaan yang selesai</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Yang Di Ambil --}}
                <div class="tab-pane fade" id="taken-jobs" role="tabpanel" aria-labelledby="taken-jobs-tab">
                    <h3>Daftar Pekerjaan yang Kamu Ambil</h3>
                    <div style="height: 20px"></div>
                    <div class="card shadow-sm">
                        <div class="card-header bg-white p-0">
                            <ul class="nav nav-tabs nav-fill" id="takenJobTabs" role="tablist">
                                <!-- Apply yang diterima -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active px-4 py-3" id="applied-tab" data-bs-toggle="tab"
                                        data-bs-target="#applied" type="button" role="tab" aria-controls="applied"
                                        aria-selected="true">
                                        <i class="fas fa-check-circle me-2"></i>Lamaran Anda
                                        <span
                                            class="badge bg-primary ms-2">{{ $apply->isEmpty() ? 0 : $apply->count() }}</span>
                                    </button>
                                </li>
                                <!-- Dalam proses -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-4 py-3" id="dalam-proses-tab" data-bs-toggle="tab"
                                        data-bs-target="#dalam-proses" type="button" role="tab"
                                        aria-controls="dalam-proses" aria-selected="false">
                                        <i class="fas fa-spinner me-2"></i>Dalam proses

                                        <span
                                            class="badge bg-warning ms-2">{{ $jobdikerjakan->isEmpty() ? 0 : $jobdikerjakan->count() }}</span>

                                    </button>
                                </li>
                                <!-- Riwayat Pekerjaan -->
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-4 py-3" id="riwayat-pekerjaan-tab" data-bs-toggle="tab"
                                        data-bs-target="#riwayat-pekerjaan" type="button" role="tab"
                                        aria-controls="riwayat-pekerjaan" aria-selected="false">
                                        <i class="fas fa-history me-2"></i>Riwayat Pekerjaan

                                        <span
                                            class="badge bg-info ms-2">{{ $jobselesai->isEmpty() ? 0 : $jobselesai->count() }}</span>

                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content" id="takenJobTabsContent">
                                {{-- Apply yang diterima --}}
                                <div class="tab-pane fade show active" id="applied" role="tabpanel"
                                    aria-labelledby="applied-tab">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nama Pekerjaan</th>
                                                    <th>Harga</th>
                                                    <th>Tanggal</th>
                                                    <th>Alasan</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($jobs as $job)
                                                    @foreach ($apply as $app)
                                                        @if ($app->job_posting_id == $job->id)
                                                            <tr>
                                                                <td>{{ $job->nama_pekerjaan }}</td>
                                                                <td>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($job->tanggaldanwaktu)->format('Y-m-d') }}
                                                                </td>
                                                                <td>{{ $app->alasan }}</td>
                                                                <td>
                                                                    @switch($app->status)
                                                                        @case('menunggu')
                                                                            <span
                                                                                class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-600 font-medium">
                                                                                Menunggu
                                                                            </span>
                                                                        @break

                                                                        @case('diterima')
                                                                            <span
                                                                                class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-600 font-medium">
                                                                                Diterima
                                                                            </span>
                                                                        @break

                                                                        @case('ditolak')
                                                                            <span
                                                                                class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-600 font-medium">
                                                                                Ditolak
                                                                            </span>
                                                                        @break
                                                                    @endswitch
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center py-4">
                                                                <div class="text-muted">
                                                                    <i class="fas fa-clipboard fa-3x mb-3"></i>
                                                                    <p>Belum ada apply yang diterima</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- Dalam proses --}}
                                    <div class="tab-pane fade" id="dalam-proses" role="tabpanel"
                                        aria-labelledby="dalam-proses-tab">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Pekerjaan</th>
                                                        <th>Harga</th>
                                                        <th>Tanggal</th>
                                                        <th>Waktu</th>
                                                        <th>Status Kerja</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($jobdikerjakan as $job)
                                                        <tr>
                                                            <td class="d-flex align-items-center">
                                                                <img src="{{ asset($job->image1) }}" class="rounded me-3"
                                                                    width="60" height="60" style="object-fit: cover;">
                                                                <div>
                                                                    <h6 class="mb-0">{{ $job->nama_pekerjaan }}</h6>
                                                                    <small class="text-muted">ID: #{{ $job->id }}</small>
                                                                </div>
                                                            </td>
                                                            <td>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($job->tanggaldanwaktu)->format('Y-m-d') }}
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($job->tanggaldanwaktu)->format('h:i A') }}
                                                            </td>


                                                            <td>{{ $job->status_pekerja }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center py-4">
                                                                <div class="text-muted">
                                                                    <i class="fas fa-clipboard fa-3x mb-3"></i>
                                                                    <p>Belum ada pekerjaan dalam proses</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{-- Riwayat Pekerjaan --}}
                                    <div class="tab-pane fade" id="riwayat-pekerjaan" role="tabpanel"
                                        aria-labelledby="riwayat-pekerjaan-tab">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Pekerjaan</th>
                                                        <th>Harga</th>
                                                        <th>Status</th>
                                                        <th>Jenis</th>
                                                        <th>Waktu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($jobselesai as $job)
                                                        <tr>
                                                            <td class="d-flex align-items-center">
                                                                <img src="{{ asset($job->image1) }}" class="rounded me-3"
                                                                    width="60" height="60" style="object-fit: cover;">
                                                                <div>
                                                                    <h6 class="mb-0">{{ $job->nama_pekerjaan }}</h6>
                                                                    <small class="text-muted">ID: #{{ $job->id }}</small>
                                                                </div>
                                                            </td>
                                                            <td>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</td>
                                                            <td><span
                                                                    class="badge bg-info">{{ ucfirst($job->status_pekerjaan) }}</span>
                                                            </td>
                                                            <td>{{ $job->jenis_pekerjaan }}</td>
                                                            <td>{{ $job->time }}</td>

                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center py-4">
                                                                <div class="text-muted">
                                                                    <i class="fas fa-clipboard fa-3x mb-3"></i>
                                                                    <p>Belum ada riwayat pekerjaan</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 200px"></div>



        <!-- Include Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Custom Styles -->
        <style>
            .nav-tabs .nav-link {
                border: none;
                color: #6c757d;
                font-weight: 500;
            }

            .nav-tabs .nav-link.active {
                color: #0d6efd;
                border-bottom: 2px solid #0d6efd;
            }

            .table img {
                border: 1px solid #dee2e6;
            }

            .btn-group .btn {
                padding: 0.25rem 0.5rem;
            }

            .badge {
                padding: 0.5em 0.75em;
            }
        </style>
    @endsection
