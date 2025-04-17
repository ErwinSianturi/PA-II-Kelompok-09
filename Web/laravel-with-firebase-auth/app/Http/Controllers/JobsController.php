<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\JobPosting;
use App\Models\Application; // Ensure Application model is included
use Illuminate\Http\Request;
use App\Models\Profil;

class JobsController extends Controller
{
    public function index()
    {
        // Retrieve jobs posted by the authenticated user
        $jobs = JobPosting::where('email', Auth::user()->email)->get();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'nama_pekerjaan' => 'required|string',
            'email' => 'required|email',
            'harga_pekerjaan' => 'required|numeric',
            'deskripsi' => 'required|string',
            'syarat_ketentuan' => 'required|string',
            'lingkup_kerja' => 'required|string',
            'status_pekerjaan' => 'required|in:Tersedia,Dalam Proses,Selesai',
            'jenis_pekerjaan' => 'required|in:Kebersihan,Perbaikan Rumah,Perbaikan Kendaraan,Perbaikan Elektronik,Tutor,Rumah Tangga,Fotografi & videografi,Lainnya',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'time' => 'required|numeric',
            'email_pengambil' => 'nullable|string',
            'tanggaldanwaktu' => 'required|date'
        ]);

        // Process image uploads
        $imagePaths = [];
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $file = $request->file($imageField);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('JobPost'), $filename);
                $imagePaths[$imageField] = 'JobPost/' . $filename;
            } else {
                $imagePaths[$imageField] = null;
            }
        }

        // Create a new job posting in the database
        JobPosting::create([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'email' => $request->email,
            'harga_pekerjaan' => $request->harga_pekerjaan,
            'deskripsi' => $request->deskripsi,
            'syarat_ketentuan' => $request->syarat_ketentuan,
            'lingkup_kerja' => $request->lingkup_kerja,
            'status_pekerjaan' => $request->status_pekerjaan,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'image1' => $imagePaths['image1'],
            'image2' => $imagePaths['image2'],
            'image3' => $imagePaths['image3'],
            'email_pengambil' => $request->email_pengambil,
            'time' => $request->time,
            'tanggaldanwaktu' => $request->tanggaldanwaktu
        ]);

        return redirect('jobs')->with('status', 'Job posted successfully!');
    }

    public function edit(int $id)
    {
        // Retrieve the job posting by ID
        $job = JobPosting::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, int $id)
    {
        // Validate the updated request data
        $validated = $request->validate([
            'nama_pekerjaan' => 'required|string',
            'email' => 'required|email',
            'harga_pekerjaan' => 'required|numeric',
            'deskripsi' => 'required|string',
            'syarat_ketentuan' => 'required|string',
            'lingkup_kerja' => 'required|string',
            'status_pekerjaan' => 'required|in:Tersedia,Dalam Proses,Selesai',
            'jenis_pekerjaan' => 'required|in:Kebersihan,Perbaikan Rumah,Perbaikan Kendaraan,Perbaikan Elektronik,Tutor,Rumah Tangga,Fotografi & videografi,Lainnya',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email_pengambil' => 'nullable|string',
            'time' => 'required|numeric',
            'tanggaldanwaktu' => 'required|date'
        ]);

        // Retrieve the job posting by ID
        $job = JobPosting::findOrFail($id);
        $imagePaths = [];

        // Handle image uploads if they are present in the request
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                // Delete old images if they exist
                if ($job->$imageField && file_exists(public_path($job->$imageField))) {
                    unlink(public_path($job->$imageField)); // Delete the old image
                }

                // Upload the new image
                $file = $request->file($imageField);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('JobPost'), $filename);
                $imagePaths[$imageField] = 'JobPost/' . $filename;
                $job->$imageField = $imagePaths[$imageField]; // Update image path for the job
            }
        }

        // Update the job posting in the database
        $job->update([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'email' => $request->email,
            'harga_pekerjaan' => $request->harga_pekerjaan,
            'deskripsi' => $request->deskripsi,
            'syarat_ketentuan' => $request->syarat_ketentuan,
            'lingkup_kerja' => $request->lingkup_kerja,
            'status_pekerjaan' => $request->status_pekerjaan,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'time' => $request->time,
            'email_pengambil' => $request->email_pengambil,  // Update the email_pengambil field
            'tanggaldanwaktu' => $request->tanggaldanwaktu
        ]);

        // Redirect with success message
        return redirect('jobs')->with('status', 'Job updated successfully!');
    }


    public function delete(int $id)
    {
        // Retrieve the job by ID
        $job = JobPosting::findOrFail($id);

        // Delete images from the file system if they exist
        $imageFields = ['image1', 'image2', 'image3'];
        foreach ($imageFields as $imageField) {
            if ($job->$imageField && file_exists(public_path($job->$imageField))) {
                unlink(public_path($job->$imageField)); // Delete the file from the public directory
            }
        }

        // Delete the job from the database
        $job->delete();

        // Redirect with a success message
        return redirect('jobs')->with('status', 'Job deleted successfully!');
    }

    public function showCategory($jenis_pekerjaan)
    {
        // Retrieve jobs based on the job category type and ensure they are not posted by the authenticated user
        $jobs = JobPosting::where('jenis_pekerjaan', $jenis_pekerjaan)
            ->where('email', '!=', Auth::user()->email)
            ->get();

        return view('jobs.category', compact('jobs', 'jenis_pekerjaan'));
    }

    public function showdetil(int $id)
    {
        // Retrieve the job posting by ID and return its details
        $job = JobPosting::findOrFail($id);
        return view('jobs.detail', compact('job'));
    }

    public function applyForm($jobId)
    {
        // Find the job by ID and return the view to apply for the job
        $job = JobPosting::findOrFail($jobId);
        return view('jobs.apply', compact('job'));
    }

    public function apply(Request $request, $jobId)
    {
        // Validate the application request data
        $request->validate([
            'alasan' => 'required|string|max:1000',
        ]);

        // Find the job posting by ID
        $jobPosting = JobPosting::findOrFail($jobId);

        // Get the authenticated user's email
        $userEmail = Auth::user()->email;

        // Check if the user has already applied for the job
        $existingApplication = Application::where('job_posting_id', $jobId)
            ->where('user_email', $userEmail)
            ->first();

        if ($existingApplication) {
            // Redirect back to the job detail page with an error message
            return redirect('jobs/' . $jobId . '/detail')
                ->with('error', 'You have already applied for this job.');
        }

        // Save the new application with the user's email and the provided reason
        $jobPosting->applications()->create([
            'user_email' => $userEmail,
            'alasan' => $request->alasan,
        ]);

        // Increment the applicants_count by 1
        $jobPosting->increment('applicants_count');

        // Redirect back to the job detail page with a success message
        return redirect('jobs/' . $jobId . '/detail')
            ->with('success', 'Your application has been submitted.');
    }

    public function showApplicants(int $id)
    {
        // Retrieve the job posting by ID and all applications for that job
        $job = JobPosting::findOrFail($id);
        $applications = $job->applications()->get();

        // Return a view with the job and its applications
        return view('jobs.applicants', compact('job', 'applications'));
    }
    public function assignUser(Request $request, int $id)
    {
        // Validate the request for email_pengambil
        $validated = $request->validate([
            'email_pengambil' => 'required|string|email',
            'status_pekerjaan' => 'required|in:Tersedia,Dalam Proses,Selesai'
        ]);

        // Retrieve the job posting by ID
        $job = JobPosting::findOrFail($id);

        // Update the job posting with the assigned user's email
        $job->update([
            'email_pengambil' => $request->email_pengambil,
            'status_pekerjaan' => $request->status_pekerjaan,
        ]);

        // Redirect with success message
        return redirect('jobs')->with('status', 'User successfully assigned to the job!');
    }
}
