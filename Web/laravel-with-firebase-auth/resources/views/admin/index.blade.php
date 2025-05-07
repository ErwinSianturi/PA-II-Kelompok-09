@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Only accessible by admin@gmail.com</p>
        <a class="nav-link text-dark" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    </div>
@endsection
