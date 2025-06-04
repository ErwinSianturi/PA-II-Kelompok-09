@extends('layouts.app')

@section('content')

    <head>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">
                <i class="fas fa-users me-2"></i>
                Applicants for Job: <span class="text-primary">{{ $job->nama_pekerjaan }}</span>
            </h3>
            <a href="{{ url('jobs') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Status Kerja
            </a>
        </div>

        <!-- Applicants Table -->
        @if ($job->applications->isEmpty())
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-circle me-2"></i>Belum ada pendaftar ke pekerjaan ini.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <i class="fas fa-envelope me-2"></i>
                                User Email
                            </th>
                            <th>
                                <i class="fas fa-comment-dots me-2"></i>
                                Alasan (Reason)
                            </th>
                            <th class="text-center">
                                <i class="fas fa-cogs me-2"></i>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($job->applications as $application)
                            <tr>
                                <!-- User Email -->
                                <td>
                                    <span class="fw-bold">{{ $application->user_email }}</span>
                                </td>
                                <!-- Reason -->
                                <td>
                                    <p class="mb-0 text-muted">{{ $application->alasan }}</p>
                                </td>
                                <!-- Actions -->
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- View User Data -->
                                        <a href="{{ route('users.show', ['email' => $application->user_email]) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-eye me-1"></i> View User
                                        </a>
                                        <!-- Assign User Button Form with unique ID -->
                                        <form id="assign-form-{{ $application->user_email }}"
                                            action="{{ route('assign.user.job', ['jobId' => $job->id, 'userEmail' => $application->user_email]) }}"
                                            method="POST" class="assign-form">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="email_pengambil"
                                                value="{{ $application->user_email }}">
                                            <input type="hidden" name="status_pekerjaan" value="Dalam Proses">
                                            <button type="button" class="btn btn-sm btn-success assign-btn"
                                                data-form-id="assign-form-{{ $application->user_email }}">
                                                <i class="fas fa-check me-1"></i> Assign
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        // Attach event listener to all assign buttons after DOM content loaded
        document.addEventListener('DOMContentLoaded', function() {
            const assignButtons = document.querySelectorAll('.assign-btn');
            assignButtons.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const formId = btn.getAttribute('data-form-id');
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Anda ingin menerima lamaran ini?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'Yakin',
                        cancelButtonText: 'Tidak Yakin',
                        reverseButtons: true,
                        backdrop: true,
                        customClass: {
                            popup: 'swal-custom-popup',
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(formId).submit();
                        }
                    });
                });
            });
        });
    </script>
    <!-- Custom Styles -->
    <style>
        .swal-custom-popup {
            border-radius: 15px !important;
            padding: 20px !important;
        }

        .swal2-popup {
            font-size: 0.9rem !important;
        }

        .swal2-styled.swal2-confirm {
            padding: 8px 25px;
        }

        .swal2-styled.swal2-cancel {
            padding: 8px 25px;
        }

        table th,
        table td {
            vertical-align: middle;
        }

        .table th {
            text-transform: uppercase;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .table td {
            font-size: 0.95rem;
        }

        .btn-info {
            color: #fff;
        }
    </style>
@endsection
