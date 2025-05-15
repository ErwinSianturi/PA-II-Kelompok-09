<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GIGNEGO - Kerja Singkat Deal Cepat</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#C194E9',
                        secondary: '#9B5DE5',
                        accent: '#00F5A0',
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Additional libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            padding-top: 80px;
            background-color: #f8fafc;
        }

        /* Navbar styles */
        .navbar-brand {
            font-weight: 700;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            position: relative;
            font-weight: 500;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #C194E9;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        /* Button styles */
        .btn-gradient {
            background: linear-gradient(45deg, #C194E9, #9B5DE5);
            color: white;
            border: none;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(155, 93, 229, 0.4);
        }

        /* Card styles */
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Footer styles */
        .footer {
            background-color: #C194E9;
            color: white;
            border-top-left-radius: 40px;
            border-top-right-radius: 40px;
        }

        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #C194E9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #9B5DE5;
        }

        /* Scroll to top button */
        .scroll-top-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 45px;
            height: 45px;
            background: #C194E9;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(155, 93, 229, 0.3);
            z-index: 999;
        }

        .scroll-top-btn.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-top-btn:hover {
            background: #9B5DE5;
            transform: translateY(-5px);
        }

        /* Mobile menu */
        .mobile-menu-overlay {
            position: fixed;
            top: 80px;
            left: 0;
            width: 100%;
            height: 0;
            background-color: white;
            overflow: hidden;
            transition: height 0.3s ease;
            z-index: 40;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .mobile-menu-overlay.open {
            height: calc(100vh - 80px);
        }

        .mobile-menu-items {
            padding: 2rem;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .mobile-menu-overlay.open .mobile-menu-items {
            opacity: 1;
        }
    </style>
</head>
<div class="admin-dashboard">
    <div class="container py-4">
        <!-- Dashboard Header -->
        <div class="dashboard-header mb-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="dashboard-title">Admin Dashboard</h1>
                    <p class="dashboard-subtitle">Management Panel | <span class="admin-email">admin@gmail.com</span>
                    </p>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </button>
                    </form>
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
            <li class="nav-item" role="penghasilan web">
                <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab"
                    aria-controls="tab3" aria-selected="false">
                    <i class="fas fa-user me-2"></i>Pendapatan
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
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" class="form-control table-search" placeholder="Search jobs...">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
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
                                                <a href="{{ url('/jobs/' . $job->id . '/detail') }}"
                                                    class="job-title">
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
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" class="form-control table-search"
                                    placeholder="Search users...">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
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
            <!-- Penghasilan TAb -->
            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
                        <h3 class="card-title mb-0 text-primary">Total Pendapatan</h3>
                        <p class="text-muted mb-0">Total Penghasilan (10% dari semua transaksi):</p>
                        <span class="badge bg-success text-white fs-5">Rp{{ number_format($jlh_penghasilan, 0, ',', '.') }}</span>
                    </div>

                    <style>
                        .card-header {
                            padding: 20px;
                        }

                        .card-title {
                            font-weight: bold;
                        }

                        .badge {
                            padding: 10px 15px;
                            font-size: 1.2em;
                        }
                    </style>

                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Additional table content can go here -->
                        </div>
                    </div>
                </div>
            </div>

            <!--end -->
        </div>
    </div>
</div>

<!-- CSS Styles -->
<style>
    /* Dashboard Styles */
    .admin-dashboard {
        background-color: #f5f8fa;
        min-height: 100vh;
        padding-top: 1.5rem;
        padding-bottom: 3rem;
    }

    .dashboard-title {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 0.2rem;
        font-size: 2rem;
    }

    .dashboard-subtitle {
        color: #7f8c8d;
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }

    .admin-email {
        color: #3498db;
        font-weight: 500;
    }

    /* Stats Cards */
    .stats-card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        overflow: hidden;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .stats-card-body {
        padding: 1.5rem;
        display: flex;
        align-items: center;
    }

    .stats-card-icon {
        background: rgba(255, 255, 255, 0.2);
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.25rem;
        font-size: 1.5rem;
        box-shadow: 0 0 0 5px rgba(255, 255, 255, 0.1);
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
        transition: all 0.3s ease;
        border-radius: 0.25rem 0.25rem 0 0;
        margin-right: 0.25rem;
    }

    .custom-tabs .nav-link.active,
    .custom-tabs .nav-link.custom-active {
        color: #3498db;
        background: transparent;
        font-weight: 600;
    }

    .custom-tabs .nav-link.active::after,
    .custom-tabs .nav-link.custom-active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #3498db;
        border-radius: 3px 3px 0 0;
        transition: all 0.3s ease;
    }

    .custom-tabs .nav-link:hover:not(.active):not(.custom-active) {
        color: #495057;
        background-color: rgba(52, 152, 219, 0.05);
        border-bottom: 1px solid rgba(52, 152, 219, 0.2);
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
        padding: 1rem 0.75rem;
    }

    .custom-table tbody tr {
        transition: all 0.3s ease;
    }

    .custom-table tbody tr:hover {
        background-color: rgba(52, 152, 219, 0.05);
    }

    .custom-table td {
        padding: 0.85rem 0.75rem;
        vertical-align: middle;
    }

    .job-title {
        color: #3498db;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .job-title:hover {
        text-decoration: underline;
        color: #2980b9;
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
        border-radius: 0.75rem;
        box-shadow: 0 0.125rem 0.375rem rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
        transition: box-shadow 0.3s ease, transform 0.2s ease;
        overflow: hidden;
    }

    .card:hover {
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.12);
    }

    .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        background-color: #fff;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        color: #2c3e50;
        font-weight: 600;
        font-size: 1.15rem;
    }

    /* Buttons */
    .btn {
        transition: all 0.3s ease;
        font-weight: 500;
        padding: 0.375rem 1rem;
    }

    .btn:active {
        transform: scale(0.97);
    }

    .btn-sm {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
    }

    /* Improved Badge Styles */
    .badge {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.5em 0.75em;
        border-radius: 0.25rem;
        font-size: 0.7rem;
    }

    /* Table Loading Effect */
    .table-loading {
        position: relative;
    }

    .table-loading::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .table-loading::before {
        content: "Loading...";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        font-weight: 600;
        color: #3498db;
    }

    /* Logout button styling */
    #logout-form button {
        transition: all 0.3s ease;
        font-weight: 500;
    }

    #logout-form button:hover {
        background-color: #dc3545;
        color: #fff;
    }

    #logout-form button:active {
        transform: scale(0.97);
    }

    /* Search input */
    .table-search {
        border-radius: 0.375rem;
        padding: 0.375rem 0.75rem;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .table-search:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
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

        .stats-card-icon {
            width: 48px;
            height: 48px;
            margin-right: 1rem;
        }
    }
