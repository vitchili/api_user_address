<?php

namespace App\Http\Requests\Address;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteAddressRequest extends FormRequest
{

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'    => ['required', 'integer', 'exists:addresses,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'id.integer'    => 'ID needs to be integer.',
            'id.exists'     => 'ID needs to exist in addresses table.',
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

}
