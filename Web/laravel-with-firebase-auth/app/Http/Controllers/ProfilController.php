<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $profils = Profil::where('email', Auth::user()->email)->get();
        if (!$profils) {
            return redirect()->route('addprofile');
        }

        return view('profil.index', compact('profils'));
    }

public function store(Request $request)
{
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

    $imagePath = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('profile_images'), $filename);
        $imagePath = 'profile_images/' . $filename; // Relative path to be stored
    }

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

    return redirect('/profil')->with('status', 'Profil berhasil disimpan!');
}
}
