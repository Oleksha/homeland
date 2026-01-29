<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'is_report_selection' => ['required', 'boolean']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_report_selection' => $this->boolean('is_report_selection')
        ]);
    }
}
