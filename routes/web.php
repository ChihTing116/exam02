<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\MessageController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;


Route::get('/', function () {
    return redirect()->route('messages.index');
});

// Route::get('/messages',[MessageController::class, 'index'])->name('messages.index');
// Route::post('/messages',[MessageController::class,'store'])->name('messages.store');
// Route::get('/messages/{message}/edit',[MessageController::class,'edit'])->name('messages.edit');
// Route::patch('/messages/{message}',[MessageController::class,'update'])->name('messages.update');
// Route::delete('/messages/{message}',[MessageController::class,'destroy'])->name('messages.destroy');

Route::resource('messages',MessageController::class)->except(['create','show']);
//resource

// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);


// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');



Route::get('/password/change', [PasswordController::class, 'show'])->name('password.change');
Route::post('/password/change', [PasswordController::class, 'update'])->name('password.update');



// Route::get('/login', function () {
//     return '請自行實作登入頁面';
// })->name('login');
