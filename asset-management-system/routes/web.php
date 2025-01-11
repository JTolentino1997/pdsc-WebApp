<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibraryController;
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
       
        //brand
        Route::get('/brand', [LibraryController::class, 'brandIndex'])->name('brand');
        Route::post('/brand/create', [LibraryController::class, 'createBrand'])->name('createBrand');
        Route::delete('/brand/delete{id}',[LibraryController::class, 'deleteBrand'])->name('deleteBrand');
        Route::patch('/brand/update', [LibraryController::class, 'updateBrand'])->name('updateBrand');

        //department
        Route::get('/department', [LibraryController::class, 'departmentIndex'])->name('department');
        Route::post('/department/create', [LibraryController::class, 'createDepartment'])->name('createDepartment');
        Route::delete('/department/delete{id}', [LibraryController::class, 'deleteDepartment'])->name('deleteDepartment');
        Route::patch('/department/update', [LibraryController::class, 'updateDepartment'])->name('updateDepartment');

        //user
        Route::get('/user', [LibraryController::class, 'createUser'])->name('createUser');
        Route::post('/user/create', [LibraryController::class, 'saveUser'])->name('saveUser');
        Route::patch('/user/update', [LibraryController::class, 'updateUser'])->name('updateUser');
        Route::delete('/user/delete{id}', [LibraryController::class, 'deleteUser'])->name('deleteUser');

        //supplier
        Route::get('/supplier', [LibraryController::class, 'supplierIndex'])->name('supplier');
        Route::post('/supplier/create', [LibraryController::class, 'createSupplier'])->name('createSupplier');
        Route::delete('/supplier/delete{id}', [LibraryController::class, 'deleteSupplier'])->name('deleteSupplier');
        Route::patch('/supplier/update', [LibraryController::class, 'updateSupplier'])->name('updateSupplier');
    });
    
    
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    // Route::patch('/user/update', [AdminController::class, 'updateUser'])->name('updateUser');
    
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
