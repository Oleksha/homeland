<?php

namespace App\Domains\Budget\Imports;

use App\Domains\Budget\DTO\BudgetImportRowData;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\{
    ToCollection,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure,
    SkipsFailures
};

final class BudgetXlsxImport implements
    ToCollection,
    WithHeadingRow,
    SkipsOnFailure
{
    use SkipsFailures;

    /** @var BudgetImportRowData[] */
    private array $rows = [];

    public function collection(Collection $collection): void
    {
        foreach ($collection as $index => $row) {
            $this->rows[] = new BudgetImportRowData(
                budgetPeriod:  (string)($row['budget_period'] ?? ''),
                expenseMonth:  (string)($row['expense_month'] ?? ''),
                paymentMonth:  $row['payment_month'] ?? null,
                budgetNumber:  (string)($row['budget_number'] ?? ''),
                amount:        (string)($row['amount'] ?? ''),
                vat:           (string)($row['vat'] ?? ''),
                expenseItem:   (string)($row['expense_item'] ?? ''),
                status:        (string)($row['status'] ?? ''),
                description:   $row['description'] ?? null,
                rowNumber:     $index + 2 // +2 потому что заголовок
            );
        }
    }

    /**
     * Достаём строки для Action
     */
    public function rows(): array
    {
        return $this->rows;
    }
}
