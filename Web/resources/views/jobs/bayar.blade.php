@extends('layouts.app')

@section('content')
    <!-- Modern Rounded Payment Card with Gradient -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        body {
            font-family: 'Inter', Arial, sans-serif !important;
        }

        .gradient-box-outer {
            background: linear-gradient(135deg, #F2E7FF 0%, #ffffff 100%);
            padding: 2.6rem 0;
            min-height: 100vh;
        }

        .gradient-payment-card {
            background: linear-gradient(120deg, #fff 85%, #ede1fa 100%);
            border-radius: 1.6rem;
            box-shadow: 0 8px 32px #a487ce18, 0 2px 8px #e1d0f380;
            border: none;
            padding: 2.2rem 2.3rem 2rem 2.3rem;
            margin-top: 2.3rem;
            margin-bottom: 2.3rem;
        }

        .gradient-payment-card .row {
            --bs-gutter-x: 2rem;
        }

        @media (max-width: 767px) {
            .gradient-payment-card {
                padding: 1rem 0.4rem 1.2rem 0.4rem;
            }

            .gradient-payment-card .row {
                --bs-gutter-x: 0.7rem;
            }
        }
    </style>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        .gradient-bg-card {
            background: linear-gradient(135deg, #F2E7FF 0%, #fff 100%);
            border-radius: 1.4rem;
            box-shadow: 0 7px 28px #b9a1d222, 0 2px 8px #e1d0f384;
            padding: 2.1rem 2.0rem 2.0rem 2.0rem;
            margin-top: 2rem;
            margin-bottom: 2.3rem;
            border: none;
        }

        @media (max-width: 767px) {
            .gradient-bg-card {
                padding: 1rem .45rem 1.2rem .45rem;
            }
        }

        .container h3 {
            color: #333;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #0b5ed7;
        }

        .alert {
            font-size: 0.95rem;
            border-radius: 1rem;
            box-shadow: 0 3px 14px #eedeff44;
            border: none;
        }

        .back-shadow {
            background: #e3dbf6;
            color: #6a4098;
            border-radius: 2.3rem;
            border: none;
        }

        .back-shadow:hover,
        .back-shadow:focus {
            background: #d1baf2;
            color: #52327f;
        }
    </style>

    <div class="container my-5">
        <div class="gradient-bg-card">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">
                    <i class="fas fa-money-check-alt me-2"></i>Detail Pembayaran
                </h2>
                <a href="{{ url('jobs') }}" class="btn back-shadow">
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
                        $adminFee = 5000;
                        $totalPrice = round($job->harga_pekerjaan + $adminFee);
                    @endphp
                    <p class="fs-5 text-muted mb-2">
                        <i class="fas fa-info-circle me-2"></i>Biaya Admin (Rp5.000):
                        Rp{{ number_format($adminFee, 0, ',', '.') }}
                    </p>
                    <p class="fs-4 fw-semibold text-danger mb-4">
                        <i class="fas fa-credit-card me-2"></i>Total Pembayaran:
                        Rp{{ number_format($totalPrice, 0, ',', '.') }}
                    </p>

                    <!-- Payment Button (form submission to checkout) -->
                    <form action="{{ route('checkout-process') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="id" value="{{ $job->id }}">
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        <input type="hidden" name="biaya_admin" value="{{ $adminFee }}">
                        <input type="hidden" name="price" value="{{ $totalPrice }}">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-cash-register me-2"></i>Bayar Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">



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
    <div style="height: 20px"></div>
@endsection
