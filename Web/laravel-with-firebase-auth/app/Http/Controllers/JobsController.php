<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\JobPosting;
use Google\Cloud\Storage\Connection\Rest;
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
            'status_pekerjaan' => 'required',
            'jenis_pekerjaan' => 'required|string', // Add validation for jenis_pekerjaan
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('JobPost'), $filename);
            $imagePath = 'JobPost/' . $filename; // Save relative path
        }

        JobPosting::create([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'email' => $request->email,
            'harga_pekerjaan' => $request->harga_pekerjaan,
            'deskripsi' => $request->deskripsi,
            'status_pekerjaan' => $request->status_pekerjaan,
            'jenis_pekerjaan' => $request->jenis_pekerjaan, // Save jenis_pekerjaan
            'image' => $imagePath,
        ]);

        return redirect('jobs')->with('status', 'Job posted successfully!');
    }


    public function edit(int $id)
    {
        $jobs = JobPosting::findOrFail($id);
        // return $jobs;
        return view('jobs.edit', compact('jobs'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'nama_pekerjaan' => 'required|string',
            'email' => 'required|email',
            'harga_pekerjaan' => 'required|numeric',
            'deskripsi' => 'required|string',
            'status_pekerjaan' => 'required',
            'jenis_pekerjaan' => 'required|string', // Add validation for jenis_pekerjaan
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $job = JobPosting::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('JobPost'), $filename);
            $imagePath = 'JobPost/' . $filename; // Save relative path
            $job->image = $imagePath; // Update image path
        }

        $job->update([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'email' => $request->email,
            'harga_pekerjaan' => $request->harga_pekerjaan,
            'deskripsi' => $request->deskripsi,
            'status_pekerjaan' => $request->status_pekerjaan,
            'jenis_pekerjaan' => $request->jenis_pekerjaan, // Update jenis_pekerjaan
        ]);

        return redirect('jobs')->with('status', 'Job updated successfully!');
    }

    public function delete(int $id)
    {
        $jobs = JobPosting::findOrFail($id);
        $jobs->delete();

        return redirect('jobs')->with('Status', 'Job Deleted');
    }
    public function showCategory($jenis_pekerjaan)
    {

        $jobs = JobPosting::where('jenis_pekerjaan', $jenis_pekerjaan)
            ->where('email', '!=', Auth::user()->email) // Exclude jobs uploaded by the logged-in user
            ->get();

        // Kirim data ke view
        return view('jobs.category', compact('jobs', 'jenis_pekerjaan'));
    }
}
