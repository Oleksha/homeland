<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContractorRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => [
                'nullable',
                'string',
                'max:50',
                'unique:contractors,code,' . ($this->contractor->id ?? 'NULL')
            ],
            'type_id' => 'required|exists:contractor_types,id',
            'is_supplier' => 'boolean',

            'inn' => 'nullable|string|max:12',
            'kpp' => 'nullable|string|max:9',

            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email',

            'delay' => 'nullable|integer|min:0',
            'vat_id' => 'nullable|exists:vats,id',
        ];
    }
}
