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
        $postedJobs = JobPosting::where('email', Auth::user()->email)
            ->where('status_pekerjaan', 'Tersedia')
            ->get();

        $takenJobs = JobPosting::where('email_pengambil', Auth::user()->email)->get();

        $ongoingJobs = JobPosting::where('email', Auth::user()->email)
            ->where('status_pekerjaan', 'Dalam Proses')
            ->get();

        $doneJobs = JobPosting::where('email', Auth::user()->email)
            ->where('status_pekerjaan', 'Selesai')
            ->get();

        return view('jobs.index', compact('postedJobs', 'takenJobs', 'ongoingJobs', 'doneJobs'));
    }

    public function create()
    {
        // Get the profile based on the logged-in user's email
        $profils = Profil::where('email', Auth::user()->email)->first();

        // Check if the profile is not complete (i.e., missing username or other required fields)
        if (!$profils || empty($profils->username)) {
            // Redirect the user to the profile page with an error message
            return redirect('profil')->with('error', 'Please complete your profile before creating a job posting.');
        }

        // If the profile is complete, allow the user to access the job creation page
        return view('jobs.create');
    }

    // Store a new job posting
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'email' => 'required|email',
            'harga_pekerjaan' => 'required|numeric',
            'deskripsi' => 'required|string|max:5000',
            'syarat_ketentuan' => 'nullable|string|max:5000',
            'lokasi' => 'nullable|string|max:5000',
            'status_pekerjaan' => 'required|in:Tersedia,Dalam Proses,Selesai',
            'jenis_pekerjaan' => 'required|in:Kebersihan,Perbaikan Rumah,Perbaikan Kendaraan,Perbaikan Elektronik,Tutor,Rumah Tangga,Fotografi & videografi,Lainnya',
            'time' => 'required|numeric',
            'email_pengambil' => 'nullable|email',
            'tanggaldanwaktu' => 'required|date',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Initialize image paths
        $imagePaths = [];

        // Handle image uploads just like the edit method
        foreach (['image1', 'image2', 'image3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $file = $request->file($imageField);
                $filename = time() . '_' . $file->getClientOriginalName();

                // Check if the directory exists, if not create it
                $destinationPath = public_path('storage/JobPost');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0775, true);  // Make sure folder is created with correct permissions
                }

                // Move the file to the public storage folder
                $file->move($destinationPath, $filename);

                // Store the relative path for the database
                $imagePaths[$imageField] = 'storage/JobPost/' . $filename;
            } else {
                $imagePaths[$imageField] = null; // If no image is uploaded, set to null
            }
        }

        // Create a new job posting in the database
        JobPosting::create([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'email' => $request->email,
            'harga_pekerjaan' => $request->harga_pekerjaan,
            'deskripsi' => $request->deskripsi,
            'syarat_ketentuan' => $request->syarat_ketentuan,
            'lokasi' => $request->lokasi,
            'status_pekerjaan' => $request->status_pekerjaan,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'image1' => $imagePaths['image1'],
            'image2' => $imagePaths['image2'],
            'image3' => $imagePaths['image3'],
            'email_pengambil' => $request->email_pengambil,
            'time' => $request->time,
            'tanggaldanwaktu' => $request->tanggaldanwaktu
        ]);

        // Redirect to the job listings page with a success message
        return redirect('jobs')->with('status', 'Job posted successfully!');
    }



    public function edit(int $id)
    {
        // Retrieve the job posting by ID
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
            'syarat_ketentuan' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'status_pekerjaan' => 'required|in:Tersedia,Dalam Proses,Selesai',
            'jenis_pekerjaan' => 'required|in:Kebersihan,Perbaikan Rumah,Perbaikan Kendaraan,Perbaikan Elektronik,Tutor,Rumah Tangga,Fotografi & videografi,Lainnya',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif',
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
            'lokasi' => $request->lokasi,
            'status_pekerjaan' => $request->status_pekerjaan,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'time' => $request->time,
            'email_pengambil' => $request->email_pengambil,
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

        $postedJobs = JobPosting::where('jenis_pekerjaan', $jenis_pekerjaan)
            ->where('email', '!=', Auth::user()->email)
            ->where('status_pekerjaan', 'Tersedia')
            ->get();

        $ongoingJobs = JobPosting::where('jenis_pekerjaan', $jenis_pekerjaan)
            ->where('email', '!=', Auth::user()->email)
            ->where('status_pekerjaan', 'Dalam Proses')
            ->get();

        $doneJobs = JobPosting::where('jenis_pekerjaan', $jenis_pekerjaan)
            ->where('email', '!=', Auth::user()->email)
            ->where('status_pekerjaan', 'Selesai')
            ->get();


        return view('jobs.category', compact('jobs', 'postedJobs','doneJobs', 'ongoingJobs', 'jenis_pekerjaan'));
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

    // Get the user's profile
    $profils = Profil::where('email', Auth::user()->email)->first();

    // Check if profile is incomplete
    if (!$profils || empty($profils->username)) {
        return redirect('profil')->with('error', 'Please complete your profile before applying for a job.');
    }

    // Check if the user is currently employed
    if ($profils->status_pekerja === "Bekerja") {
        return redirect('jobs/' . $jobId . '/detail')->with('error', 'Anda masih dalam status bekerja dan tidak dapat melamar pekerjaan.');
    }

    if ($profils->status_akun != "Aktif") {
        return redirect('jobs/' . $jobId . '/detail')->with('error', 'Akun Anda sudah di nonaktifkan');
    }

    // Find the job posting by ID
    $jobPosting = JobPosting::findOrFail($jobId);

    // Get the user's email
    $userEmail = $profils->email;

    // Check if the user has already applied for the same job posting
    $existingApplication = Application::where('job_posting_id', $jobId)
        ->where('user_email', $userEmail)
        ->first();

    if ($existingApplication) {
        // If the application already exists, redirect with an error message
        return redirect('jobs/' . $jobId . '/detail')
            ->with('error', 'You have already applied for this job.');
    }

    // Save the new application with the user's email and the reason
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
    public function start(JobPosting $job)
    {
        // Mengubah status pekerja menjadi "Bekerja" di tabel 'profils'
        $profil = Profil::where('email', $job->email_pengambil)->first(); // Menyesuaikan dengan relasi yang ada
        if ($profil) {
            $profil->status_pekerja = 'Bekerja';
            $profil->save();
        }

        // Mengubah status pekerja menjadi "Bekerja" di tabel 'job_postings'
        $job->status_pekerja = 'Bekerja';
        $job->save();

        return redirect()->back()->with('success', 'Pekerjaan telah dimulai.');
    }

    // Method untuk menyelesaikan pekerjaan
    public function finish(JobPosting $job)
    {
        // Mengubah status pekerja menjadi "Selesai" di tabel 'profils'
        $profil = Profil::where('email', $job->email_pengambil)->first(); // Menyesuaikan dengan relasi yang ada
        if ($profil) {
            $profil->status_pekerja = 'Selesai';
            $profil->save();
        }

        // Mengubah status pekerjaan menjadi "Selesai" di tabel 'job_postings'
        $job->status_pekerja = 'Selesai';
        $job->status_pekerjaan = 'Selesai';
        $job->save();

        return redirect()->back()->with('success', 'Pekerjaan telah selesai.');
    }

}
