<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

// User Manage All Routes
Route::prefix('users')->group(function () {
    Route::get('/view', [UserController::class, 'userView'])->name('user.view');
    Route::get('/add', [UserController::class, 'userAdd'])->name('users.add');
    Route::post('/store', [UserController::class, 'userStore'])->name('users.store');
    Route::get('/edit/{id}', [UserController::class, 'userEdit'])->name('users.edit');
    Route::post('/update/{id}', [UserController::class, 'userUpdate'])->name('users.update');
    Route::get('/delete/{id}', [UserController::class, 'userDelete'])->name('users.delete');
});

// USER PROFILE AND PASSWORD
Route::prefix('profile')->group(function () {
    Route::get('/view', [ProfileController::class, 'profileView'])->name('profile.view');
    Route::get('/edit', [ProfileController::class, 'profileEdit'])->name('profile.edit');
    Route::post('/store', [ProfileController::class, 'profileStore'])->name('profile.store');
    Route::get('/password/view', [ProfileController::class, 'passwordView'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');



});
