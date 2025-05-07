@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><i class="fas fa-briefcase me-2"></i>Tambah Pengalaman Kerja</h3>
                    </div>
                    <div class="card-body p-4">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('pengalaman.store') }}" method="POST" id="experienceForm"
                            class="needs-validation" novalidate>
                            @csrf

                            <!-- Hidden field to auto-fill user_id -->
                            <input type="hidden" name="user_id" value="{{ $profil->id }}">

                            <!-- Informasi Perusahaan -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 text-primary"><i
                                            class="fas fa-building me-2"></i>Informasi Perusahaan</h5>
                                </div>
                            </div>

                            <!-- Position and Company Name Inputs -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="position" id="position"
                                            class="form-control @error('position') is-invalid @enderror"
                                            placeholder="Posisi" value="{{ old('position') }}" required>
                                        <label for="position"><i class="fas fa-user-tie me-2"></i>Posisi</label>
                                        @error('position')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="company_name" id="company_name"
                                            class="form-control @error('company_name') is-invalid @enderror"
                                            placeholder="Nama Perusahaan" value="{{ old('company_name') }}" required>
                                        <label for="company_name"><i class="fas fa-building me-2"></i>Nama
                                            Perusahaan</label>
                                        @error('company_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Country and City Inputs -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="country" id="country"
                                            class="form-control @error('country') is-invalid @enderror" placeholder="Negara"
                                            value="{{ old('country') }}" required>
                                        <label for="country"><i class="fas fa-globe me-2"></i>Negara</label>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="city" id="city"
                                            class="form-control @error('city') is-invalid @enderror" placeholder="Kota"
                                            value="{{ old('city') }}" required>
                                        <label for="city"><i class="fas fa-map-marker-alt me-2"></i>Kota</label>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Periode Kerja -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 text-primary"><i
                                            class="fas fa-calendar-alt me-2"></i>Periode Kerja</h5>
                                </div>
                            </div>

                            <!-- Start and End Dates -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="start_date"><i class="fas fa-calendar-day me-2"></i>Tanggal
                                            Mulai</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            <input type="text" name="start_date" id="start_date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                placeholder="YYYY-MM-DD" value="{{ old('start_date') }}" required readonly>
                                        </div>
                                        @error('start_date')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div id="start_date_feedback" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="end_date"><i class="fas fa-calendar-day me-2"></i>Tanggal
                                            Selesai</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            <input type="text" name="end_date" id="end_date"
                                                class="form-control @error('end_date') is-invalid @enderror"
                                                placeholder="YYYY-MM-DD" value="{{ old('end_date') }}" required readonly>
                                        </div>
                                        @error('end_date')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <div id="end_date_feedback" class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Currently Working Checkbox -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="current_job_switch"
                                            name="is_current_switch">
                                        <label class="form-check-label" for="current_job_switch">Saya masih bekerja di
                                            sini</label>
                                    </div>
                                    <input type="hidden" name="is_current" id="is_current">
                                </div>
                            </div>

                            <!-- Detail Pekerjaan -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="border-bottom pb-2 text-primary"><i class="fas fa-tasks me-2"></i>Detail
                                        Pekerjaan</h5>
                                </div>
                            </div>

                            <!-- Job Function, Industry, Job Level, and Job Type Inputs -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="job_function" id="job_function"
                                            class="form-control @error('job_function') is-invalid @enderror"
                                            placeholder="Fungsi Pekerjaan" value="{{ old('job_function') }}" required>
                                        <label for="job_function"><i class="fas fa-cogs me-2"></i>Fungsi Pekerjaan</label>
                                        @error('job_function')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="industry" id="industry"
                                            class="form-control @error('industry') is-invalid @enderror"
                                            placeholder="Industri" value="{{ old('industry') }}" required>
                                        <label for="industry"><i class="fas fa-industry me-2"></i>Industri</label>
                                        @error('industry')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="job_level" id="job_level"
                                            class="form-select @error('job_level') is-invalid @enderror" required>
                                            <option value="" disabled selected>Pilih level pekerjaan</option>
                                            <option value="Internship"
                                                {{ old('job_level') == 'Internship' ? 'selected' : '' }}>Magang</option>
                                            <option value="Entry Level"
                                                {{ old('job_level') == 'Entry Level' ? 'selected' : '' }}>Entry Level
                                            </option>
                                            <option value="Junior" {{ old('job_level') == 'Junior' ? 'selected' : '' }}>
                                                Junior</option>
                                            <option value="Mid-Senior"
                                                {{ old('job_level') == 'Mid-Senior' ? 'selected' : '' }}>Mid-Senior
                                            </option>
                                            <option value="Senior" {{ old('job_level') == 'Senior' ? 'selected' : '' }}>
                                                Senior</option>
                                            <option value="Manager" {{ old('job_level') == 'Manager' ? 'selected' : '' }}>
                                                Manager</option>
                                            <option value="Director"
                                                {{ old('job_level') == 'Director' ? 'selected' : '' }}>Director</option>
                                            <option value="Executive"
                                                {{ old('job_level') == 'Executive' ? 'selected' : '' }}>Executive</option>
                                        </select>
                                        <label for="job_level"><i class="fas fa-level-up-alt me-2"></i>Level
                                            Pekerjaan</label>
                                        @error('job_level')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="job_type" id="job_type"
                                            class="form-select @error('job_type') is-invalid @enderror" required>
                                            <option value="" disabled selected>Pilih tipe pekerjaan</option>
                                            <option value="Full-time"
                                                {{ old('job_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                            <option value="Part-time"
                                                {{ old('job_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                            <option value="Contract"
                                                {{ old('job_type') == 'Contract' ? 'selected' : '' }}>Kontrak</option>
                                            <option value="Freelance"
                                                {{ old('job_type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                            <option value="Internship"
                                                {{ old('job_type') == 'Internship' ? 'selected' : '' }}>Magang</option>
                                        </select>
                                        <label for="job_type"><i class="fas fa-business-time me-2"></i>Tipe
                                            Pekerjaan</label>
                                        @error('job_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Job Description -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Deskripsi" style="height: 150px">{{ old('description') }}</textarea>
                                        <label for="description"><i class="fas fa-align-left me-2"></i>Deskripsi
                                            Pekerjaan</label>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-2"></i>Simpan Pengalaman Kerja
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Flatpickr CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Include Font Awesome if not already included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        // Update hidden input value based on checkbox status
        document.getElementById('current_job_switch').addEventListener('change', function() {
            var hiddenInput = document.getElementById('is_current');
            hiddenInput.value = this.checked ? '1' : '0';
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize flatpickr for start_date
            const startDatePicker = flatpickr("#start_date", {
                dateFormat: "Y-m-d",
                disableMobile: true,
                maxDate: new Date(), // Cannot select dates in the future
                onChange: function(selectedDates, dateStr) {
                    // Update end date minimum when start date changes
                    endDatePicker.set('minDate', dateStr);

                    // Validate start date is not in the future
                    validateStartDate(dateStr);
                }
            });

            // Initialize flatpickr for end_date
            const endDatePicker = flatpickr("#end_date", {
                dateFormat: "Y-m-d",
                disableMobile: true,
                // No maxDate limit to allow future end dates
                onChange: function(selectedDates, dateStr) {
                    // Validate end date is after start date
                    validateEndDate(dateStr);
                }
            });

            // Validate date inputs
            function validateStartDate(dateStr) {
                const startDate = new Date(dateStr);
                const today = new Date();
                const startDateFeedback = document.getElementById('start_date_feedback');
                const startDateInput = document.getElementById('start_date');

                if (startDate > today) {
                    startDateFeedback.textContent = "Tanggal mulai tidak boleh di masa depan.";
                    startDateFeedback.style.display = 'block';
                    startDateInput.classList.add('is-invalid');
                    return false;
                } else {
                    startDateFeedback.style.display = 'none';
                    startDateInput.classList.remove('is-invalid');
                    return true;
                }
            }

            function validateEndDate(dateStr) {
                if (!dateStr) return true;

                const startDateStr = document.getElementById('start_date').value;
                if (!startDateStr) return true;

                const startDate = new Date(startDateStr);
                const endDate = new Date(dateStr);
                const endDateFeedback = document.getElementById('end_date_feedback');
                const endDateInput = document.getElementById('end_date');

                if (endDate <= startDate) {
                    endDateFeedback.textContent = "Tanggal selesai harus setelah tanggal mulai.";
                    endDateFeedback.style.display = 'block';
                    endDateInput.classList.add('is-invalid');
                    return false;
                } else {
                    endDateFeedback.style.display = 'none';
                    endDateInput.classList.remove('is-invalid');
                    return true;
                }
            }

            // Form submission validation
            document.getElementById('experienceForm').addEventListener('submit', function(event) {
                const startDateValid = validateStartDate(document.getElementById('start_date').value);
                const isCurrentChecked = document.getElementById('current_job_switch').checked;
                let endDateValid = true;

                if (!isCurrentChecked) {
                    endDateValid = validateEndDate(document.getElementById('end_date').value);
                }

                if (!startDateValid || !endDateValid) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection
