<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FrontController;

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

Route::get('/', [FrontController::class, 'index'])->name('/');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    //category

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    //food

    Route::get('/food', [FoodController::class, 'index'])->name('food');
    Route::get('/food/create', [FoodController::class, 'create'])->name('food.create');
    Route::post('/food/store', [FoodController::class, 'store'])->name('food.store');
    Route::get('/food/edit/{id}', [FoodController::class, 'edit'])->name('food.edit');
    Route::put('/food/update/{id}', [FoodController::class, 'update'])->name('food.update');
    Route::delete('/food/delete/{id}', [FoodController::class, 'delete'])->name('food.delete');
});