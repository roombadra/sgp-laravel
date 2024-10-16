<?php

namespace App\Http\Requests\Api\v1\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:inventories,name,' . $this->inventory->id,
            'projet_id' => 'required|integer|exists:projets,id',
            'type' => 'string|max:255',
            'quantity' => 'max:255',
            'location' => 'string|max:255',
        ];
    }
}