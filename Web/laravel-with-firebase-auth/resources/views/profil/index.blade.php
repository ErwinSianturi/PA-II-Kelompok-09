@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        @php
            $profile = $profils->firstWhere('email', Auth::user()->email);
        @endphp

        @if (!$profile)
            <!-- If the profile doesn't exist, Laravel handles the redirection -->
            <script>
                window.location.href = "{{ route('addprofile') }}";
            </script>
        @else
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <!-- Fallback image if profile image is not set -->
                    <img src="{{ asset($profile->image ?? 'images/default-avatar.jpg') }}" class="rounded-circle me-3"
                        width="100" height="100" alt="Profile Picture">
                    <div>
                        <h4 class="card-title mb-0">{{ $profile->username }}</h4>
                        <p class="text-muted">{{ $profile->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <ul class="nav nav-tabs mt-4" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="about-tab" data-bs-toggle="tab" data-bs-target="#about"
                        type="button" role="tab">About Me</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="create-tab" data-bs-toggle="tab" data-bs-target="#create" type="button"
                        role="tab">Pengalaman Kerja</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="friends-tab" data-bs-toggle="tab" data-bs-target="#friends" type="button"
                        role="tab">Friends</button>
                </li>
            </ul>

            <!-- Tab Contents -->
            <div class="tab-content mt-3" id="profileTabsContent">
                <!-- About Me Tab -->
                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <div class="card mb-3">
                        <div class="card-body">
                            <p><strong>Nama:</strong> {{ $profile->username }}</p>
                            <p><strong>Email:</strong> {{ $profile->email }}</p>
                            <p><strong>Location:</strong> {{ $profile->provinsi }}, {{ $profile->desa }}</p>
                            <p><strong>Alamat:</strong> {{ $profile->alamat_lengkap }}</p>
                            <p><strong>Nomor WA:</strong> {{ $profile->WA }}</p>
                            <p><strong>Joined:</strong> {{ $profile->created_at->format('d M Y') }}</p>

                            <a href="{{ url('profil/' . $profile->id . '/edit') }}" class="btn btn-sm btn-warning">Edit</a>
                        </div>
                    </div>
                </div>

                <!-- Pengalaman Kerja Tab -->
                <div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="create-tab">
                    <div class="card">
                        <div class="card-body">
                            <h4>My Pengalaman Kerja</h4>

                            <!-- Button to Add Pengalaman Kerja -->
                            <a href="{{ route('pengalaman_kerja.create') }}" class="btn btn-primary mb-3">Tambah Pengalaman
                                Kerja</a>

                            @if ($pengalamanKerja->isEmpty())
                                <p>No Pengalaman Kerja available yet.</p>
                            @else
                                <div class="list-group">
                                    @foreach ($pengalamanKerja as $kerja)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>{{ $kerja->position }}</strong> at {{ $kerja->company_name }}
                                                <p>{{ $kerja->city }}, {{ $kerja->country }}</p>
                                                <p>From: {{ $kerja->start_date }} to {{ $kerja->end_date ?? 'Current' }}
                                                </p>
                                            </div>
                                            <div>
                                                <!-- Edit Button -->
                                                <a href="{{ route('pengalaman_kerja.edit', $kerja->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('pengalaman_kerja.destroy', $kerja->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this experience?')">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
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
