<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return $this->successResponse(CourseResource::collection(Course::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $validated = $request->validated();

        $course = Course::create($validated);
        return $this->successResponse($course);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return $this->notFoundResponse();
        }

        return $this->successResponse($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseUpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        $course = Course::find($id);
        $course->update($validated);
        return $this->successResponse($course->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return $this->notFoundResponse();
        }

        $course->delete();
        return $this->successResponse();
    }
}
