<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\JobPosting;
use App\Models\Application; // Ensure Application model is included
use Illuminate\Http\Request;

class JobsController extends Controller
{

    public function index()
    {
        $jobs = JobPosting::where('email', Auth::user()->email)->get();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
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
            'tanggaldanwaktu' => 'required|date'
        ]);


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
            'time' => $request->time,
            'tanggaldanwaktu' => $request->tanggaldanwaktu
        ]);

        return redirect('jobs')->with('status', 'Job posted successfully!');
    }

    public function edit(int $id)
    {
        $jobs = JobPosting::findOrFail($id);
        return view('jobs.edit', compact('jobs'));
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
            'time' => 'required|numeric',
            'tanggaldanwaktu' => 'required|date', // Added tanggaldanwaktu validation
        ]);

        // Retrieve the job posting
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

        // Update the job posting with new details
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
            'tanggaldanwaktu' => $request->tanggaldanwaktu, // Added tanggaldanwaktu field update
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
        $jobs = JobPosting::where('jenis_pekerjaan', $jenis_pekerjaan)
            ->where('email', '!=', Auth::user()->email)
            ->get();

        return view('jobs.category', compact('jobs', 'jenis_pekerjaan'));
    }
    

    public function showdetil(int $id)
    {
        $job = JobPosting::findOrFail($id); // Retrieve the job based on the ID
        return view('jobs.detail', compact('job')); // Pass the job to the view
    }

    public function applyForm($jobId)
    {
        // Find the job by ID
        $job = JobPosting::findOrFail($jobId);

        // Return the view for applying to the job
        return view('jobs.apply', compact('job'));
    }

    public function apply(Request $request, $jobId)
    {
        // Validate the request data
        $request->validate([
            'alasan' => 'required|string|max:1000',
        ]);

        // Find the job posting
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

        // Save the application with user_email
        $jobPosting->applications()->create([
            'user_email' => $userEmail, // Store the user's email
            'alasan' => $request->alasan,
        ]);

        // Increment the applicants_count by 1
        $jobPosting->increment('applicants_count');

        // Redirect back to the job detail page with a success message
        return redirect('jobs/' . $jobId . '/detail')
            ->with('success', 'Alasan Anda telah dikirim.');
    }
    public function showApplicants(int $id)
    {
        // Retrieve the job posting based on the provided job ID
        $job = JobPosting::findOrFail($id);

        // Retrieve all the applications for the job
        $applications = $job->applications()->get();

        // Return a view and pass the job and applications to it
        return view('jobs.applicants', compact('job', 'applications'));
    }
    public function acceptUser(Request $request, $jobId, $userEmail)
    {
        // Find the job posting
        $job = JobPosting::findOrFail($jobId);

        // Update the job's status and the email_pekerja field
        $job->update([
            'status_pekerjaan' => 'Dalam Proses',
            'email_pekerja' => $userEmail,
        ]);

        // Redirect back with a success message
        return redirect()->route('jobs.applicants', ['id' => $jobId])
            ->with('status', 'User accepted and job status updated to "Dalam Proses".');
    }
}
