<?php

use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\DashboardController    ;

Route::get('/',[FrontendController::class,'index'])->name('index');

Route::get('/product-details', [FrontendController::class,'productDetails'])->name('product.details');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');


    Route::get('category', [CategoryController::class,'index'])->name('category');
    Route::get('category/create', [CategoryController::class,'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class,'store'])->name('category.store');
    Route::get('category/{id}/edit', [CategoryController::class,'edit'])->name('category.edit');
    Route::put('category/{id}', [CategoryController::class,'update'])->name('category.update');
    Route::delete('category/{id}', [CategoryController::class,'destroy'])->name('category.destroy');













});

require __DIR__.'/auth.php';
