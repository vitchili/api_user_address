<?php

namespace App\Http\Requests\Address;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReadAddressRequest extends FormRequest
{

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'       => ['nullable', 'integer', 'exists:addresses,id'], 
            'user_id'  => ['nullable', 'integer', 'exists:users,id'], 
            'city_id'  => ['nullable', 'integer', 'exists:cities,id'],
            'street'   => ['nullable', 'string'],
            'number'   => ['nullable', 'string'],
            'zip_code' => ['nullable', 'string'],  
        ];
    }

    public function messages(): array
    {
        return [
            'id.integer'    => 'ID needs to be integer.',
            'id.exists'     => 'ID needs to exist in addresses table.',
            'id.user_id'     => 'ID needs to exist in users table.',
            'id.city_id'     => 'ID needs to exist in cities table.',
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

}
