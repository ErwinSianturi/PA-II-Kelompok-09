@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h3>Applicants for Job: {{ $job->nama_pekerjaan }}</h3>

        @if ($job->applications->isEmpty())
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
                                <a href="{{ route('users.show', ['email' => $application->user_email]) }}"
                                    class="btn btn-info btn-sm">View User</a>
                            </td>
                            <td>
                                <!-- Add Button to Assign User -->
                                <form action="{{ route('jobs.assign', ['id' => $job->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="email_pengambil" value="{{ $application->user_email }}">
                                    <input type="hidden" name="status_pekerjaan" value="Dalam Proses">
                                    <button type="submit" class="btn btn-success btn-sm">Assign User</button>
                                </form>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
