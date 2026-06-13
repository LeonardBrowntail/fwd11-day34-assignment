<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'instructor_id' => ['sometimes', 'required','exists:users,id'],
            'category_id' => ['sometimes', 'required', 'exists:course_categories,id'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'rating' => ['sometimes','required', 'numeric', 'min:0', 'max:10'],
            'level' => ['sometimes','required', 'in:beginner,intermediate,advanced'],
            'duration' => ['sometimes','required', 'integer', 'min:1'],
            'thumbnail' => ['sometimes', 'nullable', 'string'],
            'status' => ['sometimes', 'in:draft,published']
        ];
    }
}
