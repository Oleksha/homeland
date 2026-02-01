<?php

namespace App\Domains\Budget\DTO;

use App\Domains\ExpenseItem\Models\ExpenseItem;
use App\Domains\Vat\Models\Vat;

final class BudgetImportMapper
{
    public function map(BudgetImportRowData $row): BudgetData
    {
        return BudgetData::fromArray([
            'budget_period'   => $this->parseDate($row->budgetPeriod),
            'expense_month'   => $this->parseDate($row->expenseMonth),
            'payment_month'   => $this->parseDate($row->paymentMonth),
            'budget_number'   => $row->budgetNumber,
            'amount'          => $row->amount,
            'vat_id'          => Vat::byName($row->vat)->id,
            'expense_item_id' => ExpenseItem::byName($row->expenseItem)->id,
            'status'          => $row->status,
            'description'     => $row->description,
        ]);
    }
}
