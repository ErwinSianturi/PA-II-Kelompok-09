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
        $jobs = JobPosting::where('email', Auth::user()->email)->get(); // Filter by logged-in user's email

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
            'status_pekerjaan' => 'required'
        ]);
        JobPosting::create([
            'nama_pekerjaan' => $request->nama_pekerjaan,
            'email' => $request->email,
            'harga_pekerjaan' => $request->harga_pekerjaan,
            'deskripsi' => $request->deskripsi,
            'status_pekerjaan' => $request->status_pekerjaan,
        ]);
        return redirect('jobs')->with('status', 'jobs post');
    }
    public function edit(int $id){
        $jobs = JobPosting::findOrFail($id);
        // return $jobs;
        return view('jobs.edit', compact('jobs'));
    }
}
