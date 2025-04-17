@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h3>User Details: {{ $user->email }}</h3>
        <img src="{{ asset($user->image) }}" width="300" height="300" alt="Profile Picture">
        <p><strong>Name:</strong> {{ $user->username }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->WA }}</p>
        <p><strong>Address:</strong> {{ $user->jenis_kelamin }}</p> 
    </div>
@endsection
