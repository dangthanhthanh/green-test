<?php

use App\Http\Controllers\Client\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart');
    Route::get('add-to-cart/{id}', [CartController::class, 'addProductToCart'])->name('add-product')->middleware('auth');
    Route::get('delete-product-in-cart/{id}', [CartController::class, 'deleteProductInCart'])->name('delete-product-in-cart');
    Route::get('delete-all', [CartController::class, 'deleteAllItems'])->name('delete-all');
    Route::get('update-product-in-cart/{id}/{qty?}', [CartController::class, 'updateProductInCart'])->name('update-product-in-cart');
});
