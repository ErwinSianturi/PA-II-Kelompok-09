@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Detail Pekerjaan</h2>

        <!-- Flash messages for success or error -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Carousel for Images -->
        <div id="jobImagesCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                @if($job->image1)
                    <div class="carousel-item active">
                        <img src="{{ asset($job->image1) }}" class="d-block w-100" alt="Image 1" style="object-fit: contain; height: 400px;">
                    </div>
                @else
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center align-items-center" style="height: 400px; background-color: #f0f0f0;">
                            <p class="text-muted">No image available</p>
                        </div>
                    </div>
                @endif

                @if($job->image2)
                    <div class="carousel-item">
                        <img src="{{ asset($job->image2) }}" class="d-block w-100" alt="Image 2" style="object-fit: contain; height: 400px;">
                    </div>
                @else
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center align-items-center" style="height: 400px; background-color: #f0f0f0;">
                            <p class="text-muted">No image available</p>
                        </div>
                    </div>
                @endif

                @if($job->image3)
                    <div class="carousel-item">
                        <img src="{{ asset($job->image3) }}" class="d-block w-100" alt="Image 3" style="object-fit: contain; height: 400px;">
                    </div>
                @else
                    <div class="carousel-item">
                        <div class="d-flex justify-content-center align-items-center" style="height: 400px; background-color: #f0f0f0;">
                            <p class="text-muted">No image available</p>
                        </div>
                    </div>
                @endif
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#jobImagesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#jobImagesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-3">
                    <strong>Nama Pekerjaan:</strong>
                    <p class="text-muted">{{ $job->nama_pekerjaan }}</p>
                </div>

                <div class="mb-3">
                    <strong>Email:</strong>
                    <p class="text-muted">{{ $job->email }}</p>
                </div>

                <div class="mb-3">
                    <strong>Harga Pekerjaan:</strong>
                    <p class="text-muted">{{ 'Rp. ' . number_format($job->harga_pekerjaan) }}</p>
                </div>

                <div class="mb-3">
                    <strong>Status Pekerjaan:</strong>
                    <p class="text-muted">{{ $job->status_pekerjaan }}</p>
                </div>

                <div class="mb-3">
                    <strong>Jenis Pekerjaan:</strong>
                    <p class="text-muted">{{ $job->jenis_pekerjaan }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <strong>Deskripsi:</strong>
                    <p class="text-muted">{{ $job->deskripsi }}</p>
                </div>

                <div class="mb-3">
                    <strong>Syarat dan Ketentuan:</strong>
                    <p class="text-muted">{{ $job->syarat_ketentuan }}</p>
                </div>

                <div class="mb-3">
                    <strong>Lingkup Kerja:</strong>
                    <p class="text-muted">{{ $job->lingkup_kerja }}</p>
                </div>

                <div class="mb-3">
                    <strong>Lama Pekerjaan (Jam):</strong>
                    <p class="text-muted">{{ $job->time }} Jam</p>
                </div>
                <a href="{{ url('jobs/' . $job->id . '/apply') }}">daftar ke pekerjaan ini</a>
            </div>
        </div>
    </div>
@endsection
