@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Jenis Pekerjaan: {{ ucfirst($jenis_pekerjaan) }}</h2>

        <div class="row">
            @foreach ($jobs as $job)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $job->nama_pekerjaan }}</h5>
                            <img src="{{ asset($job->image) }}" width="100" height="100" style="object-fit: cover;">
                            <p class="card-text">{{ $job->deskripsi }}</p>
                            <p class="card-text">{{ $job->email }}</p>
                            <p class="card-text">Harga: Rp. {{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</p>
                            <a href="" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
