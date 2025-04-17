@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h3>Applicants for Job: {{ $job->nama_pekerjaan }}</h3>

        @if($job->applications->isEmpty())
            <p>No applicants yet.</p>
        @else
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>User Email</th>
                        <th>Alasan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($job->applications as $application)
                        <tr>
                            <td>{{ $application->user_email }}</td>
                            <td>{{ $application->alasan }}</td>
                            <td>
                                <!-- View User Data Button -->
                                <a href="{{ route('users.show', ['email' => $application->user_email]) }}" class="btn btn-info btn-sm">View User</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
