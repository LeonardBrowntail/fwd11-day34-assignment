<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Requests\CourseCategoryDestroyRequest;
use App\Http\Requests\CourseCategoryRequest;
use App\Http\Requests\CourseCategoryUpdateRequest;
use App\Http\Resources\CourseCategoryResource;
use App\Models\CourseCategory;

class CourseCategoryController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CourseCategory::all();
        return $this->successResponse(CourseCategoryResource::collection($categories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCategoryRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return $this->errorResponse($request->validator->errors());
        }
        $validated = $request->validated();
        $category = CourseCategory::create($validated);
        return $this->successResponse($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = CourseCategory::find($id);
        if (!$category) {
            return $this->notFoundResponse();
        }
        return $this->successResponse($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCategoryUpdateRequest $request, string $id)
    {
        // check if request is valid
        if (isset($request->validator) && $request->validator->fails()) {
            return $this->errorResponse($request->validator->errors());
        }

        // catch not found exception
        $category = CourseCategory::find($id);
        if (!$category) {
            return $this->notFoundResponse();
        }

        // Update model
        $category->update($request->validated());
        return $this->successResponse($category->fresh());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategoryDestroyRequest $request, string $id)
    {
        $category = CourseCategory::find($id);
        if (!$category) {
            return $this->notFoundResponse();
        }

        $category->delete();
        return $this->successResponse();
    }
}
