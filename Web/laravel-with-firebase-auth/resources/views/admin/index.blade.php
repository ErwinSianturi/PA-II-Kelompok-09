@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Only accessible by admin@gmail.com</p>

        <!-- Tabs navigation -->
        <ul class="nav nav-tabs" id="adminTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab"
                    aria-controls="tab1" aria-selected="true">Postingan Pekerjaan</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                    aria-selected="false">Profil Pengguna</a>
            </li>
            <!-- Add other tabs here if necessary -->
        </ul>

        <!-- Tab content -->
        <div class="tab-content" id="adminTabsContent">
            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                <h3>Postingan Pekerjaan</h3>
                <p>Here are all the job postings:</p>

                <!-- Display Jobs in a Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Title</th>
                            <th>Status</th>
                            <th>Status Pembayaran</th>
                            <th>Posted By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Jobs as $job)
                            <tr>
                                <td>{{ $loop->iteration }}</td> <!-- Loop index for job number -->
                                <td><a href="{{ url('/jobs/' . $job->id . '/detail') }}">{{ $job->nama_pekerjaan }}</a></td>
                                <td>{{ $job->status_pekerjaan }}</td> <!-- Assuming there's a 'status_pekerjaan' field -->
                                <td>{{ $job->status }}</td>
                                <td>{{ $job->email }}</td>
                                @if ($job->status == 'success')
                                    <th>Pekerjaan Selesai</th>
                                @else
                                    <th><a href="{{ url( $job->id . '/delete') }}" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this job?')">Delete</a>
                                    </th>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                <h3>Profil Pengguna</h3>
                <p>Here are all the user profiles:</p>

                <!-- Display Profiles in a Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Profil as $profil)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $profil->username }}</td>
                                <td>{{ $profil->email }}</td>
                                <td>{{ $profil->WA }}</td>
                                <td>{{ $profil->alamat_lengkap }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Other tabs content (optional) -->
            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                <h3>Tab 3 Content</h3>
                <p>Content for tab 3 goes here.</p>
            </div>
            <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                <h3>Tab 4 Content</h3>
                <p>Content for tab 4 goes here.</p>
            </div>
            <div class="tab-pane fade" id="tab5" role="tabpanel" aria-labelledby="tab5-tab">
                <h3>Tab 5 Content</h3>
                <p>Content for tab 5 goes here.</p>
            </div>
        </div>
    </div>
@endsection
