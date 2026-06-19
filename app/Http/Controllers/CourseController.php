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
        $course = Course::all();
        return $this->successResponse(CourseResource::collection($course));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return $this->errorResponse($request->validator->errors());
        }
        $course = Course::create($request->validated());
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
        if (isset($request->validator) && $request->validator->fails()) {
            return $this->errorResponse($request->validator->errors());
        }

        // find course
        $course = Course::find($id);
        if (!$course) {
            return $this->notFoundResponse();
        }

        // check if user (instructor) can update the course
        $user = $request->user();
        if (!($course->instructor_id !== $user->id)) {
            return $this->unauthorizedResponse();
        }

        // update course
        $course->update($request->validated());
        return $this->successResponse($course->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return $this->notFoundResponse();
        }

        // check if user (instructor) can update the course
        $user = $request->user();
        if (!($course->instructor_id !== $user->id)) {
            return $this->unauthorizedResponse();
        }

        $course->delete();
        return $this->successResponse();
    }
}
