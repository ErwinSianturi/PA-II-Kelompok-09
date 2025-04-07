<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $profils = profil::all(); // ambil semua data dari tabel profils
        return view('profil.index', compact('profils'));
    }
}
