<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;

class JobPostingController extends Controller
{
    // Tampilkan semua pekerjaan
    public function index()
    {
        $jobs = JobPosting::all();
        return view('jobs.index', compact('jobs'));
    }

    // Tampilkan form tambah pekerjaan
    public function create()
    {
        return view('jobs.create');
    }

    // Simpan pekerjaan ke database
    public function store(Request $request)
    {
        dd($request->all());
        $validated = $request->validate([
            'nama_pekerjaan' => 'required|string',
            'email' => 'required|email',
            'harga_pekerjaan' => 'required|numeric',
            'deskripsi' => 'required|string',
            'status_pekerjaan' => 'required|in:open,closed'
        ]);

        JobPosting::create($validated);

        return redirect()->route('jobs.index')->with('success', 'Pekerjaan berhasil ditambahkan!');
    }

    // Tampilkan form edit pekerjaan
    public function edit($id)
    {
        $job = JobPosting::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    // Update data pekerjaan
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pekerjaan' => 'required|string',
            'email' => 'required|email',
            'harga_pekerjaan' => 'required|numeric',
            'deskripsi' => 'required|string',
            'status_pekerjaan' => 'required|in:open,closed'
        ]);

        $job = JobPosting::findOrFail($id);
        $job->update($validated);

        return redirect()->route('jobs.index')->with('success', 'Pekerjaan berhasil diperbarui!');
    }

    // Hapus pekerjaan
    public function destroy($id)
    {
        JobPosting::destroy($id);
        return redirect()->route('jobs.index')->with('success', 'Pekerjaan berhasil dihapus!');
    }
}
