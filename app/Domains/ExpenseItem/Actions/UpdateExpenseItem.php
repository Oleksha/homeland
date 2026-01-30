<?php

namespace App\Domains\ExpenseItem\Actions;

use App\Domains\ExpenseItem\DTO\ExpenseItemDTO;
use App\Domains\ExpenseItem\Models\ExpenseItem;
use App\Support\Action;

class UpdateExpenseItem extends Action
{
    public function __invoke(
        ExpenseItem $item,
        ExpenseItemDTO $data
    ): ExpenseItem {

        $item->update([
            'name' => $data->name,
            'is_report_selection' => $data->is_report_selection,
        ]);

        return $item;
    }
}

