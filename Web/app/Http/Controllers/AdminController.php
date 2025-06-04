<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\Transaction;
use App\Models\PengalamanKerja;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;


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
            $Jobs = JobPosting::all();
            $Profil = Profil::where('email', '!=', Auth::user()->email)->get();
            $transaksi = Transaction::all();
            $users = Profil::where('email', '!=', Auth::user()->email)->get();

            // Calculate the sum of all the prices from all transactions
            $jlh_penghasilan = $transaksi->sum('biaya_admin');
            $jlh_kotor = $transaksi->sum('price');


            return view('admin.index', compact('Jobs', 'Profil', 'jlh_penghasilan', 'users', 'jlh_kotor'));
        } else {
            // If not admin, redirect to home
            return redirect('/home');
        }
    }
    public function delete(int $id)
    {
        // Retrieve the job by ID
        $job = JobPosting::findOrFail($id);


        // Delete images from the file system if they exist
        $imageFields = ['image1', 'image2', 'image3'];
        foreach ($imageFields as $imageField) {
            if ($job->$imageField && file_exists(public_path($job->$imageField))) {
                unlink(public_path($job->$imageField)); // Delete the file from the public directory
            }
        }

        // Delete the job from the database
        $job->delete();

        // Redirect with a success message
        return redirect('/')->with('status', 'Job deleted successfully!');
    }
    public function chatList()
    {
        // Ambil semua pengguna yang terdaftar di tabel profils, kecuali pengguna yang sedang login
        $users = Profil::where('email', '!=', Auth::user()->email)->get();

        return view('admin.chat', compact('users'));
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


        return view('admin.chatind', compact('messages', 'receiver'));
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
        return redirect()->route('chatadmin', ['userEmail' => $request->input('receiver_email')]);
    }
}
