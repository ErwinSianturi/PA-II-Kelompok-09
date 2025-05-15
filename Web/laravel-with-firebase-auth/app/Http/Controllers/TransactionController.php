<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {

        $transactions = Transaction::where('user_id', Auth::user()->id)->get();

        $transactions->transform(function ($transaction, $key) {
            $transaction->product = collect(config('products'))->firstWhere('id', $transaction->product_id);
            return $transaction;
        });


        return view('transactions', compact('transactions'));
    }
    public function process(Request $request)
    {
        $data = $request->all();

        // Check if a transaction with the same job_id already exists
        $existingTransaction = Transaction::where('job_id', $data['job_id'])->where('status', '!=', 'paid')->first();

        if ($existingTransaction) {
            // Redirect to the existing transaction
            return redirect()->route('checkout', $existingTransaction->id)
                ->with('info', 'Pembayaran untuk pekerjaan ini sudah dimulai, silakan lanjutkan pembayaran.');
        }

        // If no existing transaction, create a new one
        $transaction = Transaction::create([
            'email' => Auth::user()->email,
            'job_id' => $data['job_id'],
            'price' => $data['price'],
            'biaya_admin' => $data['biaya_admin'],
            'status' => 'pending',
        ]);

        // Set Midtrans configurations
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false; // Use false for sandbox
        \Midtrans\Config::$isSanitized = true;  // Enable sanitization
        \Midtrans\Config::$is3ds = true;        // Enable 3DS for credit card transactions

        // Prepare the transaction parameters for Midtrans
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $data['price'],
            ),
            'customer_details' => array(
                'email' => Auth::user()->email,
            ),
        );

        // Get the snap token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Save the snap token to the transaction
        $transaction->snap_token = $snapToken;
        $transaction->save();

        // Redirect to the checkout page for the new transaction
        return redirect()->route('checkout', $transaction->id);
    }


    public function checkout(Transaction $transaction)
    {
        $product = JobPosting::findOrFail($transaction->job_id);

        return view('jobs.checkout',  compact('transaction', 'product'));
    }

    public function success(Transaction $transaction)
    {
        $transaction->status = 'success';
        $transaction->save();

        JobPosting::where('email', Auth::user()->email)
            ->where('id', $transaction->job_id) // Corrected this line
            ->update(['status' => 'success']);

        $postedJobs = JobPosting::where('email', Auth::user()->email)
            ->where('status_pekerjaan', 'Tersedia')
            ->get();

        $takenJobs = JobPosting::where('email_pengambil', Auth::user()->email)->get();

        $ongoingJobs = JobPosting::where('email', Auth::user()->email)
            ->where('status_pekerjaan', 'Dalam Proses')
            ->get();

        $doneJobs = JobPosting::where('email', Auth::user()->email)
            ->where('status_pekerjaan', 'Selesai')
            ->get();

        return view('jobs.index', compact('postedJobs', 'takenJobs', 'ongoingJobs', 'doneJobs'));
    }

    public function show($job)
    {

        $job = JobPosting::findOrFail($job);
        return view('jobs.bayar', compact('job'));
    }
}
