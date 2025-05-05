@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Detail Pembayaran</h2>
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
        </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row mt-3">
                <div class="col-md-4">
                    <img src="{{ $job->image1 }}" class="img-fluid shadow-sm border border-secondary-subtle"
                        alt="{{ $job->nama_pekerjaan }}">
                </div>
                <div class="col-md-8">
                    <h1>{{ $job->nama_pekerjaan }}</h1>
                    <p>{{ $job->deskripsi }}</p>
                    <p>Rp{{ number_format($job->harga_pekerjaan, 0, ',', '.') }}</p>
                    <form action="{{ route('checkout-process') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $job->id }}">
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        <input type="hidden" name="price" value="{{ $job->harga_pekerjaan }}">
                            <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
