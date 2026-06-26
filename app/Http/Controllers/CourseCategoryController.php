<?php

namespace App\Http\Controllers;

use App\Http\ApiTraits\CourseCategoryAPIResponses;
use App\Http\Requests\CourseCategoryDestroyRequest;
use App\Http\Requests\CourseCategoryRequest;
use App\Http\Requests\CourseCategoryUpdateRequest;
use App\Http\Resources\CourseCategoryResource;
use App\Models\CourseCategory;

class CourseCategoryController extends Controller
{
    use CourseCategoryAPIResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CourseCategory::all();
        return $this->courseCategoryIndexSuccessResponse(CourseCategoryResource::collection($categories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCategoryRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return $this->courseCategoryStoreValidationFailedResponse($request->validator->errors());
        }
        $validated = $request->validated();
        $category = CourseCategory::create($validated);
        return $this->courseCategoryStoreSuccessResponse($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = CourseCategory::find($id);
        if (!$category) {
            return $this->courseCategoryNotFoundResponse();
        }
        return $this->courseCategoryShowSuccessResponse($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCategoryUpdateRequest $request, string $id)
    {
        // check if request is valid
        if (isset($request->validator) && $request->validator->fails()) {
            return $this->courseCategoryUpdateValidationFailedResponse($request->validator->errors());
        }

        // catch not found exception
        $category = CourseCategory::find($id);
        if (!$category) {
            return $this->courseCategoryNotFoundResponse();
        }

        // Update model
        $category->update($request->validated());
        return $this->courseCategoryUpdateSuccessResponse($category->fresh());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCategoryDestroyRequest $request, string $id)
    {
        $category = CourseCategory::find($id);
        if (!$category) {
            return $this->courseCategoryNotFoundResponse();
        }

        $category->delete();
        return $this->courseCategoryDestroySuccessResponse();
    }
}
