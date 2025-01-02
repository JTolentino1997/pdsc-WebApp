<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Library;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');





Route::middleware('auth')->group(function () {

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    

    //Library
    Route::name('library.')->prefix('library')->group(function(){
        Route::get('/brand', [Library::class, 'brandIndex'])->name('brand');
        Route::post('/brand/create', [Library::class, 'createBrand'])->name('createBrand');
         
        Route::get('/department', [Library::class, 'departmentIndex'])->name('department');
        Route::post('/department/create', [Library::class, 'createDepartment'])->name('createDepartment');
        Route::delete('/department/delete{id}', [Library::class, 'deleteDepartment'])->name('deleteDepartment');

        Route::get('/user', [Library::class, 'createUser'])->name('createUser');
        Route::post('/user/create', [Library::class, 'saveUser'])->name('saveUser');
    Route::patch('/user/update', [AdminController::class, 'updateUser'])->name('updateUser');

        Route::delete('/user/delete{id}', [Library::class, 'deleteUser'])->name('deleteUser');


    });
    
    
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    
});

// Route::name('admin.')->prefix('admin')->group(function() {
//     Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
// });
 
// Route::name('library.')->prefix('library')->middleware(['auth'])->group(function() {
//     Route::get('/user', [AdminController::class, 'createUser'])->name('createUser');
//     Route::post('/user/create', [AdminController::class, 'saveUser'])->name('saveUser');
//     Route::patch('/user/update', [AdminController::class, 'updateUser'])->name('updateUser');
//     Route::delete('/user/delete{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
    
// });
 
require __DIR__.'/auth.php';
