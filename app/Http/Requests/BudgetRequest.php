<?php

namespace App\Http\Requests;

use App\Domains\Budget\DTO\BudgetData;
use App\Domains\Budget\Enums\BudgetStatus;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BudgetRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'budget_period' => ['required', 'date'],
            'expense_month' => ['required', 'date'],
            'payment_month' => ['required', 'date'],
            'budget_number' => ['required', 'string', 'max:50'],
            'amount' => ['required', 'numeric', 'min:0'],
            'vat_id' => ['required', 'exists:vats,id'],
            'expense_item_id' => ['required', 'exists:expense_items,id'],
            'status' => ['required', Rule::in(BudgetStatus::values())],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }


    /*public function toDto(): BudgetData
    {
        return new BudgetData(
            budgetPeriod: CarbonImmutable::parse($this->budget_period),
            expenseMonth: CarbonImmutable::parse($this->expense_month),
            paymentMonth: CarbonImmutable::parse($this->payment_month),

            budgetNumber: $this->budget_number,
            amount: (float) $this->amount,

            vatId: (int) $this->vat_id,
            expenseItemId: (int) $this->expense_item_id,

            status: BudgetStatus::from($this->status),
            description: $this->description,
        );
    }*/
}
