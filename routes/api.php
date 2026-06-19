<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

// Protected routes
Route::middleware('auth:sanctum')->prefix('v2/')->group(fn()=>[
  Route::apiResource('courses', CourseController::class)->except('index', 'show'),
  Route::apiResource('categories', CourseCategoryController::class)->except('index', 'show'),
  Route::post('logout', [AuthController::class, 'logout'])
]);

// public routes
Route::prefix('v2/')->group(fn()=>[
  Route::apiResource('courses', CourseController::class)->only('index', 'show'),
  Route::apiResource('categories', CourseCategoryController::class)->only('index', 'show')
]);

Route::prefix('auth/')->group(fn() => [
  Route::post('register', [AuthController::class, 'register']),
  Route::post('login', [AuthController::class, 'login'])
]);