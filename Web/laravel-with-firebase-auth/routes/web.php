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

Route::get('/home/customer', [App\Http\Controllers\HomeController::class, 'customer'])->middleware('user', 'fireauth');

Route::post('login/{provider}/callback', 'Auth\LoginController@handleCallback');

Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user', 'fireauth');

Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);

Route::resource('/img', App\Http\Controllers\ImageController::class);



Route::middleware('user', 'fireauth')->group(function () {
    Route::get('/items', [UserItemController::class, 'index'])->name('items.index');
    Route::post('/items', [UserItemController::class, 'store'])->name('items.store');
    Route::put('/items/{item}', [UserItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [UserItemController::class, 'destroy'])->name('items.destroy');
});

use App\Http\Controllers\JobsController;




Route::get('/jobs', [JobsController::class, 'index']);
Route::get('/jobs/create', [JobsController::class, 'create']);
Route::post('/jobs/create', [JobsController::class, 'store']);
