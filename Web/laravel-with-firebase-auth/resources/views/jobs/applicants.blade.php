@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">
            <i class="fas fa-users me-2"></i>
            Applicants for Job: <span class="text-primary">{{ $job->nama_pekerjaan }}</span>
        </h3>
        <a href="{{ url('jobs') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Job Management
        </a>
    </div>

    <!-- Applicants Table -->
    @if ($job->applications->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="fas fa-exclamation-circle me-2"></i>No applicants for this job yet.
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
                                    <a href="{{ route('users.show', ['email' => $application->user_email]) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye me-1"></i> View User
                                    </a>

                                    <!-- Assign User Button -->
                                    <form action="{{ route('assign.user.job', ['jobId' => $job->id, 'userEmail' => $application->user_email]) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="email_pengambil" value="{{ $application->user_email }}">
                                        <input type="hidden" name="status_pekerjaan" value="Dalam Proses">
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to assign this user?')">
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

<!-- Custom Styles -->
<style>
    table th, table td {
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
