<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\PengalamanKerja;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        // Apply authentication middleware to the admin routes
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // Check if the logged-in user is the admin
        if (auth()->user()->email === 'admin@gmail.com') {
            $Jobs = JobPosting::all();
            $Profil = Profil::all();
            return view('admin.index', compact('Jobs', 'Profil'));
        } else {
            // If not admin, redirect to home
            return redirect('/home');
        }
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
        return redirect('/')->with('status', 'Job deleted successfully!');
    }
}
