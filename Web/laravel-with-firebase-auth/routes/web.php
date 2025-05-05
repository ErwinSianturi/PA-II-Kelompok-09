<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserItemController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfilController;
use App\Models\profil;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user');
Route::get('/home/customer', [App\Http\Controllers\HomeController::class, 'customer'])->middleware('user', 'fireauth');
Route::post('login/{provider}/callback', 'Auth\LoginController@handleCallback');
Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user', 'fireauth');
Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);
Route::resource('/img', App\Http\Controllers\ImageController::class);

Route::get('/jobs', [JobsController::class, 'index']);
Route::get('/jobs/create', [JobsController::class, 'create']);
Route::post('/jobs/create', [JobsController::class, 'store']);

Route::get('/jobs/{id}/edit', [JobsController::class, 'edit']);
Route::put('/jobs/{id}/edit', [JobsController::class, 'update']);
Route::get('/kategori/{jenis_pekerjaan}', [JobsController::class, 'showCategory'])->name('category.show');
Route::post('/job/{id}/apply', [JobsController::class, 'apply'])->name('job.apply');
Route::get('/jobs/{job}/apply', [JobsController::class, 'applyForm'])->name('job.applyForm');


Route::get('/profil/{id}/edit', [ProfilController::class, 'edit']);
Route::put('/profil/{id}/edit', [ProfilController::class, 'update']);

Route::get('/jobs/{id}/delete', [JobsController::class, 'delete']);

Route::get('jobs/{id}/detail', [JobsController::class, 'showdetil']);



Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
Route::get('/addprofile', [ProfilController::class, 'create'])->name('addprofile');
Route::post('/addprofile', [ProfilController::class, 'store'])->name('profile.store');


Route::get('jobs/{jobId}/applicants', [JobsController::class, 'showApplicants'])->name('jobs.applicants');


Route::get('jobs', [JobsController::class, 'index']);
Route::get('jobs/create', [JobsController::class, 'create']);
Route::post('jobs', [JobsController::class, 'store']);
Route::get('jobs/{id}/edit', [JobsController::class, 'edit']);
Route::put('jobs/{id}', [JobsController::class, 'update'])->name('job.update');
Route::get('jobs/{id}/delete', [JobsController::class, 'delete']);
Route::get('jobs/{jobId}/applicants', [JobsController::class, 'showApplicants']);
Route::get('jobs/{jobId}/apply', [JobsController::class, 'apply']);

Route::put('jobs/{id}', [JobsController::class, 'update'])->name('jobs.update');

Route::get('users/{email}', [profilController::class, 'show'])->name('users.show');

Route::post('jobs/{jobId}/accept-user/{userEmail}', [JobsController::class, 'acceptUser'])->name('assign.user.job');

Route::post('/jobs/{jobId}/accept/{userEmail}', [JobsController::class, 'acceptUser'])->name('jobs.acceptUser');

Route::put('jobs/{id}/assign', [JobsController::class, 'assignUser'])->name('jobs.assign');

Route::put('jobs/{job}/start', [JobsController::class, 'start'])->name('jobs.start');
Route::put('jobs/{job}/finish', [JobsController::class, 'finish'])->name('jobs.finish');



Route::post('/checkout', [TransactionController::class, 'process'])->name("checkout-process");

Route::get('/checkout/{transaction}', [TransactionController::class, 'checkout'])->name('checkout');

Route::get('/checkout/success/{transaction}', [TransactionController::class, 'success']) ->name("chekcout-success");

Route::get('jobs/{job}/bayar', [TransactionController::class, 'show'])->name("show.bayar");


