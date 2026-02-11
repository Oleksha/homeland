<?php

namespace App\Domains\Budget\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Domains\Budget\DTO\BudgetImportRowData;

final class BudgetXlsxImport implements ToCollection, WithHeadingRow
{
    /** @var BudgetImportRowData[] */
    private array $rows = [];

    public function collection(Collection $collection): void
    {
        foreach ($collection as $index => $row) {

            $this->rows[] = new BudgetImportRowData(
                budgetPeriod: (string)($row['budget_period'] ?? ''),
                expenseMonth: (string)($row['expense_month'] ?? ''),
                paymentMonth: $row['payment_month'] ?? null,
                budgetNumber: (string)($row['budget_number'] ?? ''),
                amount: (string)($row['amount'] ?? ''),
                vat: (string)($row['vat'] ?? ''),
                expenseItem: (string)($row['expense_item'] ?? ''),
                status: (string)($row['status'] ?? ''),
                description: $row['description'] ?? null,
                rowNumber: $index + 2
            );
        }
    }

    public function rows(): array
    {
        return $this->rows;
    }
}
