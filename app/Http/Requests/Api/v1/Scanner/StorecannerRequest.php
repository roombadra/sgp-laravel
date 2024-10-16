<?php

namespace App\Http\Requests\Api\v1\Scanner;

use App\Models\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorecannerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'marque' => 'required|string|max:255|min:2|unique:scanners',
            'model' => 'required|string',
            'serial_number' => 'required|string',
            'active' => 'required|boolean',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(ApiResponse::errors($validator->errors(), 400));
    }
}