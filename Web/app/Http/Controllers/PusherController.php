<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PusherController extends Controller
{
    // Show the chat page with users
    public function index()
{
    // Fetch all users from the "profils" table
    $users = \App\Models\Profil::all();

    // Return the view and pass the users data
    return view('chat.index', compact('users'));
}
    // Fetch messages for a specific chat
    public function getMessages($receiverId)
    {
        $user = Auth::user();

        // Fetch messages between the logged-in user and the receiver
        $messages = Message::where(function ($query) use ($user, $receiverId) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $receiverId);
        })
            ->orWhere(function ($query) use ($user, $receiverId) {
                $query->where('sender_id', $receiverId)
                    ->where('receiver_id', $user->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    // Broadcast the message using Pusher
    public function broadcast(Request $request)
    {
        $user = Auth::user();

        // Save the message to the database
        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->get('message')
        ]);

        // Broadcast the message
        broadcast(new PusherBroadcast($message))->toOthers();

        return response()->json(['message' => $message]);
    }
}
