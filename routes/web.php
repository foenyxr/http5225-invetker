<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/transactions', [DashboardController::class, 'transactions']);

Route::get('/welcome', function () {
  return view('welcome');
});

