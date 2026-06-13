<?php

use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResources([
  'courses' => CourseController::class,
  'categories' => CourseCategoryController::class
]);