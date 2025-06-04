<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    // Display a list of all pendidikan
    public function index()
    {
        $pendidikan = pendidikan::all();
        return view('profil.Pendidikan.index', compact('pendidikan'));
    }

    // Show the form for creating a new pendidikan
    public function create()
    {
        return view('profil.Pendidikan.create');
    }

    // Store a newly created pendidikan in storage
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'jenjang_pendidikan' => 'required|string|max:255',
            'nama_institusi' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
        ]);

        // Create a new pendidikan record
        pendidikan::create([
            'jenjang_pendidikan' => $request->jenjang_pendidikan,
            'nama_institusi' => $request->nama_institusi,
            'jurusan' => $request->jurusan,
            'email' => Auth::user()->email,
        ]);

        // Redirect with success message
        return redirect()->route('profil.index')
            ->with('success', 'Pendidikan created successfully.');
    }


    // Show the form for editing the specified pendidikan
    public function edit(pendidikan $pendidikan)
    {
        return view('profil.Pendidikan.edit', compact('pendidikan'));
    }

    // Update the specified pendidikan in storage
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'jenjang_pendidikan' => 'required|string|max:255',
            'nama_institusi' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
        ]);

        // Find the record to update
        $pendidikan = pendidikan::findOrFail($id);

        // Update the record with the validated data
        $pendidikan->update($request->all());

        // Redirect back with success message
        return redirect()->route('profil.index')->with('success', 'Pendidikan updated successfully.');
    }
    // Remove the specified pendidikan from storage
    public function destroy(pendidikan $pendidikan)
    {
        $pendidikan->delete();

        return redirect()->route('profil.index')
            ->with('success', 'Pendidikan deleted successfully.');
    }
}
