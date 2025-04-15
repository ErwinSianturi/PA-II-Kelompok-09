@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h3>User Details: {{ $user->email }}</h3>

        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->phone }}</p>
        <p><strong>Address:</strong> {{ $user->address }}</p>
        <a href="{{ route('jobs.applicants', ['id' => $user->job_id]) }}" class="btn btn-primary">Back to Job Applicants</a>
    </div>
@endsection
