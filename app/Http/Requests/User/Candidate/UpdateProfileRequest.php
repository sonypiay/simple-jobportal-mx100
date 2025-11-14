<?php

namespace App\Http\Requests\User\Candidate;

use App\Exceptions\BadRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
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
            'fullname' => ['required','string','max:255'],
            'email' => ['required', 'string', 'email:rfc', 'max:255'],
            'address' => ['required', 'string'],
            'description' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Fullname is required',
            'fullname.string' => 'Fullname must be a string',
            'fullname.max' => 'Fullname must be less than 255 characters',
            'email.required' => 'Email is required',
            'email.string' => 'Email must be a string',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must be less than 255 characters',
            'address.required' => 'Address is required',
            'address.string' => 'Address must be a string',
            'description.required' => 'Description is required',
            'description.string' => 'Description must be a string',
            'phone.string' => 'Phone must be a string',
            'phone.max' => 'Phone must be less than 255 characters',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new BadRequestException($validator->errors()->first());
    }
}
