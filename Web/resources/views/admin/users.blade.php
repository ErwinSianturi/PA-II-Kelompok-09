@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>List of Firebase Users</h1>

        @if(count($users) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Email</th>
                        <th>Display Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->uid }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->displayName ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No users found.</p>
        @endif
    </div>
@endsection
