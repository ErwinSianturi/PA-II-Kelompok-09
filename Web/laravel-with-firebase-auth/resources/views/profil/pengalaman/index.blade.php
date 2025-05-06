@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pengalaman Kerja</h1>

        <!-- Display Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button to Create New Pengalaman Kerja -->
        <a href="{{ route('pengalaman_kerja.create') }}" class="btn btn-primary mb-3">Create Pengalaman Kerja</a>

        <!-- Table to Display Work Experience Records -->
        <table class="table">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Company Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengalamanKerja as $kerja)
                    <tr>
                        <td>{{ $kerja->position }}</td>
                        <td>{{ $kerja->company_name }}</td>
                        <td>{{ $kerja->start_date }}</td>
                        <td>{{ $kerja->end_date ?? 'Current' }}</td>
                        <td>
                            <!-- Edit and Delete buttons -->
                            <a href="{{ route('pengalaman_kerja.edit', $kerja->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete Form -->
                            <form action="{{ route('pengalaman_kerja.destroy', $kerja->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
