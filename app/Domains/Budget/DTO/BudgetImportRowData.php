<?php

namespace App\Domains\Budget\DTO;

final readonly class BudgetImportRowData
{
    public function __construct(
        public string $budgetPeriod,
        public string $expenseMonth,
        public ?string $paymentMonth,
        public string $budgetNumber,
        public string $amount,
        public string $vat,
        public string $expenseItem,
        public string $status,
        public ?string $description,
        public int $rowNumber,
    ) {}
}
