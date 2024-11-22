<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated as RedirectIfAuthenticated;

Route::get('/', [HomeController::class,"index"])->name("Home.index");
Route::get('/home', [HomeController::class,"index"])->name("Home.index");

Route::get("/login",[LoginController::class,"index"])->name("Login.index");
Route::post("/login",[LoginController::class,"authenticate"])->name("Login.index");

Route::get("/register",[RegisterController::class,"index"])->name("Register.index");
Route::post("/register",[RegisterController::class,"register"])->name("Register.index");

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/users',[UserController::class,"index"])->name("User.saveUser");
Route::get('/user/add-user/',[UserController::class,"getSaveUserForm"])->name("User.saveUser");
Route::post('/user/add-user/',[UserController::class,"saveUser"])->name("User.saveUser");

Route::get('/products',[ProductController::class,"index"])->name("Product.saveProduct");
Route::get('/product/add-product/',[ProductController::class,"getSaveProductForm"])->name("Product.saveProduct");
Route::post('/product/add-product/',[ProductController::class,"saveProduct"])->name("Product.saveProduct");

Route::get('/orders',[OrderController::class,"index"]);
Route::get('/orders/add-order/',[OrderController::class,"getSaveOrderForm"]);
Route::post('/orders/add-order/',[OrderController::class,"saveOrder"]);

