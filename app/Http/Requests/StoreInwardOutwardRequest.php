<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInwardOutwardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'material_id' => ['required', 'exists:materials,id'],
            'entry_date' => ['required', 'date'],
            // Floating point, max 2 decimals, negative values allowed (outward movement).
            'quantity' => ['required', 'regex:/^-?\d+(\.\d{1,2})?$/', 'not_in:0,0.0,0.00,-0,-0.0,-0.00'],
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.regex' => 'Quantity must be a number with at most 2 decimal places (negative values allowed for outward).',
            'quantity.not_in' => 'Quantity cannot be zero.',
        ];
    }
}
