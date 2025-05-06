<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        // Apply the auth middleware
        $this->middleware('auth');
    }

    public function index()
    {
        // Check if the logged-in user is the admin
        if (Auth::user()->email !== 'admin@gmail.com') {
            return redirect('/home')->with('error', 'Access Denied');
        }

        return view('admin.index');
    }
}
