@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Pengalaman Kerja</h1>

        <!-- Form to Edit Pengalaman Kerja -->
        <form action="{{ route('pengalaman.update', $pengalamanKerja->id) }}" method="POST">
            @csrf
            @method('PUT')

           <!-- Hidden field to auto-fill user_id -->
           <input type="hidden" name="user_id" value="{{ $profil->id }}">

            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" name="position" id="position" class="form-control" value="{{ $pengalamanKerja->position }}" required>
            </div>

            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $pengalamanKerja->company_name }}" required>
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" class="form-control" value="{{ $pengalamanKerja->country }}" required>
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" value="{{ $pengalamanKerja->city }}" required>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="text" name="start_date" id="start_date" class="form-control" value="{{ $pengalamanKerja->start_date }}" required readonly>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="text" name="end_date" id="end_date" class="form-control" value="{{ $pengalamanKerja->end_date }}" readonly>
            </div>

            <div class="form-group">
                <label for="is_current">Is Current</label>
                <select name="is_current" id="is_current" class="form-control" required>
                    <option value="0" {{ $pengalamanKerja->is_current == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $pengalamanKerja->is_current == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            <div class="form-group">
                <label for="job_function">Job Function</label>
                <input type="text" name="job_function" id="job_function" class="form-control" value="{{ $pengalamanKerja->job_function }}" required>
            </div>

            <div class="form-group">
                <label for="industry">Industry</label>
                <input type="text" name="industry" id="industry" class="form-control" value="{{ $pengalamanKerja->industry }}" required>
            </div>

            <div class="form-group">
                <label for="job_level">Job Level</label>
                <input type="text" name="job_level" id="job_level" class="form-control" value="{{ $pengalamanKerja->job_level }}" required>
            </div>

            <div class="form-group">
                <label for="job_type">Job Type</label>
                <input type="text" name="job_type" id="job_type" class="form-control" value="{{ $pengalamanKerja->job_type }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ $pengalamanKerja->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Pengalaman Kerja</button>
        </form>
    </div>

    <!-- Include Flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        // Initialize Flatpickr for start_date and end_date
        flatpickr("#start_date", {
            dateFormat: "Y-m-d", // Format the date as YYYY-MM-DD
            disableMobile: true, // Disable mobile date picker if not desired
        });

        flatpickr("#end_date", {
            dateFormat: "Y-m-d", // Format the date as YYYY-MM-DD
            disableMobile: true, // Disable mobile date picker if not desired
        });

        document.getElementById("experienceForm").addEventListener("submit", function(event) {
            const startDate = document.getElementById("start_date").value;
            const endDate = document.getElementById("end_date").value;
            const isCurrent = document.getElementById("is_current");

            // Check if end date is the same as start date
            if (startDate === endDate) {
                alert("End date cannot be the same as start date.");
                event.preventDefault();
                return;
            }

            // Ensure start date is earlier than end date
            if (new Date(startDate) >= new Date(endDate)) {
                alert("End date must be after start date.");
                event.preventDefault();
                return;
            }

            // Automatically set is_current to No if the end date is in the past
            const currentDate = new Date();
            const endDateObj = new Date(endDate);

            if (endDateObj < currentDate) {
                isCurrent.value = "0"; // Set to "No" if the end date is before today's date
            }
        });

        document.getElementById("start_date").addEventListener("change", function() {
            const startDate = this.value;
            const endDate = document.getElementById("end_date");
            const currentDate = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

            // Set the minimum value for the end date as the start date
            endDate.setAttribute("min", startDate);

            // Ensure the end date is not the same as the start date
            if (new Date(startDate) >= new Date(endDate.value) && endDate.value) {
                alert("End date must be after the start date.");
                endDate.value = ''; // Clear end date if invalid
            }

            // Check if the start date is the current date or later
            if (startDate === currentDate) {
                alert("Start date cannot be the current date.");
                this.value = ''; // Clear start date if invalid
            }

            if (new Date(startDate) > new Date(currentDate)) {
                alert("Start date cannot be more than the current date.");
                this.value = ''; // Clear start date if invalid
            }
        });

        document.getElementById("end_date").addEventListener("change", function() {
            const startDate = document.getElementById("start_date").value;
            const endDate = this.value;

            // Ensure the end date is after the start date
            if (new Date(startDate) >= new Date(endDate)) {
                alert("End date must be after the start date.");
                this.value = ''; // Clear end date if invalid
            }
        });
    </script>
@endsection
