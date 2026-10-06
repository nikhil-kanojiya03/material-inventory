<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Only the material's basic details (category, name, opening balance) are editable here.
     * Inward/outward history is never touched by this form, per the spec.
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'regex:/^[A-Za-z0-9 ]+$/', 'max:255'],
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
