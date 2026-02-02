<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class BudgetImportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:xlsx,xls'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
