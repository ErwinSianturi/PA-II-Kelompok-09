<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Profil;
use App\Models\PengalamanKerja;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    // Show the profile page
    public function index()
    {
        // Get the profile of the authenticated user
        $profils = Profil::where('email', Auth::user()->email)->first();  // Use first() to get a single profile

        // If no profile exists, redirect to the add profile page
        if (!$profils) {
            return redirect()->route('addprofile');
        }

        // Get the Pengalaman Kerja for the user based on the user_id
        $pengalamanKerja = PengalamanKerja::where('user_id', $profils->id)->get();

        // Pass the profile and Pengalaman Kerja to the view
        return view('profil.index', compact('profils', 'pengalamanKerja'));
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
            'kecamatan' => 'required|in:Ajibata,Balige,Bonatua Lunasi,Borbor,Habinsaran,Laguboti,Lumban Julu,Nassau,Parmaksian,Pintu Pohan Meranti,Porsea,Siantar Narumonda,Sigumpar,Silaen,Tampahan,Uluan',
            'desa' => 'required|string',
            'WA' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'pekerjaan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
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
            'kecamatan' => $request->kecamatan,
            'WA' => $request->WA,
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
        // Find the profile by email using Query Builder
        $profil = Profil::where('id', $id)->first();

        return view('profil.editprofil', compact('profil'));
    }



    public function update(Request $request, $id)
    {
        // Find the profile by ID
        $profil = Profil::where('id', $id)->first();

        // Validate the form data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'harga_pekerjaan' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'kecamatan' => 'required|string',
            'desa' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'pekerjaan' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Handle the image upload if a new one is provided
        if ($request->hasFile('image')) {
            if ($profil->image && file_exists(public_path($profil->image))) {
                unlink(public_path($profil->image)); // Delete the old image
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('profile_images'), $filename);
            $imagePath = 'profile_images/' . $filename;
        } else {
            $imagePath = $profil->image; // Keep the existing image if no new one is uploaded
        }

        // Update the profile with validated data
        $profil->update([
            'username' => $validated['username'],
            'harga_pekerjaan' => $validated['harga_pekerjaan'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'kecamatan' => $validated['kecamatan'],
            'desa' => $validated['desa'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'pekerjaan' => $validated['pekerjaan'],
            'image' => $imagePath,  // Update the image field
        ]);

        // Redirect to profile index page
        return redirect()->route('profil.index')->with('success', 'Profile updated successfully!');
    }

    public function show($email)
    {
        $profils = Profil::where('email', $email)->firstOrFail();
        $pengalamanKerja = PengalamanKerja::where('user_id', $profils->id)->get();

        return view('users.show', compact('profils', 'pengalamanKerja'));
    }

    public function setNonAktif($id)
    {
        // Find the profile by ID
        $profil = Profil::where('id', $id)->first();

        // Update the 'status_akun' to 'Non-Aktif'
        $profil->status_akun = 'Non-Aktif';
        $profil->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User status has been set to Non-Aktif.');
    }

    public function setAktif($id)
    {
        // Find the profile by its ID
        $profil = Profil::where('id', $id)->first();

        // Update the 'status_akun' to 'Aktif'
        $profil->status_akun = 'Aktif';
        $profil->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User status has been set to Aktif.');
    }
}
