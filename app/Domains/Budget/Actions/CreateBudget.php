<?php

namespace App\Domains\Budget\Actions;

use App\Domains\Budget\DTO\BudgetData;
use App\Domains\Budget\Models\Budget;
use App\Support\Action;

final class CreateBudget extends Action
{
    public function __invoke(BudgetData $data): Budget
    {
        return Budget::create([
            'budget_period'   => $data->budgetPeriod,
            'expense_month'   => $data->expenseMonth,
            'payment_month'   => $data->paymentMonth,
            'budget_number'   => $data->budgetNumber,
            'amount'          => $data->amount,
            'vat_id'          => $data->vatId,
            'expense_item_id' => $data->expenseItemId,
            'status'          => $data->status,
            'description'     => $data->description,
        ]);
    }
}
