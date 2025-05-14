<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Profil;

class ChatController extends Controller
{
    // Menampilkan daftar chat dengan semua pengguna yang terlibat
    public function chatList()
    {
        // Ambil semua pengguna yang terdaftar di tabel profils, kecuali pengguna yang sedang login
        $users = Profil::where('email', '!=', Auth::user()->email)->get();

        return view('chat.list', compact('users'));
    }

    // Menampilkan chat dengan pengguna tertentu berdasarkan email
    public function chat($userEmail)
    {
        // Get the logged-in user's email
        $senderEmail = Auth::user()->email;

        // Fetch the messages between the logged-in user and the selected user
        $messages = Message::where(function ($query) use ($senderEmail, $userEmail) {
            $query->where('sender_email', $senderEmail)
                ->where('receiver_email', $userEmail);
        })
            ->orWhere(function ($query) use ($senderEmail, $userEmail) {
                $query->where('sender_email', $userEmail)
                    ->where('receiver_email', $senderEmail);
            })
            ->orderBy('created_at', 'asc')  // Order messages by creation time (ascending)
            ->get();

        // Fetch the receiver's profile by email
        $receiver = Profil::where('email', $userEmail)->firstOrFail();

        // Return only the messages HTML content as a response (for AJAX)
        if (request()->ajax()) {
            // Render the messages in the HTML format using the 'chat.messages' view
            $messagesHtml = view('chat.messages', compact('messages', 'receiver'))->render();
            return response()->json(['messages' => $messagesHtml]);
        }

        // Return the full chat page when not an AJAX request
        return view('chat.index', compact('messages', 'receiver'));
    }

    // Fungsi untuk mengirim pesan
    public function sendMessage(Request $request)
    {
        // Validasi input
        $request->validate([
            'receiver_email' => 'required|exists:profils,email',
            'message' => 'required|string|max:255',
        ]);

        // Menyimpan pesan baru ke dalam database
        Message::create([
            'sender_email' => Auth::user()->email,  // Sender's email (from Auth)
            'receiver_email' => $request->input('receiver_email'),  // Receiver's email
            'message' => $request->input('message'),  // The message content
        ]);

        // Redirect ke halaman percakapan setelah pengiriman pesan
        return redirect()->route('chat', ['userEmail' => $request->input('receiver_email')]);
    }
}
