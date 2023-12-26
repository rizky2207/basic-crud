<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware(['auth'])->group(function () {
    Route::resource('contact', ContactController::class);
});

// Route::resource('register', AuthController::class);
// Route::resource('login', AuthController::class);


Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.show');
// Rute untuk memproses pendaftaran admin
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');


// Route tampil login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');

// Route proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
