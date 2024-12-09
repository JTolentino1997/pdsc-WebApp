<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('mainDashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::name('admin.')->prefix('admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'mainDashboard'])->name('mainDashBoard');
    })->middleware(['auth, verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::name('admin.')->prefix('admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});


Route::name('library.')
    ->prefix('library')
    ->middleware(['auth'])
    ->group(function() {
    Route::get('/user', [AdminController::class, 'createUser'])->name('createUser');
    Route::post('/user/create', [AdminController::class, 'saveUser'])->name('saveUser');
    Route::patch('/user/update', [AdminController::class, 'updateUser'])->name('updateUser');
    Route::delete('/user/delete{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
});

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth, verified'])
    ->group(function() {
    Route::get('/dashboard', [AdminController::class, 'mainDashboard'])->name('mainDashBoard');
    });

// Route::get('/login', [AdminController::class, 'redirectLogin'])->name('redirectLogin');
// Route::post('/login', [AdminController::class, 'login'])->name('login');

Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

require __DIR__.'/auth.php';
