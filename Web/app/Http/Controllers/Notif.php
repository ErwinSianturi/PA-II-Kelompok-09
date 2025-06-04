<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notification;

class Notif extends Controller
{


    public function notif()
    {
        // Fetch the notifications for the logged-in user
        $notifications = Notification::where('email_pengguna', Auth::user()->email)
            ->where('is_read', false)
            ->get();

        // Pass the data to the view
        return view('layouts.app', compact('notifications'));
    }
    public function markAsRead()
    {
        // Update all unread notifications for the logged-in user
        Notification::where('email_pengguna', Auth::user()->email)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['status' => 'success']);
    }
}
