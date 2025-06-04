@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Card Container -->
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-5">
                        <!-- Job Information -->
                        <div class="mb-4 text-center">
                            <h2 class="text-primary fw-bold">Alasan Mengambil Pekerjaan</h2>
                            <p class="text-secondary fs-5">{{ $job->nama_pekerjaan }}</p>
                        </div>

                        <div class="d-flex justify-content-between bg-light p-3 rounded mb-4">
                            <div class="text-center">
                                <h6 class="mb-0 text-muted">Harga Jasa</h6>
                                <h5 class="fw-bold">Rp{{ number_format($job->harga_pekerjaan) }}</h5>
                            </div>
                            <div class="text-center">
                                <h6 class="mb-0 text-muted">Waktu Jasa</h6>
                                <h5 class="fw-bold">{{ $job->time }} jam</h5>
                            </div>
                        </div>

                        <!-- Application Form -->
                        <form action="{{ route('job.apply', $job->id) }}" method="POST">
                            @csrf
                            <!-- Input for the Reason -->
                            <div class="mb-4">
                                <label for="alasan" class="form-label fw-semibold text-secondary">Alasan Anda Cocok untuk
                                    Pekerjaan Ini:</label>
                                <textarea id="alasan" name="alasan" class="form-control shadow-sm" rows="5" required
                                    placeholder="Jelaskan mengapa Anda cocok dan memilih pekerjaan ini..."></textarea>
                                <small class="text-muted d-block mt-2">Tuliskan alasan terbaik Anda dalam beberapa
                                    kalimat.</small>
                            </div>

                            <!-- Submit and Feedback -->
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary px-4 py-2">Kirim Alasan</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary px-4 py-2">Kembali</a>
                            </div>



                            @if (session('error'))
                                <div class="alert alert-danger mt-3">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
