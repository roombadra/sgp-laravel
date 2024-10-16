<?php

namespace App\Http\Requests\Api\v1\User;

use App\Models\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'phone_number' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'active' => ['boolean'],
            'password' => [
                'string',
                'min:8',
                'confirmed',
            ],
            'profile_id' => ['integer', 'exists:profiles,id'],
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        throw new HttpResponseException(ApiResponse::errors($validator->errors()));
    }
}