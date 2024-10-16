<?php

namespace App\Http\Requests\Api\v1\Inventory;

use App\Models\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreInventoryRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:inventories,name',
            'projet_id' => 'required|integer|exists:projets,id',
            'type' => 'required|string|max:255',
            'quantity' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        throw new HttpResponseException(ApiResponse::errors($validator->errors(), 400));
    }
}