<?php

namespace App\Http\Controllers;

use App\Http\ApiTraits\CourseAPIResponses;
use App\Http\Requests\CourseDestroyRequest;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseController extends Controller
{
    use CourseAPIResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::all();
        return $this->courseIndexSuccessResponse(CourseResource::collection($course));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return $this->courseStoreValidationFailedResponse($request->validator->errors());
        }
        // add user's id as the course's instructor_id
        $validated = $request->validated();
        $validated['instructor_id'] = $request->user()->id;

        // create a new course entry in database and return instance for JsonResponse
        $course = Course::create($validated);
        return $this->courseStoreSuccessResponse($course);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return $this->courseNotFoundResponse();
        }
        return $this->courseShowSuccessResponse($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseUpdateRequest $request, string $id)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return $this->courseUpdateValidationFailedResponse($request->validator->errors());
        }

        // find course
        $course = Course::find($id);
        if (!$course) {
            return $this->courseNotFoundResponse();
        }

        // check if user (instructor) can update the course
        $user = $request->user();
        if (!($course->instructor_id !== $user->id)) {
            return $this->courseUpdateNotOwnerResponse();
        }

        // update course
        $course->update($request->validated());
        return $this->courseUpdateSuccessResponse($course->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseDestroyRequest $request, string $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return $this->courseNotFoundResponse();
        }

        // check if user (instructor) can update the course
        $user = $request->user();
        if ($course->instructor_id !== $user->id) {
            return $this->courseDestroyNotOwnerResponse();
        }

        $course->delete();
        return $this->courseDestroySuccessResponse();
    }
}
