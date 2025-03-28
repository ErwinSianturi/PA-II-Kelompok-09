<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserItemController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user');

Route::get('/home/customer', [App\Http\Controllers\HomeController::class, 'customer'])->middleware('user','fireauth');

Route::post('login/{provider}/callback', 'Auth\LoginController@handleCallback');

Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user','fireauth');

Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);

Route::resource('/img', App\Http\Controllers\ImageController::class);



Route::middleware('user','fireauth')->group(function () {
    Route::get('/items', [UserItemController::class, 'index'])->name('items.index');
    Route::post('/items', [UserItemController::class, 'store'])->name('items.store');
    Route::put('/items/{item}', [UserItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [UserItemController::class, 'destroy'])->name('items.destroy');
});
use App\Http\Controllers\JobPostingController;



Route::get('/jobs', [JobPostingController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobPostingController::class, 'create'])->name('jobs.create');
Route::post('/jobs', [JobPostingController::class, 'store'])->name('jobs.store');
Route::get('/jobs/{id}/edit', [JobPostingController::class, 'edit'])->name('jobs.edit');
Route::put('/jobs/{id}', [JobPostingController::class, 'update'])->name('jobs.update');
Route::delete('/jobs/{id}', [JobPostingController::class, 'destroy'])->name('jobs.destroy');