</style>

<!-- Required Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap tabs
        var tabEl = document.querySelector('a[data-bs-toggle="tab"]');
        var tab = new bootstrap.Tab(tabEl);

        // Get all tab links
        const tabLinks = document.querySelectorAll('.nav-tabs .nav-link');

        // Add click event listeners to tabs for custom functionality
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Remove active class from all tabs
                tabLinks.forEach(tab => {
                    tab.classList.remove('custom-active');
                });

                // Add active class to clicked tab
                this.classList.add('custom-active');

                // Store active tab in localStorage
                localStorage.setItem('activeAdminTab', this.getAttribute('id'));
            });
        });

        // Check if there's a stored active tab
        const activeTab = localStorage.getItem('activeAdminTab');
        if (activeTab) {
            // Activate the stored tab
            const tabToActivate = document.getElementById(activeTab);
            if (tabToActivate) {
                const bsTab = new bootstrap.Tab(tabToActivate);
                bsTab.show();

                // Add custom active class
                tabLinks.forEach(tab => tab.classList.remove('custom-active'));
                tabToActivate.classList.add('custom-active');
            }
        }

        // Refresh Data button functionality
        const refreshBtn = document.querySelector('.dashboard-actions .btn-primary');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function() {
                // Add spinning animation to refresh icon
                const icon = this.querySelector('i');
                icon.classList.add('fa-spin');

                // Simulate refresh delay
                setTimeout(() => {
                    // Reload the page
                    window.location.reload();
                }, 800);
            });
        }

        // Table search functionality
        const searchInputs = document.querySelectorAll('.table-search');

        searchInputs.forEach(input => {
            input.addEventListener('keyup', function() {
                const searchText = this.value.toLowerCase();
                const tableBody = this.closest('.card').querySelector('tbody');
                const rows = tableBody.querySelectorAll('tr');

                rows.forEach(row => {
                    let found = false;
                    const cells = row.querySelectorAll('td');

                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().indexOf(searchText) >
                            -1) {
                            found = true;
                        }
                    });

                    if (found) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Add subtle hover animations to buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });

            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
