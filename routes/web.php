<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BeforeLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BeforeLoginController::class, 'login_page'])->name('login');
Route::get('/reset-password', [BeforeLoginController::class, 'resetpswd_page'])->name('resetpswd');
Route::post('/login-process', [BeforeLoginController::class, 'login_process'])->name('login-process');
Route::post('/reset-process', [BeforeLoginController::class, 'reset_process'])->name('reset-process');
Route::get('/logout', [BeforeLoginController::class, 'logout'])->name('logout');

Route::prefix('dashboard')->group(function() {
    // RESOURCE
    Route::resource('user', UserController::class);
    Route::resource('book', BookController::class);

    Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/authors', [UserController::class, 'authors'])->name('authors');
    Route::get('/users', [UserController::class, 'users'])->name('users');
    Route::get('/books', [BookController::class, 'books'])->name('books');

    Route::get('/setting', [UserController::class, 'setting_page'])->name('setting_page');
    Route::post('/setting-update', [UserController::class, 'setting_update'])->name('setting_update');
            
});

