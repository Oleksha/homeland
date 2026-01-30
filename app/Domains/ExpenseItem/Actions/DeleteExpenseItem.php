<?php

namespace App\Domains\ExpenseItem\Actions;

use App\Domains\ExpenseItem\Models\ExpenseItem;
use App\Support\Action;

class DeleteExpenseItem extends Action
{
    public function __invoke(ExpenseItem $item): void
    {
        $item->delete();
    }
}
