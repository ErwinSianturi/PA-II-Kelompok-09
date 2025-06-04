<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Jasa</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            min-height: 100vh;
            width: 100vw;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            min-width: 100vw;
            height: 100%;
            width: 100%;
            font-family: 'Inter', Arial, sans-serif;
            background: linear-gradient(135deg, #F2E7FF 0%, #ffffff 100%);
            overflow-x: hidden;
            box-sizing: border-box;
        }

        .center-container {
            min-height: 100vh;
            min-width: 100vw;
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-modern {
            border: none;
            border-radius: 1.5rem;
            background: linear-gradient(125deg, #ffffff 65%, #efe0fe 100%);
            box-shadow: 0 6px 24px 0 rgba(123, 93, 176, 0.08), 0 1.5px 4px 0 #decdff;
            transition: box-shadow .3s;
            max-width: 540px;
            min-width: 340px;
            width: 97vw;
            margin: 0 auto;
        }

        .card-modern:hover {
            box-shadow: 0 8px 32px 0 rgba(97, 57, 150, 0.15), 0 2.5px 8px 0 #cdb7ea;
        }

        .card-body {
            padding: 2.5rem 2.2rem 2rem 2.2rem;
            border-radius: 1.5rem;
            background-color: transparent;
        }

        .fw-bold,
        h4 {
            letter-spacing: .01em;
        }

        h4 {
            font-weight: 700;
            color: #6a4098;
            font-size: 1.5rem;
        }

        .payment-info {
            background: #f7f3fd;
            border-radius: 1rem;
            padding: 1rem 1.5rem;
            box-shadow: 0 1px 4px #ece5f8;
            font-size: 1.1rem;
        }

        .payment-info i {
            color: #8e59d3;
            margin-right: .5rem;
        }

        .payment-info p {
            margin-bottom: .7rem;
        }

        .payment-info .fs-5 {
            font-weight: 600;
        }

        .text-success {
            color: #15b87b !important;
        }

        #pay-button {
            background: linear-gradient(95deg, #7a54dd, #cc82fa);
            border: none;
            padding: 0.85rem 2.6rem;
            font-size: 1.18rem;
            font-weight: 600;
            border-radius: 2.8rem;
            color: white;
            box-shadow: 0 2px 12px rgba(147, 144, 250, 0.13);
            transition: background .18s, transform .14s, box-shadow .25s;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            margin: 0 auto 1.1rem auto;
            position: relative;
            min-height: 48px;
        }

        #pay-button:disabled {
            background: #e3dbf6 !important;
            color: #e9d9fe !important;
            cursor: not-allowed;
        }

        #pay-button:hover:not(:disabled),
        #pay-button:focus-visible:not(:disabled) {
            background: linear-gradient(85deg, #6b2dc7, #ad49f0);
            transform: translateY(-2px) scale(1.015);
            box-shadow: 0 3px 18px 0 #c5aefa44;
        }

        .spinner {
            width: 1.6em;
            height: 1.6em;
            border: 4px solid #efe0fe;
            border-top: 4px solid #7a54dd;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 0.5rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        a.btn-secondary {
            font-size: 1.1rem;
            padding: 0.7rem 2.15rem;
            border-radius: 2.8rem;
            margin-top: .25rem;
            background: #d5c2f4;
            color: #59397a;
            border: none;
            transition: background .19s;
        }

        a.btn-secondary:hover,
        a.btn-secondary:focus {
            background: #c1a7ea;
            color: #3a2359;
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 1.2rem 0.35rem 1.2rem 0.35rem;
            }

            .payment-info {
                padding: 0.7rem 0.7rem;
            }

            .card-modern {
                max-width: 98vw;
                min-width: unset;
            }
        }
    </style>
</head>

<body>
    <div class="center-container">
        <div class="card card-modern shadow-sm">
            <div class="card-body text-center">
                <!--
                @php
                    $adminFee = 5000;
                    $totalPrice = $product->harga_pekerjaan + $adminFee;
                @endphp
                -->
                <h4 class="fw-bold mb-3">Detail Pembayaran</h4>
                <p class="mb-4 lead">Anda akan membayar jasa <span class="fw-bold">{{ $product->nama_pekerjaan }}</span>
                    senilai <span
                        class="text-primary fw-bold">Rp{{ number_format($product->harga_pekerjaan, 0, ',', '.') }}</span>
                </p>
                <div class="payment-info mb-4 text-start mx-auto" style="max-width: 350px;">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        Biaya Admin (Rp5.000): <span
                            class="fw-bold">Rp{{ number_format($adminFee ?? 5000, 0, ',', '.') }}</span>
                    </p>
                    <hr>
                    <p class="fs-5">
                        <i class="fas fa-credit-card"></i>
                        Total Pembayaran:
                        <span
                            class="text-success">Rp{{ number_format($totalPrice ?? $product->harga_pekerjaan + 5000, 0, ',', '.') }}</span>
                    </p>
                </div>
                <button id="pay-button" class="btn btn-primary btn-lg px-5 mb-3">
                    <i class="fas fa-cash-register me-2"></i>
                    <span id="pay-text">Bayar Sekarang</span>
                </button>
                <a href="{{ url('jobs') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Status Kerja
                </a>
            </div>
        </div>
    </div>
    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const payBtn = document.getElementById('pay-button');
        const payText = document.getElementById('pay-text');

        function setLoading(state) {
            if (state) {
                payBtn.disabled = true;
                if (!document.getElementById('btn-spinner')) {
                    const spinner = document.createElement('span');
                    spinner.className = 'spinner';
                    spinner.id = 'btn-spinner';
                    payBtn.insertBefore(spinner, payBtn.firstChild);
                }
                payText.textContent = "Memproses...";
            } else {
                payBtn.disabled = false;
                const spinner = document.getElementById('btn-spinner');
                if (spinner) spinner.remove();
                payText.textContent = "Bayar Sekarang";
            }
        }
        payBtn.addEventListener('click', function() {
            setLoading(true);
            snap.pay('{{ $transaction->snap_token }}', {
                onSuccess: function(result) {
                    setLoading(false);
                    window.location.href = '{{ route('chekcout-success', $transaction->id) }}';
                },
                onPending: function(result) {
                    setLoading(false);
                    Swal.fire({
                        icon: 'info',
                        title: 'Pembayaran Pending',
                        text: 'Pembayaran sedang diproses, harap tunggu konfirmasi.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        backdrop: true,
                        customClass: {
                            popup: 'swal2-md'
                        },
                        timer: 5000
                    });
                },
                onError: function(result) {
                    setLoading(false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat pembayaran. Silakan coba lagi.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        backdrop: true,
                        customClass: {
                            popup: 'swal2-md'
                        }
                    });
                },
                onClose: function() {
                    setLoading(false);
                }
            });
        });
    </script>
</body>

</html>
