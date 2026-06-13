<?php

namespace App\Http\Controllers;

use App\ApiResponse;
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
        return $this->successResponse(CourseCategoryResource::collection(CourseCategory::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCategoryRequest $request)
    {
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
        $validated = $request->validated();

        $category = CourseCategory::find($id);

        if (!$category) {
            return $this->notFoundResponse();
        }

        $category->update($validated);
        return $this->successResponse($category->fresh());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CourseCategory::find($id);
        $category->delete();
        return $this->successResponse();
    }
}
