<?php

namespace App\Http\Requests\User\Employer;

use App\Exceptions\BadRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'qualification' => ['required'],
            'location' => ['required', 'max:255'],
            'employment_type' => ['required'],
            'level_experience' => ['required'],
            'category' => ['required'],
            'minimum_salary' => ['nullable', 'numeric', 'min:0'],
            'maximum_salary' => ['nullable', 'numeric', 'min:0', 'gt:minimum_salary'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.max' => 'Title must not exceed 255 characters',
            'description.required' => 'Description is required',
            'qualification.required' => 'Qualification is required',
            'location.required' => 'Location is required',
            'location.max' => 'Location must not exceed 255 characters',
            'employment_type.required' => 'Employment type is required',
            'level_experience.required' => 'Level experience is required',
            'category.required' => 'Category is required',
            'minimum_salary.numeric' => 'Minimum salary must be a number',
            'minimum_salary.min' => 'Minimum salary must be at least 0',
            'maximum_salary.numeric' => 'Maximum salary must be a number',
            'maximum_salary.min' => 'Maximum salary must be at least 0',
            'maximum_salary.gt' => 'Maximum salary must be greater than minimum salary',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new BadRequestException($validator->errors()->first());
    }
}
