<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CourseCategoryRequest extends FormRequest
{
    public $validator = null;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user->isAdmin() || $user->isInstructor();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', 'unique:course_categories,name'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string']
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) {
        $this->validator = $validator;
    }
}
