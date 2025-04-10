<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    // Show the profile page
    public function index()
    {
        // Get the profile of the authenticated user
        $profils = Profil::where('email', Auth::user()->email)->get();

        // If no profile exists, redirect to add profile page
        if ($profils->isEmpty()) {
            return redirect()->route('addprofile');
        }

        return view('profil.index', compact('profils'));
    }

    // Show the form for creating a new profile
    public function create()
    {
        return view('profil.addprofil');
    }

    // Store a newly created profile
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'email' => 'required|email',
            'username' => 'required|string|max:255',
            'harga_pekerjaan' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'provinsi' => 'required|string',
            'desa' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'pekerjaan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload if available
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_images'), $filename);
            $imagePath = 'profile_images/' . $filename; // Store relative path
        }

        // Create a new profile record in the database
        Profil::create([
            'email' => $request->email,
            'username' => $request->username,
            'harga_pekerjaan' => $request->harga_pekerjaan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'provinsi' => $request->provinsi,
            'desa' => $request->desa,
            'alamat_lengkap' => $request->alamat_lengkap,
            'pekerjaan' => $request->pekerjaan,
            'image' => $imagePath,
        ]);

        // Redirect to profile page after storing
        return redirect('/profil');
    }

    // Show the form for editing an existing profile
    public function edit($id)
    {
        // Find the profile by ID
        $profil = Profil::findOrFail($id);

        return view('profil.editprofil', compact('profil'));
    }

    // Update an existing profile
    // Update an existing profile
    public function update(Request $request, $id)
    {
        // Find the profile by ID
        $profil = Profil::findOrFail($id);

        // Validate the form data
        $validated = $request->validate([
            'email' => 'required|email',
            'username' => 'required|string|max:255',
            'harga_pekerjaan' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'provinsi' => 'required|string',
            'desa' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'pekerjaan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload if available
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($profil->image && file_exists(public_path($profil->image))) {
                unlink(public_path($profil->image)); // Delete old image
            }

            // Upload the new image
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_images'), $filename);
            $imagePath = 'profile_images/' . $filename;

            // Update the image path
            $profil->image = $imagePath;
        }

        // Update the profile with the new data, preserving existing image if no new image was uploaded
        $profil->update([
            'email' => $validated['email'],
            'username' => $validated['username'],
            'harga_pekerjaan' => $validated['harga_pekerjaan'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'provinsi' => $validated['provinsi'],
            'desa' => $validated['desa'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'pekerjaan' => $validated['pekerjaan'],
            // Only update the image if a new one was uploaded
            'image' => isset($imagePath) ? $imagePath : $profil->image,
        ]);

        // Redirect to profile index page after updating
        return redirect()->route('profil.index');
    }
}
