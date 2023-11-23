<?php

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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

// Auth routes
// Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
// Route::post('/login', [App\Http\Controllers\AuthController::class, 'processLogin'])->name('auth.process-login');
// Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');
// Route::post('/register', [App\Http\Controllers\AuthController::class, 'processRegistration'])->name('auth.registration');
// Route::get('/forgot-password', [App\Http\Controllers\AuthController::class, 'forgotPassword'])->name('auth.forgot-password');

// Main pages
// Single page
Route::get('/employees', [App\Http\Controllers\SinglePageController::class, 'index'])->name('spa.main');

// Multiple pages
Route::get('/main', [App\Http\Controllers\EmployeeController::class, 'index'])->name('multiple.main');


Route::post('/employees', [App\Http\Controllers\SinglePageController::class, 'store'])->name('spa.store');

Route::put('/employee/update/{id}', [App\Http\Controllers\SinglePageController::class, 'update'])->name('spa.update');

Route::delete('/employee/delete/{id}', [App\Http\Controllers\SinglePageController::class, 'delete'])->name('spa.delete');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
