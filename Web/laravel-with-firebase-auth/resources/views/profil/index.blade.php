@extends('layouts.app')

@section('content')
    <div class="container py-4">
        @php
            $profile = $profils->firstWhere('email', Auth::user()->email);
        @endphp

        @if (!$profile)
            <!-- If the profile doesn't exist, Laravel handles the redirection -->
            <script>
                window.location.href = "{{ route('addprofile') }}";
            </script>
        @else
            <div class="row">
                <!-- Profile Overview Card -->
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body d-flex flex-column flex-md-row align-items-center p-4">
                            <div class="text-center me-md-4 mb-3 mb-md-0">
                                <img src="{{ asset($profile->image ?? 'images/default-avatar.jpg') }}"
                                    class="rounded-circle shadow-sm" style="width: 120px; height: 120px; object-fit: cover;"
                                    alt="Profile Picture">

                                <div class="mt-2">
                                    <a href="{{ url('profil/' . $profile->id . '/edit') }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-pencil-alt me-1"></i> Edit Profile
                                    </a>
                                    <a class="btn btn-sm btn-outline-primary" href="home/profile">Account Setting</a>
                                </div>
                            </div>

                            <div class="flex-grow-1 text-center text-md-start">
                                <h2 class="display-6 fw-bold mb-1">{{ $profile->username }}</h2>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-envelope me-2"></i>{{ $profile->email }}
                                </p>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $profile->provinsi }} {{ $profile->desa }}
                                </p>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-calendar-alt me-2"></i>Bergabung sejak
                                    {{ $profile->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white p-0">
                    <ul class="nav nav-tabs nav-fill" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active px-4 py-3" id="about-tab" data-bs-toggle="tab"
                                data-bs-target="#about" type="button" role="tab">
                                <i class="fas fa-user me-2"></i>Tentang Saya
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 py-3" id="create-tab" data-bs-toggle="tab" data-bs-target="#create"
                                type="button" role="tab">
                                <i class="fas fa-briefcase me-2"></i>Pengalaman Kerja
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 py-3" id="education-tab" data-bs-toggle="tab"
                                data-bs-target="#education" type="button" role="tab" aria-controls="education"
                                aria-selected="false">
                                <i class="fas fa-graduation-cap me-2"></i>Pendidikan
                            </button>
                        </li>


                    </ul>
                </div>

                <!-- Tab Contents -->
                <div class="card-body p-4">
                    <div class="tab-content" id="profileTabsContent">
                        <!-- About Me Tab -->
                        <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>Informasi Dasar</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th width="40%"><i class="fas fa-user me-2"></i>Nama</th>
                                                    <td>{{ $profile->username }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-envelope me-2"></i>Email</th>
                                                    <td>{{ $profile->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-phone me-2"></i>Nomor WA</th>
                                                    <td>{{ $profile->WA }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-4 mt-md-0">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0"><i class="fas fa-map-marked-alt me-2"></i>Informasi Lokasi
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th width="40%"><i class="fas fa-map me-2"></i>Kecamatan</th>
                                                    <td>{{ $profile->kecamatan }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-city me-2"></i>Desa</th>
                                                    <td>{{ $profile->desa }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-home me-2"></i>Alamat</th>
                                                    <td>{{ $profile->alamat_lengkap }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pengalaman Kerja Tab -->
                        <div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="create-tab">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0"><i class="fas fa-briefcase me-2"></i>Pengalaman Kerja Saya</h4>
                                <a href="{{ route('pengalaman.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus-circle me-2"></i>Tambah Pengalaman
                                </a>
                            </div>

                            @if ($pengalamanKerja->isEmpty())
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>Anda belum memiliki pengalaman kerja. Silakan
                                    tambahkan pengalaman kerja Anda.
                                </div>
                            @else
                                <div class="row">
                                    @foreach ($pengalamanKerja as $kerja)
                                        <div class="col-md-6 mb-4">
                                            <div class="card shadow-sm h-100">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="card-title text-primary">{{ $kerja->position }}</h5>
                                                        <span
                                                            class="badge {{ $kerja->is_current ? 'bg-success' : 'bg-secondary' }}">
                                                            {{ $kerja->is_current ? 'Current' : 'Past' }}
                                                        </span>
                                                    </div>

                                                    <h6 class="mb-3">{{ $kerja->company_name }}</h6>

                                                    <p class="text-muted mb-2">
                                                        <i class="fas fa-map-marker-alt me-2"></i>{{ $kerja->city }},
                                                        {{ $kerja->country }}
                                                    </p>

                                                    <p class="text-muted mb-3">
                                                        <i class="fas fa-calendar-alt me-2"></i>
                                                        {{ \Carbon\Carbon::parse($kerja->start_date)->format('M Y') }} -
                                                        {{ $kerja->is_current ? 'Present' : \Carbon\Carbon::parse($kerja->end_date)->format('M Y') }}
                                                    </p>

                                                    @if ($kerja->description)
                                                        <div class="mb-3">
                                                            <p class="text-muted small">
                                                                {{ Str::limit($kerja->description, 100) }}</p>
                                                        </div>
                                                    @endif

                                                    <div class="d-flex">
                                                        <a href="{{ route('pengalaman.edit', $kerja->id) }}"
                                                            class="btn btn-sm btn-outline-warning me-2">
                                                            <i class="fas fa-edit me-1"></i>Edit
                                                        </a>

                                                        <form action="{{ route('pengalaman.destroy', $kerja->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pengalaman kerja ini?')">
                                                                <i class="fas fa-trash-alt me-1"></i>Hapus
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('pengalaman.show', $kerja->id) }}"
                                                            class="btn btn-info btn-sm">Detail</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Friends Tab -->
                        <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="mb-0"><i class="fas fa-graduation-cap me-2"></i>Jaringan Pendidikan Saya</h4>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-search me-2"></i>Temukan Institusi
                                </button>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-lg-3 mb-4">
                                    <div class="card shadow-sm text-center h-100">
                                        <div class="card-body">
                                            <img src="{{ asset('images/school1.jpg') }}" class="rounded-circle mb-3"
                                                style="width: 80px; height: 80px; object-fit: cover;" alt="School 1">
                                            <h5 class="card-title mb-1">Universitas ABC</h5>
                                            <p class="text-muted small mb-2">Pendidikan Tinggi - Fakultas Teknologi</p>
                                            <button class="btn btn-sm btn-outline-primary w-100">
                                                <i class="fas fa-university me-1"></i>Ikuti
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Placeholder for more educational institutions -->
                                <div class="col-12 mt-3">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>Fitur jaringan pendidikan masih dalam
                                        pengembangan.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Font Awesome if not already included in layout -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
