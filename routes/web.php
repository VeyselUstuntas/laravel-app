<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,"index"]);

Route::get('/home', [HomeController::class,"index"]);

Route::get('/users',[UserController::class,"index"]);
Route::get('/products',[ProductController::class,"index"]);
Route::get('/orders',[OrderController::class,"index"]);
