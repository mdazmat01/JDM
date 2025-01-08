<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;

Route::name('home.')->group(function() {
    Route::get('/',[HomeController::class, 'index'])->name('welcome');
});

Route::middleware('auth')->group(function() {
    Route::get('/cart',[CartController::class, 'index'])->name('cart.index');
    Route::post('/cart-store',[CartController::class, 'store'])->name('cart.store');
    Route::post('/cart-update',[CartController::class, 'update'])->name('cart.update');
});

Route::middleware(['auth','verified','editor'])->group(function(){

    Route::get('/notFound',[HomeController::class, 'notFound'])->name('notFound');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Category
    Route::middleware('admin')->name('category.')->group(function(){
        Route::get('/category', [CategoryController::class, 'index'])->name('index');
        Route::get('/category-list', [CategoryController::class, 'list']);
        Route::post('/category-store', [CategoryController::class, 'store']);
        Route::post('/category-byId', [CategoryController::class, 'byId']);
        Route::post('/category-update', [CategoryController::class, 'update']);
        Route::post('/category-delete', [CategoryController::class, 'delete']);
    });

    // Brand
    Route::name('brand.')->group(function(){
        Route::get('/brand', [BrandController::class, 'index'])->name('index');
        Route::get('/brand-list', [BrandController::class, 'list']);
        Route::post('/brand-store', [BrandController::class, 'store']);
        Route::post('/brand-byId', [BrandController::class, 'byId']);
        Route::post('/brand-update', [BrandController::class, 'update']);
        Route::post('/brand-delete', [BrandController::class, 'delete']);
    });

    // Product
    Route::name('product.')->group(function(){
        Route::get('/product', [ProductController::class, 'index'])->name('index');
        Route::get('/product-list', [ProductController::class, 'list']);
        Route::post('/product-store', [ProductController::class, 'store']);
        Route::post('/product-byId', [ProductController::class, 'byId']);
        Route::post('/product-update', [ProductController::class, 'update']);
        Route::post('/product-delete', [ProductController::class, 'delete']);
    });

    // Product Image
    Route::name('product.image.')->group(function(){
        Route::get('/product-image-list/{productId}', [ProductController::class, 'listImage']);
        Route::post('/product-image-store/{productId}', [ProductController::class, 'storeImage'])->name('store');
        Route::post('/product-image-update', [ProductController::class, 'updateImage']);
        Route::post('/product-image-delete/{prodImageId}', [ProductController::class, 'deleteImage']);
    });


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
