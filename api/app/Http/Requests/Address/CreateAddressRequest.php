<?php

namespace App\Http\Requests\Address;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateAddressRequest extends FormRequest
{

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'  => ['required', 'integer', 'exists:users,id'], 
            'city_id'  => ['required', 'integer', 'exists:cities,id'],
            'street'   => ['required', 'string'],
            'number'   => ['required', 'string'],
            'zip_code' => ['required', 'string'],  
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'user_id field must exist in users table.',
            'city_id.exists' => 'city_id field must exist in cities table.',
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

}
