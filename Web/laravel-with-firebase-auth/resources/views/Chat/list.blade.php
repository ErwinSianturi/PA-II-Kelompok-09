@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Daftar Pengguna</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($users as $user)
                            @if ($user->email !== Auth::user()->email)
                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                    <div>
                                        <span class="fw-bold">{{ $user->username }}</span>
                                        <span class="text-muted small">&lt;{{ $user->email }}&gt;</span>
                                    </div>
                                    <a href="{{ route('chat', ['userEmail' => $user->email]) }}"
                                        class="btn btn-outline-primary btn-sm">
                                        Chat
                                    </a>
                                </li>
                            @endif
                        @empty
                            <li class="list-group-item text-center text-muted">
                                Tidak ada pengguna lain.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
