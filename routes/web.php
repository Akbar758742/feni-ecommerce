<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\DashboardController    ;


Route::get('/',[FrontendController::class,'index'])->name('index');

Route::get('/product-details/{id}', [FrontendController::class,'productDetails'])->name('product.details');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');


    Route::get('category', [CategoryController::class,'index'])->name('category');
    Route::get('category/create', [CategoryController::class,'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class,'store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class,'edit'])->name('category.edit');
    Route::put('category/update/{id}', [CategoryController::class,'update'])->name('category.update');
    Route::get('category/delete/{id}', [CategoryController::class,'destroy'])->name('category.destroy');


 Route::get('sub-category', [SubCategoryController::class,'index'])->name('sub-category');
    Route::get('sub-category/create', [SubCategoryController::class,'create'])->name('sub-category.create');
    Route::post('sub-category/store', [SubCategoryController::class,'store'])->name('sub-category.store');
    Route::get('sub-category/edit/{id}', [SubCategoryController::class,'edit'])->name('sub-category.edit');
    Route::put('sub-category/update/{id}', [SubCategoryController::class,'update'])->name('sub-category.update');
    Route::get('sub-category/delete/{id}', [SubCategoryController::class,'destroy'])->name('sub-category.destroy');

    //products
    Route::get('product', [ProductController::class,'index'])->name('product');
    Route::get('product/create', [ProductController::class,'create'])->name('product.create');
    Route::post('product/store', [ProductController::class,'store'])->name('product.store');
    Route::get('product/edit/{id}', [ProductController::class,'edit'])->name('product.edit');
    Route::put('product/update/{id}', [ProductController::class,'update'])->name('product.update');
    Route::get('product/delete/{id}', [ProductController::class,'destroy'])->name('product.destroy');

    Route::post('get-subcategory', [ProductController::class,'getSubCategory'])->name('get-subcategory');


    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');














});

require __DIR__.'/auth.php';
