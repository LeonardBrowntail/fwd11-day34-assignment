<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

// Protected API Routes
Route::middleware('auth:sanctum')->prefix('v2/')->group(fn()=>[
  Route::apiResource('courses', CourseController::class)->only('store', 'update', 'destroy'),
  Route::apiResource('categories', CourseCategoryController::class)->only('store', 'update', 'destroy')
]);
  
// Public API Routes
Route::prefix('v2/')->group(fn()=>[
  Route::apiResource('courses', CourseController::class)->only('index', 'show'),
  Route::apiResource('categories', CourseCategoryController::class)->only('index', 'show')
]);

// Authentication Routes
Route::prefix('auth/')->group(fn() => [
  // Public
  Route::post('register', [AuthController::class, 'register']),
  Route::post('login', [AuthController::class, 'login']),
  // Protected
  Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout'])
]);