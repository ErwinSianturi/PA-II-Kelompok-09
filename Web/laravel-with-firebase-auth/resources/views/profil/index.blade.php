@extends('layouts.app') {{-- assuming you're using a layout --}}

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-body d-flex align-items-center">
                <img src="{{ asset('images/profile.jpg') }}" class="rounded-circle me-3" width="100" height="100"
                    alt="Profile Picture">
                <div>
                    <h4 class="card-title mb-0">John Doe</h4>
                    @if (Auth::check())
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    @endif

                </div>
            </div>
        </div>

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

        <div class="tab-content mt-3" id="profileTabsContent">
            <div class="tab-pane fade show active" id="posts" role="tabpanel">
                <div class="card mb-3">
                    <div class="card-body">

                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="about" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <p><strong>Bio:</strong> Web developer, coffee enthusiast ☕</p>
                        <p><strong>Location:</strong> Jakarta, Indonesia</p>
                        <p><strong>Joined:</strong> January 2020</p>
                    </div>
                </div>
            </div>

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
                    <!-- Repeat friend cards as needed -->
                </div>
            </div>
        </div>
    </div>
@endsection
