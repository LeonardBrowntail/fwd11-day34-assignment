<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public $validator = null;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isInstructor();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'instructor_id' => ['required', 'exists:users,id'],
            'category_id' => ['required', 'exists:course_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'rating' => ['required', 'numeric', 'min:0', 'max:10'],
            'level' => ['required', 'in:beginner,intermediate,advanced'],
            'duration' => ['required', 'integer', 'min:1'],
            'thumbnail' => ['nullable', 'string'],
            'status' => ['in:draft,published']
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) {
        $this->validator = $validator;
    }
}
