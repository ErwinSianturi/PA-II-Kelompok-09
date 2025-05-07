@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="fas fa-briefcase me-2"></i>Detail Pengalaman Kerja</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-building me-2"></i>Informasi Perusahaan</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Posisi:</strong> {{ $pengalamanKerja->position }}
                            </div>
                            <div class="col-md-6">
                                <strong>Nama Perusahaan:</strong> {{ $pengalamanKerja->company_name }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Negara:</strong> {{ $pengalamanKerja->country }}
                            </div>
                            <div class="col-md-6">
                                <strong>Kota:</strong> {{ $pengalamanKerja->city }}
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-calendar-alt me-2"></i>Periode Kerja</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($pengalamanKerja->start_date)->format('Y-m-d') }}
                            </div>
                            <div class="col-md-6">
                                <strong>Tanggal Selesai:</strong>
                                @if($pengalamanKerja->is_current)
                                    <span>Masih Bekerja</span>
                                @else
                                    {{ \Carbon\Carbon::parse($pengalamanKerja->end_date)->format('Y-m-d') }}
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Status Pekerjaan:</strong>
                                @if($pengalamanKerja->is_current)
                                    <span>Saya masih bekerja di sini</span>
                                @else
                                    <span>Sudah Selesai</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-tasks me-2"></i>Detail Pekerjaan</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Fungsi Pekerjaan:</strong> {{ $pengalamanKerja->job_function }}
                            </div>
                            <div class="col-md-6">
                                <strong>Industri:</strong> {{ $pengalamanKerja->industry }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Level Pekerjaan:</strong> {{ $pengalamanKerja->job_level }}
                            </div>
                            <div class="col-md-6">
                                <strong>Tipe Pekerjaan:</strong> {{ $pengalamanKerja->job_type }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <strong>Deskripsi Pekerjaan:</strong>
                                <p>{{ $pengalamanKerja->description }}</p>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('profil.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Pengalaman Kerja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
