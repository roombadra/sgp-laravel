<?php

namespace App\Http\Requests\Api\v1\Auth;

use App\Models\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:255|unique:users',
            'address' => 'nullable|string|max:255',
            'active' => 'nullable|boolean',
            'profile_id' => 'required|integer|exists:profiles,id',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmed' => 'required|string|same:password',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        throw new HttpResponseException(ApiResponse::errors($validator->errors()));
    }
}