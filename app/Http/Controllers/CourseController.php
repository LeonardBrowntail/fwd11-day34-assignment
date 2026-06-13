<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Requests\CourseRequest;
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
        $courses = Course::all();
        return $this->successResponse(CourseResource::collection($courses));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $validated = $request->validated();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
