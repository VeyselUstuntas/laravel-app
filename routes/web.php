<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,"index"]);

Route::get('/home', [HomeController::class,"index"]);

Route::get('/users',[UserController::class,"index"])->name("User.saveUser");
Route::get('/user/add-user/',[UserController::class,"getSaveUserForm"])->name("User.saveUser");
Route::post('/user/add-user/',[UserController::class,"saveUser"])->name("User.saveUser");

Route::get('/products',[ProductController::class,"index"])->name("Product.saveProduct");
Route::get('/product/add-product/',[ProductController::class,"getSaveProductForm"])->name("Product.saveProduct");
Route::post('/product/add-product/',[ProductController::class,"saveProduct"])->name("Product.saveProduct");

Route::get('/orders',[OrderController::class,"index"]);
Route::get('/orders/add-order/',[OrderController::class,"getSaveOrderForm"]);
Route::post('/orders/add-order/',[OrderController::class,"saveOrder"]);

