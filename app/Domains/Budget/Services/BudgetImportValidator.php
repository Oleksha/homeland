<?php

namespace App\Domains\Budget\Services;

use App\Domains\Budget\DTO\BudgetImportRowData;
use App\Domains\Budget\Enums\BudgetStatus;

final class BudgetImportValidator
{
    public function validate(BudgetImportRowData $row): void
    {
        if (!is_numeric($row->amount)) {
            throw new BudgetImportException(
                "Строка {$row->rowNumber}: сумма не число"
            );
        }

        if (!BudgetStatus::tryFrom($row->status)) {
            throw new BudgetImportException(
                "Строка {$row->rowNumber}: неверный статус"
            );
        }
    }
}
