@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2>Alasan Mengambil Pekerjaan: {{ $job->nama_pekerjaan }}</h2>
        <h2>Harga Jasa: {{ 'Rp.' .number_format($job->harga_pekerjaan) }}</h2>
        <h2>Waktu Jasa: {{$job->time }} jam</h2>

        <form action="{{ route('job.apply', $job->id) }}" method="POST">
            @csrf

            <!-- Input for the reason -->
            <div class="mb-3">
                <label for="alasan" class="form-label">Alasan Anda Cocok untuk Pekerjaan Ini:</label>
                <textarea id="alasan" name="alasan" class="form-control" rows="5" required></textarea>
                <small class="form-text text-muted">Jelaskan mengapa Anda cocok dan mengapa memilih pekerjaan ini.</small>
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Kirim Alasan</button>
            </div>


        </form>
    </div>
@endsection
