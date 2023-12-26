<?php



namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::resource('contact', ContactController::class);
// Route::get('/contact/{id}', [ContactController::class, 'getContactById']);

// Route::get('/contacts', [ContactController::class, 'getAllCustomers']);
// Route::post('/contacts', [ContactController::class, 'store']);
// Route::put('/contacts/{id}', [ContactController::class, 'update']);
// Route::delete('/contacts/{id}', [ContactController::class, 'delete']);

Route::post('/login', [AuthController::class, 'login'])->name('api.user.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.user.register');
Route::get('/user', [AuthController::class, 'getUser'])->name('api.user.user');


Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
