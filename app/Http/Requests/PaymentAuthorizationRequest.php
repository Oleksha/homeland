<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentAuthorizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contractor_id'    => ['required', 'exists:contractors,id'],
            'expense_item_id'  => ['required', 'exists:expense_items,id'],
            'number'           => ['required', 'string', 'max:50'],
            'date_start'       => ['required', 'date'],
            'date_end'         => ['nullable', 'date', 'after_or_equal:date_start'],
            'delay'            => ['nullable', 'integer', 'min:0'],
            'amount'           => ['required', 'numeric', 'min:0.01'],
        ];
    }
}
