<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfilController;
use App\Models\Profil;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PengalamanKerjaController;
use App\Models\Transaction;
use App\Http\Middleware\AdminRedirect;
use App\Http\Controllers\AdminController;

// Root Route - Redirect to Admin if logged in as Admin, otherwise to home
Route::get('/', function () {
    // If logged in as 'admin@gmail.com', redirect to /admin
    if (auth()->check() && auth()->user()->email === 'admin@gmail.com') {
        return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
    }

    // Default redirect to home if not admin
    return redirect()->route('home');
})->middleware('auth');

// Admin Routes - Protected by Admin middleware
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Authentication Routes
Auth::routes();

// Home Routes - For general users
Route::get('/home', function () {
    // If logged in as 'admin@gmail.com', redirect to /admin
    if (auth()->check() && auth()->user()->email === 'admin@gmail.com') {
        return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
    }

    // Default route for general users
    return app(App\Http\Controllers\HomeController::class)->index();
})->name('home')->middleware('user');

Route::get('/home/customer', [App\Http\Controllers\HomeController::class, 'customer'])->middleware('user', 'fireauth');

// Profile Routes - For authenticated users
Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user', 'fireauth');
Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);
Route::resource('/img', App\Http\Controllers\ImageController::class);

// Job Routes - Managing jobs
Route::get('/jobs', [JobsController::class, 'index']);
Route::get('/jobs/create', [JobsController::class, 'create'])->name('jobs.create');
Route::post('/jobs/create', [JobsController::class, 'store'])->name('jobs.store');
Route::get('jobs/create', [JobsController::class, 'create'])->name('jobs.create');
Route::post('jobs', [JobsController::class, 'store'])->name('jobs.store');
Route::get('/jobs/{id}/edit', [JobsController::class, 'edit']);
Route::put('/jobs/{id}/edit', [JobsController::class, 'update']);
Route::get('/kategori/{jenis_pekerjaan}', [JobsController::class, 'showCategory'])->name('category.show');
Route::post('/job/{id}/apply', [JobsController::class, 'apply'])->name('job.apply');
Route::get('/jobs/{job}/apply', [JobsController::class, 'applyForm'])->name('job.applyForm');
Route::get('/jobs/{id}/delete', [JobsController::class, 'delete']);
Route::get('jobs/{id}/detail', [JobsController::class, 'showdetil']);
Route::get('jobs/{jobId}/applicants', [JobsController::class, 'showApplicants'])->name('jobs.applicants');
Route::post('/jobs', [JobsController::class, 'store']);

// Profile Management Routes
Route::get('/profil/{id}/edit', [ProfilController::class, 'edit']);
Route::put('/profil/{id}/edit', [ProfilController::class, 'update'])->name('profil.update');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
Route::get('/addprofile', [ProfilController::class, 'create'])->name('addprofile');
Route::post('/addprofile', [ProfilController::class, 'store'])->name('addprofile.store'); // Changed the name here
Route::post('/profil/{id}/nonaktif', [ProfilController::class, 'setNonAktif'])->name('profil.setNonAktif');
Route::post('/profil/{id}/aktif', [ProfilController::class, 'setAktif'])->name('profil.setAktif');


// Job Application Routes - Accept or reject users for jobs
Route::post('/jobs/{jobId}/accept/{userEmail}', [JobsController::class, 'acceptUser'])->name('jobs.acceptUser');
Route::post('jobs/{jobId}/accept-user/{userEmail}', [JobsController::class, 'assignUser'])->name('assign.user.job');
Route::get('users/{email}', [profilController::class, 'show'])->name('users.show');


// Job Status Routes - Start and finish job actions
Route::put('jobs/{job}/start', [JobsController::class, 'start'])->name('jobs.start');
Route::put('jobs/{job}/finish', [JobsController::class, 'finish'])->name('jobs.finish');

// Transaction Routes - Checkout process and success
Route::post('/checkout', [TransactionController::class, 'process'])->name("checkout-process");
Route::get('/checkout/{transaction}', [TransactionController::class, 'checkout'])->name('checkout');
Route::get('/checkout/success/{transaction}', [TransactionController::class, 'success'])->name("chekcout-success");
Route::get('jobs/{job}/bayar', [TransactionController::class, 'show'])->name("show.bayar");
Route::get('/checkout/success/{transaction}', [TransactionController::class, 'success'])->name("chekcout-success");

//Admin
Route::get('{id}/delete', [AdminController::class, 'delete']);


//Pengalaman Kerja
Route::get('/pengalaman/create', [PengalamanKerjaController::class, 'create'])->name('pengalaman.create');
Route::post('/pengalaman/store', [PengalamanKerjaController::class, 'store'])->name('pengalaman.store');
Route::get('/pengalaman/{id}/edit', [PengalamanKerjaController::class, 'edit'])->name('pengalaman.edit');
Route::put('/pengalaman/{id}', [PengalamanKerjaController::class, 'update'])->name('pengalaman.update');
Route::delete('/pengalaman/{id}', [PengalamanKerjaController::class, 'destroy'])->name('pengalaman.destroy');
Route::get('/pengalaman/{id}', [PengalamanKerjaController::class, 'show'])->name('pengalaman.show');


//kategori
Route::get('/kategori/{jenis_pekerjaan}/Tersedia', [JobsController::class, 'showCategorytersedia']);

// Menampilkan daftar percakapan
Route::get('/obrolan', [ChatController::class, 'chatList'])->name('chatList');

// Menampilkan percakapan dengan pengguna tertentu berdasarkan email
Route::get('/obrolan/{userEmail}', [ChatController::class, 'chat'])->name('chat');

// Mengirim pesan
Route::post('/obrolan/send', [ChatController::class, 'sendMessage']);
