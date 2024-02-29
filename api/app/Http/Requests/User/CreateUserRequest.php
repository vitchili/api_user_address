<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
{

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'age'   => ['required', 'integer', 'min:1', 'max:99'],
            'name'  => ['required', 'string'],
            'email' => ['required', 'string', 'email']
        ];
    }

    public function messages(): array
    {
        return [
            'name.string'   => 'Name field must be a valid string.',
            'age.integer'   => 'Age field must be an integer',
            'age.min'       => 'Age field must be > 1',
            'age.max'       => 'Age field must be < 100',
            'email.email'   => 'E-mail field must be a valid string e-mail.',
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

}
