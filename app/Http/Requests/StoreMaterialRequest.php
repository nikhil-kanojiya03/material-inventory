<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            // Alpha-numeric (letters, numbers, spaces) as requested in the spec.
            'name' => ['required', 'regex:/^[A-Za-z0-9 ]+$/', 'max:255'],
            // Floating point, max 2 digits after the decimal point, not negative.
            'opening_balance' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'Material name may only contain letters, numbers and spaces.',
            'opening_balance.regex' => 'Opening balance must be a number with at most 2 decimal places.',
        ];
    }
}
