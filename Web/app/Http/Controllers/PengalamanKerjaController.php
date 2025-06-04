<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PengalamanKerja;
use App\Models\Profil;
use Illuminate\Http\Request;

class PengalamanKerjaController extends Controller
{
    // Show the form for creating a new Pengalaman Kerja
    public function create()
    {
        // Get the profile of the authenticated user
        $profil = Profil::where('email', Auth::user()->email)->first();

        // Check if the profile exists
        if (!$profil) {
            // Handle the case where the profile is not found
            return redirect()->route('addprofile');
        }

        // Pass the profil object to the view
        return view('profil.pengalaman.create', compact('profil'));
    }

    // Store a newly created Pengalaman Kerja
    public function store(Request $request)
    {
        // Back-end validation
        $request->validate([
            'position' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'start_date' => 'required|date|before:end_date', // Ensure start date is before end date
            'end_date' => 'nullable|date|after:start_date', // Ensure end date is after start date
            'is_current' => 'required|in:0,1',
            'job_function' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'job_level' => 'required|string|max:255',
            'job_type' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // If validation passes, save the Pengalaman Kerja
        PengalamanKerja::create($request->all());

        return redirect()->route('profil.index')->with('success', 'Pengalaman Kerja created successfully.');
    }


    // Show the form for editing an existing Pengalaman Kerja
    public function edit($id)
    {
        $pengalamanKerja = PengalamanKerja::findOrFail($id);
        $profil = Profil::where('email', Auth::user()->email)->first();
        return view('profil.pengalaman.edit', compact('pengalamanKerja', 'profil'));
    }

    // Update the specified Pengalaman Kerja
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:profils,id',
            'position' => 'required|string|max:100',
            'company_name' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'is_current' => 'required|boolean',
            'job_function' => 'required|string|max:100',
            'industry' => 'required|string|max:100',
            'job_level' => 'required|string|max:100',
            'job_type' => 'required|string|max:100',
            'description' => 'nullable|string',
        ]);

        $pengalamanKerja = PengalamanKerja::findOrFail($id);
        $pengalamanKerja->update($request->all());

        return redirect()->route('profil.index')->with('success', 'Pengalaman Kerja updated successfully!');
    }

    // Remove the specified Pengalaman Kerja
    public function destroy($id)
    {
        $pengalamanKerja = PengalamanKerja::findOrFail($id);
        $pengalamanKerja->delete();

        return redirect()->route('profil.index')->with('success', 'Pengalaman Kerja deleted successfully!');
    }

    // In your PengalamanKerjaController.php
    public function show($id)
    {
        // Retrieve the specific experience record by ID
        $pengalamanKerja = PengalamanKerja::findOrFail($id);

        // Pass the data to the view
        return view('profil.pengalaman.detail', compact('pengalamanKerja'));
    }
}
