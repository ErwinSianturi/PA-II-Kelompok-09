{{-- resources/views/jobs/bayar-standalone.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Jasa</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: .75rem;
        }

        .card-body {
            padding: 2rem;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }

        .payment-info i {
            color: #6c757d;
        }

        hr {
            margin: 1.5rem 0;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</head>

<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        @php
                            $adminFee = $product->harga_pekerjaan * 0.1;
                            $totalPrice = $product->harga_pekerjaan + $adminFee;
                        @endphp

                        <h4 class="fw-bold mb-4">Detail Pembayaran</h4>

                        <p>Anda akan membayar jasa <strong>{{ $product->nama_pekerjaan }}</strong> senilai
                            <strong>Rp{{ number_format($product->harga_pekerjaan, 0, ',', '.') }}</strong>
                        </p>

                        <div class="payment-info mb-3">
                            <p class="mb-1">
                                <i class="fas fa-info-circle me-2"></i>
                                <span>Biaya Admin (10%):</span>
                                <strong>Rp{{ number_format($adminFee, 0, ',', '.') }}</strong>
                            </p>
                            <hr>
                            <p class="fs-5 mb-0">
                                <i class="fas fa-credit-card me-2"></i>
                                <span>Total Pembayaran:</span>
                                <strong class="text-success">Rp{{ number_format($totalPrice, 0, ',', '.') }}</strong>
                            </p>
                        </div>

                        <button id="pay-button" class="btn btn-primary btn-lg px-5 mb-3">
                            <i class="fas fa-cash-register me-2"></i>Bayar Sekarang
                        </button>

                        <!-- Back to Job Status Button -->
                        <a href="{{ url('jobs') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Status Kerja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <!-- Bootstrap 5 Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            snap.pay('{{ $transaction->snap_token }}', {
                onSuccess: function(result) {
                    window.location.href = '{{ route('chekcout-success', $transaction->id) }}';
                },
                onPending: function(result) {
                    alert('Pembayaran sedang diproses, harap tunggu.');
                },
                onError: function(result) {
                    alert('Terjadi kesalahan saat pembayaran. Silakan coba lagi.');
                }
            });
        });
    </script>

</body>

</html>
