<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::redirect('/', '/home');

Route::get('/home', [HomeController::class, 'viewHome'])->name('home');
Route::get('/contact', [ContactController::class, 'viewForm'])->name('contact');

Route::get('/signup', [SignupController::class, 'viewForm'])->name('form-signup');
Route::post('/signup', [SignupController::class, 'signup'])->name('signup');

Route::get('/login', [LoginController::class, 'viewForm'])->name('form-login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class , 'logout'])->name('logout');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard-home');
});

Route::get('/login-admin', [AdminController::class, 'viewForm'])->name('admin-form');
Route::post('/login-admin', [AdminController::class, 'login'])->name('login-admin');

Route::middleware(['admin'])->group(function() {
    Route::prefix('/admin')->name('admin.')->group(function() {

        Route::prefix('/users')->name('users.')->group(function() {
            Route::get('/', [AdminController::class, 'viewTable'])->name('users-table');
            Route::get('/create', [AdminController::class, 'createUser'])->name('create-user');
            Route::get('/edit/{id}', [AdminController::class, 'editUser'])->name('edit-user');
            Route::delete('/{id}', [AdminController::class, 'deleteUser'])->name('delete-user');
            Route::match(['POST', 'PUT', 'PATCH'],'/{id?}', [AdminController::class, 'saveUser'])->name('save-user');
        });
    });
});
