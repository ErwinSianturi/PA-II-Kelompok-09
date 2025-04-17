<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserItemController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfilController;
use App\Models\profil;


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
Route::put('jobs/{id}', [JobsController::class, 'update']);
Route::get('jobs/{id}/delete', [JobsController::class, 'delete']);
Route::get('jobs/{jobId}/applicants', [JobsController::class, 'showApplicants']);
Route::get('jobs/{jobId}/apply', [JobsController::class, 'apply']);

Route::get('users/{email}', [profilController::class, 'show'])->name('users.show');

