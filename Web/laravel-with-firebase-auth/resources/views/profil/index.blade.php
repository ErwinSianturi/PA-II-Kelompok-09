@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @php
        $profile = $profils->firstWhere('email', Auth::user()->email);
    @endphp

    @if (!$profile)
        <script>window.location.href = "{{ route('addprofile') }}";</script>
    @else
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <img src="{{ asset($profile->image) }}" class="rounded-circle me-3" width="100" height="100"
                    alt="Profile Picture">
                <div>
                    <h4 class="card-title mb-0">{{ $profile->username }}</h4>
                    <p class="text-muted">{{ $profile->email }}</p>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs mt-4" id="profileTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts" type="button"
                    role="tab">About Me</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button"
                    role="tab">About</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="friends-tab" data-bs-toggle="tab" data-bs-target="#friends" type="button"
                    role="tab">Friends</button>
            </li>
        </ul>

        <!-- Tab Contents -->
        <div class="tab-content mt-3" id="profileTabsContent">

            <!-- About Me Tab -->
            <div class="tab-pane fade show active" id="posts" role="tabpanel">
                <div class="card mb-3">
                    <div class="card-body">
                        <p><strong>Nama:</strong> {{ $profile->username }}</p>
                        <p><strong>Email:</strong> {{ $profile->email }}</p>
                        <p><strong>Location:</strong> {{ $profile->provinsi }}, {{ $profile->desa }}</p>
                        <p><strong>Alamat:</strong> {{ $profile->alamat_lengkap }}</p>
                        <p><strong>Joined:</strong> {{ $profile->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- About Tab -->
            <div class="tab-pane fade" id="about" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <p><strong>Nama:</strong> Web developer, coffee enthusiast ☕</p>
                        <p><strong>Location:</strong> Jakarta, Indonesia</p>
                        <p><strong>Joined:</strong> January 2020</p>
                    </div>
                </div>
            </div>

            <!-- Friends Tab -->
            <div class="tab-pane fade" id="friends" role="tabpanel">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('images/friend1.jpg') }}" class="rounded-circle mb-2" width="60"
                                    height="60" alt="Friend 1">
                                <h6 class="card-title">Jane Smith</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Add more friends here if needed -->
                </div>
            </div>

        </div>
    @endif
</div>
@endsection
