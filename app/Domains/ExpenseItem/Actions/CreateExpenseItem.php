<?php

namespace App\Domains\ExpenseItem\Actions;

use App\Domains\ExpenseItem\Models\ExpenseItem;
use App\Domains\ExpenseItem\DTO\ExpenseItemDTO;
use App\Support\Action;

class CreateExpenseItem extends Action
{
    public function __invoke(ExpenseItemDTO $data): ExpenseItem
    {
        return ExpenseItem::create([
            'name' => $data->name,
            'is_report_selection' => $data->is_report_selection,
        ]);
    }
}
