@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <title>Detail Pekerjaan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap 5 CDN -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
        <!-- Roboto font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                background-color: #fff;
                color: #273041;
            }

            .page-title {
                font-size: 2.3rem;
                font-weight: 700;
                color: #9333ea;
                letter-spacing: 0.5px;
            }

            .job-card {
                background: #f1e6fe;
                border-radius: 1rem;
                box-shadow: 0 8px 32px rgba(74, 144, 226, 0.10);
                padding: 2rem 2.5rem;
                margin-top: 2rem;
            }

            .carousel {
                border-radius: 1rem;
                overflow: hidden;
                margin-bottom: 2rem;
                box-shadow: 0 4px 16px rgba(74, 144, 226, 0.10);
            }

            .carousel-item img {
                object-fit: contain;
                height: 380px;
                background-color: #f5f8fa;
                border-radius: 1rem;
            }

            .carousel-indicators [data-bs-target] {
                background-color: #c44ae2;
            }

            .alert {
                border-radius: 0.7rem;
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }

            .section-label {
                color: #9333ea;
                font-weight: 600;
                font-size: 1rem;
                letter-spacing: 0.05em;
                margin-bottom: 0.2rem;
            }

            .value-text {
                font-size: 1.09rem;
                color: #273041;
                margin-bottom: 1.2rem;
                word-break: break-word;
            }

            .apply-link {
                display: inline-block;
                font-weight: 600;
                background: #3ea11c;
                color: #fff !important;
                padding: 0.65rem 1.35rem;
                border-radius: 5px;
                font-size: 1.06rem;
                letter-spacing: 0.05em;
                text-decoration: none;
                box-shadow: 0 2px 8px rgba(245, 166, 35, 0.12);
                transition: background 0.18s, box-shadow 0.18s;

            }

            .Link_Kembali {
                display: inline-block;
                font-weight: 600;
                background: #33302c;
                color: #fff !important;
                padding: 0.65rem 1.35rem;
                border-radius: 5px;
                font-size: 1.06rem;
                letter-spacing: 0.05em;
                text-decoration: none;
                box-shadow: 0 2px 8px rgba(245, 166, 35, 0.12);
                transition: background 0.18s, box-shadow 0.18s;
            }

            .Negotiate {
                display: inline-block;
                font-weight: 600;
                background: #237480;
                color: #fff !important;
                padding: 0.65rem 1.35rem;
                border-radius: 5px;
                font-size: 1.06rem;
                letter-spacing: 0.05em;
                text-decoration: none;
                box-shadow: 0 2px 8px rgba(245, 166, 35, 0.12);
                transition: background 0.18s, box-shadow 0.18s;
            }

            .apply-link:hover,
            .apply-link:focus {
                background: #e88e0b;
                box-shadow: 0 4px 24px rgba(245, 166, 35, 0.22);
                color: #fff;
                text-decoration: none;
            }

            .unavailable-msg,
            .admin-msg {
                color: #b84141;
                font-size: 1rem;
                font-weight: 500;
                margin-top: 1.2rem;
            }

            @media (max-width: 768px) {
                .job-card {
                    padding: 1rem 1rem;
                }

                .carousel-item img,
                .carousel-item>div {
                    height: 250px !important;
                }
            }

            .no-image-container {
                height: 380px;
                background-color: #f0f0f0;
                display: flex;
                justify-content: center;
                align-items: center;
                color: #aaa;
                font-size: 1.25rem;
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                filter: drop-shadow(0 2px 4px #00aaff);
                background-size: 100% 100%;
            }
        </style>
    </head>

    <body>
        <div class="container my-5">
            <h1 class="page-title mb-4">Detail Pekerjaan</h1>

            <!-- Flash messages for success or error -->
            @if (session('error'))
                <div class="alert alert-danger" role="alert" aria-live="assertive">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" role="alert" aria-live="polite">
                    {{ session('success') }}
                </div>
            @endif

            <div class="job-card shadow-sm">

                <!-- Carousel for Images -->
                <div id="jobImagesCarousel" class="carousel slide" data-bs-ride="carousel" aria-label="Gambar pekerjaan">
                    <div class="carousel-inner">
                        @foreach (['image1', 'image2', 'image3'] as $idx => $img)
                            @if ($job->$img)
                                <div class="carousel-item @if ($idx === 0) active @endif">
                                    <img src="{{ asset($job->$img) }}" class="d-block w-100"
                                        alt="Gambar {{ $idx + 1 }}" style="object-fit: contain; height: 380px;">
                                </div>
                            @else
                                <div class="carousel-item @if ($idx === 0) active @endif">
                                    <div class="no-image-container" role="img" aria-label="Tidak ada gambar">
                                        <span class="text-muted">Gambar tidak tersedia</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#jobImagesCarousel"
                        data-bs-slide="prev" aria-label="Gambar sebelumnya">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#jobImagesCarousel"
                        data-bs-slide="next" aria-label="Gambar selanjutnya">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Selanjutnya</span>
                    </button>
                </div>

                <div class="row gx-4 gy-4">
                    <div class="col-lg-6 col-md-6 border-end border-2">
                        <div>
                            <div class="section-label">Nama Pekerjaan</div>
                            <div class="value-text">{{ $job->nama_pekerjaan }}</div>
                        </div>

                        <div>
                            <div class="section-label">Email</div>
                            <div class="value-text">{{ $job->email }}</div>
                        </div>

                        <div>
                            <div class="section-label">Harga Pekerjaan</div>
                            <div class="value-text">{{ 'Rp. ' . number_format($job->harga_pekerjaan) }}</div>
                        </div>

                        <div>
                            <div class="section-label">Status Pekerjaan</div>
                            <div class="value-text">{{ $job->status_pekerjaan }}</div>
                        </div>

                        <div>
                            <div class="section-label">Jenis Pekerjaan</div>
                            <div class="value-text">{{ $job->jenis_pekerjaan }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div>
                            <div class="section-label">Deskripsi</div>
                            <div class="value-text">{{ $job->deskripsi }}</div>
                        </div>
                        <div>
                            <div class="section-label">Syarat &amp; Ketentuan</div>
                            <div class="value-text">{{ $job->syarat_ketentuan }}</div>
                        </div>
                        <div>
                            <div class="section-label">Lokasi</div>
                            <div class="value-text">{{ $job->lokasi }}</div>
                        </div>
                        <div>
                            <div class="section-label">Lama Pekerjaan (Jam)</div>
                            <div class="value-text">{{ $job->time }} Jam</div>
                        </div>
                        <!-- Status conditional rendering -->
                        @if (auth()->user()->email === 'admin@gmail.com')
                            <div class="admin-msg" role="alert" aria-live="polite">
                                Admin tidak dapat melamar pekerjaan ini.
                            </div>
                        @elseif($job->status_pekerjaan == 'Tersedia')
                            <a href="{{ url('jobs/' . $job->id . '/apply') }}" class="apply-link" role="button"
                                aria-label="Daftar ke pekerjaan ini">
                                Daftar ke pekerjaan ini
                            </a>
                        @else
                            <div class="unavailable-msg" role="alert" aria-live="polite">
                                Pekerjaan ini tidak tersedia untuk dilamar.
                            </div>
                        @endif
                        <a href="{{ route('chat', ['userEmail' => $job->email]) }}" class="Negotiate">Negosiasi</a>

                        <a href="{{ url()->previous() }}" class="Link_Kembali">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS (for carousel functionality) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
@endsection
