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

                <!-- Original Job Price -->
                <p class="fs-4 fw-semibold text-success mb-2">
                    <i class="fas fa-money-bill-wave me-2"></i>Harga Pekerjaan:
                    Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}
                </p>

                <!-- Admin Fee Calculation -->
                @php
                    $adminFee = $job->harga_pekerjaan * 0.1;
                    $totalPrice = round($job->harga_pekerjaan + $adminFee); // Round the total price to the nearest integer
                @endphp
                <p class="fs-5 text-muted mb-2">
                    <i class="fas fa-info-circle me-2"></i>Biaya Admin (10%): Rp{{ number_format($adminFee, 0, ',', '.') }}
                </p>
                <p class="fs-4 fw-semibold text-danger mb-4">
                    <i class="fas fa-credit-card me-2"></i>Total Pembayaran: Rp{{ number_format($totalPrice, 0, ',', '.') }}
                </p>

                <!-- Payment Button (form submission to checkout) -->
                <form action="{{ route('checkout-process') }}" method="POST" class="mt-3">
                    @csrf
                    <input type="hidden" name="id" value="{{ $job->id }}">
                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                    <input type="hidden" name="biaya_admin" value="{{ $adminFee }}">
                    <input type="hidden" name="price" value="{{ $totalPrice }}"> <!-- Use rounded total price here -->
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
