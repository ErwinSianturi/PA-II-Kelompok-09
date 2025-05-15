@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0"><i class="fas fa-tasks me-2"></i>Manajemen Pekerjaan</h2>
            <a href="{{ url('jobs/create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Tambah Pekerjaan Baru
            </a>
        </div>

        <!-- Tabs -->
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
                        <button class="nav-link px-4 py-3" id="taken-tab" data-bs-toggle="tab" data-bs-target="#taken"
                            type="button" role="tab">
                            <i class="fas fa-check-circle me-2"></i>Apply Diterima
                            <span class="badge bg-success ms-2">{{ count($takenJobs) }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link px-4 py-3" id="ongoing-tab" data-bs-toggle="tab" data-bs-target="#ongoing"
                            type="button" role="tab">
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
                                                <img src="{{ asset($job->image1) }}" class="rounded me-3" width="60"
                                                    height="60" style="object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-0">{{ $job->nama_pekerjaan }}</h6>
                                                    <small class="text-muted">ID: #{{ $job->id }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="fw-bold">Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ ucfirst($job->status_pekerjaan) }}</span>
                                            </td>
                                            <td>{{ $job->jenis_pekerjaan }}</td>
                                            <td>{{ $job->time }}</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $job->applications->count() }}</span>
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

                    <!-- Taken Jobs Tab -->
                    <div class="tab-pane fade" id="taken" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Jenis</th>
                                        <th>Waktu</th>
                                        <th>Pemosting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($takenJobs as $job)
                                        <tr>
                                            <td class="d-flex align-items-center">
                                                <img src="{{ asset($job->image1) }}" class="rounded me-3" width="60"
                                                    height="60" style="object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-0">{{ $job->nama_pekerjaan }}</h6>
                                                    <small class="text-muted">ID: #{{ $job->id }}</small>
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
                                                <span class="badge bg-secondary">{{ $job->email }}</span>
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
                                                <img src="{{ asset($job->image1) }}" class="rounded me-3" width="60"
                                                    height="60" style="object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-0">{{ $job->nama_pekerjaan }}</h6>
                                                    <small class="text-muted">ID: #{{ $job->id }}</small>
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
                                                <span class="badge bg-secondary">{{ $job->applications->count() }}</span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <div class="btn-group">
                                                        <div class="btn-group">
                                                            @if ($job->status_pekerja != 'Bekerja')
                                                                <form action="{{ url('jobs/' . $job->id . '/start') }}"
                                                                    method="POST" id="startForm">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                                        id="startButton">Mulai</button>
                                                                </form>
                                                            @endif

                                                            <!-- Tombol Pekerjaan Selesai hanya jika status_pekerja "Bekerja" -->
                                                            @if ($job->status_pekerja == 'Bekerja')
                                                                <form action="{{ url('jobs/' . $job->id . '/finish') }}"
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
                                                <img src="{{ asset($job->image1) }}" class="rounded me-3" width="60"
                                                    height="60" style="object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-0">{{ $job->nama_pekerjaan }}</h6>
                                                    <small class="text-muted">ID: #{{ $job->id }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="fw-bold">Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ ucfirst($job->status_pekerjaan) }}</span>
                                            </td>
                                            <td>{{ $job->status }}</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $job->applications->count() }}</span>
                                            </td>
                                            <td>
                                                @if ($job->status == 'success')
                                                    <p>Sudah dibayar ke admin</p>
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
    <br><br><br><br>
    <br><br><br><br><br><br><br><br>
    <br><br>

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
