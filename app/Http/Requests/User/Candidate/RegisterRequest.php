<?php

namespace App\Http\Requests\User\Candidate;

use App\Exceptions\BadRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['required','string','max:255'],
            'email' => ['required', 'string', 'email:rfc', 'max:255'],
            'password' => ['required', 'string', 'min:3'],
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'fullname is required',
            'fullname.string' => 'fullname must be string',
            'fullname.max' => 'fullname max length is 255',
            'email.required' => 'email is required',
            'email.string' => 'email must be string',
            'email.email' => 'email must be valid email',
            'email.max' => 'email max length is 255',
            'password.required' => 'password is required',
            'password.string' => 'password must be string',
            'password.min' => 'password min length is 3',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new BadRequestException($validator->errors()->first());
    }
}
