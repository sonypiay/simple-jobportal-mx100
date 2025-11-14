<?php

namespace App\Http\Requests\User\Employer;

use App\Exceptions\BadRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:3'],
            'confirm_password' => ['required', 'string', 'min:3', 'same:password'],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.min' => 'Password must be at least 3 characters',
            'confirm_password.required' => 'Confirm password is required',
            'confirm_password.string' => 'Confirm password must be a string',
            'confirm_password.min' => 'Confirm password must be at least 3 characters',
            'confirm_password.same' => 'Confirm password must be same as password',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new BadRequestException($validator->errors()->first());
    }
}
