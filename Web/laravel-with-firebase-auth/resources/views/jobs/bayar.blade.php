@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">
                <i class="fas fa-money-check-alt me-2"></i>Detail Pembayaran
            </h2>
            <a href="{{ url('jobs') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Manajemen Pekerjaan
            </a>
        </div>

        <!-- Alert Messages -->
        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <!-- Job Details -->
        <div class="row mt-4">
            <!-- Image Section -->
            <div class="col-md-4">
                <img src="{{ asset($job->image1) }}" class="img-fluid rounded shadow-sm border border-secondary-subtle"
                    alt="{{ $job->nama_pekerjaan }}">
            </div>

            <!-- Job Info Section -->
            <div class="col-md-8">
                <h3 class="fw-bold mb-3">{{ $job->nama_pekerjaan }}</h3>
                <p class="text-muted mb-2">
                    <i class="fas fa-envelope me-2"></i>Email Pengambil: <span
                        class="fw-semibold">{{ $job->email_pengambil }}</span>
                </p>
                <p class="fs-4 fw-semibold text-success mb-4">
                    <i class="fas fa-money-bill-wave me-2"></i>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}
                </p>

                <!-- Payment Button -->
                <form action="{{ route('checkout-process') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="id" value="{{ $job->id }}">
                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                    <input type="hidden" name="price" value="{{ $job->harga_pekerjaan }}">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="fas fa-cash-register me-2"></i>Bayar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        .container h3 {
            color: #333;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .alert {
            font-size: 0.95rem;
        }
    </style>
@endsection
