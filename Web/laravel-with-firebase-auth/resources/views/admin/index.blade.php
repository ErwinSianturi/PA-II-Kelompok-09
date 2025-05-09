@extends('layouts.app')

@section('content')
    <div class="admin-dashboard">
        <div class="container py-4">
            <!-- Dashboard Header -->
            <div class="dashboard-header mb-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="dashboard-title">Admin Dashboard</h1>
                        <p class="dashboard-subtitle">Management Panel | <span class="admin-email">admin@gmail.com</span></p>
                    </div>
                    <div class="col-md-6">
                        <div class="dashboard-actions text-md-end">
                            <button class="btn btn-primary"><i class="fas fa-sync-alt me-2"></i>Refresh Data</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="stats-card bg-primary text-white">
                        <div class="stats-card-body">
                            <div class="stats-card-icon"><i class="fas fa-briefcase"></i></div>
                            <div class="stats-card-content">
                                <h5 class="stats-card-title">Total Jobs</h5>
                                <p class="stats-card-value">{{ count($Jobs) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stats-card bg-success text-white">
                        <div class="stats-card-body">
                            <div class="stats-card-icon"><i class="fas fa-users"></i></div>
                            <div class="stats-card-content">
                                <h5 class="stats-card-title">Total Users</h5>
                                <p class="stats-card-value">{{ count($Profil) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stats-card bg-info text-white">
                        <div class="stats-card-body">
                            <div class="stats-card-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="stats-card-content">
                                <h5 class="stats-card-title">Completed Jobs</h5>
                                <p class="stats-card-value">{{ $Jobs->where('status', 'success')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs navigation -->
            <ul class="nav nav-tabs custom-tabs mb-3" id="adminTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab"
                        aria-controls="tab1" aria-selected="true">
                        <i class="fas fa-briefcase me-2"></i>Postingan Pekerjaan
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab"
                        aria-controls="tab2" aria-selected="false">
                        <i class="fas fa-user me-2"></i>Profil Pengguna
                    </a>
                </li>
            </ul>

            <!-- Tab content -->
            <div class="tab-content" id="adminTabsContent">
                <!-- Jobs Tab -->
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Postingan Pekerjaan</h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover custom-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Job Title</th>
                                            <th>Status</th>
                                            <th>Status Pembayaran</th>
                                            <th>Posted By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Jobs as $job)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ url('/jobs/' . $job->id . '/detail') }}" class="job-title">
                                                        {{ $job->nama_pekerjaan }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $job->status_pekerjaan == 'Active' ? 'success' : 'secondary' }}">
                                                        {{ $job->status_pekerjaan }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $job->status == 'success' ? 'success' : 'warning' }}">
                                                        {{ $job->status }}
                                                    </span>
                                                </td>
                                                <td>{{ $job->email }}</td>
                                                <td>
                                                    @if ($job->status == 'success')
                                                        <span class="text-success"><i
                                                                class="fas fa-check-circle me-1"></i>Completed</span>
                                                    @else
                                                        <a href="{{ url($job->id . '/delete') }}"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash-alt me-1"></i>Delete
                                                        </a>
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

                <!-- Users Tab -->
                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Profil Pengguna</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover custom-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Nomor Telepon</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($Profil as $profil)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar me-2">
                                                            <div
                                                                class="avatar-initial rounded-circle bg-light text-primary">
                                                                {{ substr($profil->username, 0, 1) }}
                                                            </div>
                                                        </div>
                                                        <span>{{ $profil->username }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $profil->email }}</td>
                                                <td>{{ $profil->WA }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $profil->status_akun == 'Aktif' ? 'success' : 'danger' }}">
                                                        {{ $profil->status_akun }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($profil->status_akun == 'Aktif')
                                                        <form action="{{ route('profil.setNonAktif', $profil->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-sm btn-warning">
                                                                <i class="fas fa-ban me-1"></i>Non-aktifkan
                                                            </button>
                                                        </form>
                                                    @elseif ($profil->status_akun == 'Non-Aktif')
                                                        <form action="{{ route('profil.setAktif', $profil->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-sm btn-success">
                                                                <i class="fas fa-check-circle me-1"></i>Aktifkan
                                                            </button>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Add this in the head section or before the closing body tag -->
    <style>
        /* Dashboard Styles */
        .admin-dashboard {
            background-color: #f5f8fa;
            min-height: 100vh;
        }

        .dashboard-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.2rem;
        }

        .dashboard-subtitle {
            color: #7f8c8d;
            font-size: 0.95rem;
        }

        .admin-email {
            color: #3498db;
            font-weight: 500;
        }

        /* Stats Cards */
        .stats-card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card-body {
            padding: 1.5rem;
            display: flex;
            align-items: center;
        }

        .stats-card-icon {
            background: rgba(255, 255, 255, 0.2);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
        }

        .stats-card-title {
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.8;
        }

        .stats-card-value {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        /* Custom Tabs */
        .custom-tabs {
            border-bottom: 2px solid #e9ecef;
        }

        .custom-tabs .nav-link {
            border: none;
            color: #6c757d;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            position: relative;
            transition: all 0.2s;
        }

        .custom-tabs .nav-link.active {
            color: #3498db;
            background: transparent;
        }

        .custom-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #3498db;
            border-radius: 3px 3px 0 0;
        }

        .custom-tabs .nav-link:hover:not(.active) {
            color: #495057;
            background-color: rgba(0, 123, 255, 0.05);
        }

        /* Custom Table */
        .custom-table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .custom-table thead th {
            background-color: #f8f9fa;
            border-top: none;
            border-bottom: 2px solid #e9ecef;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .custom-table tbody tr {
            transition: all 0.2s;
        }

        .custom-table tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .job-title {
            color: #3498db;
            font-weight: 500;
            text-decoration: none;
        }

        .job-title:hover {
            text-decoration: underline;
        }

        /* Avatar */
        .avatar {
            position: relative;
            width: 32px;
            height: 32px;
        }

        .avatar-initial {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Card */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
        }

        .card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .card-title {
            color: #2c3e50;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-actions {
                text-align: left;
                margin-top: 1rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-tools {
                width: 100%;
                margin-top: 0.5rem;
            }

            .custom-table {
                min-width: 650px;
            }
        }
    </style>

    <!-- Add Font Awesome CDN before closing body tag -->
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
@endsection
