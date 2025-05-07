<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Apply authentication middleware to the admin routes
        $this->middleware('auth');
    }

    public function dashboard()
    {
        // Check if the logged-in user is the admin
        if (auth()->user()->email === 'admin@gmail.com') {
            return view('admin.index'); // Admin dashboard view
        } else {
            return redirect('/home'); // Redirect to home page if not admin
        }
    }
}
