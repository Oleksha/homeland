<?php

namespace App\Domains\ExpenseItem\Actions;

use App\Domains\ExpenseItem\Models\ExpenseItem;
use App\Support\Action;

class ForceDeleteExpenseItem extends Action
{
    public function __invoke(int $id): void
    {
        ExpenseItem::withTrashed()
            ->findOrFail($id)
            ->forceDelete();
    }
}
