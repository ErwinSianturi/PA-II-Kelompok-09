<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserItemController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\ProfilController;




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


Route::get('/profil/{id}/edit', [ProfilController::class, 'edit']);
Route::put('/profil/{id}/edit', [ProfilController::class, 'update']);

Route::get('/jobs/{id}/delete', [JobsController::class, 'delete']);




Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
Route::get('/addprofile', [ProfilController::class, 'create'])->name('addprofile');
Route::post('/addprofile', [ProfilController::class, 'store'])->name('profile.store');


