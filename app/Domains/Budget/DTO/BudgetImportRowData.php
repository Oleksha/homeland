<?php

namespace App\Domains\Budget\DTO;

use App\Domains\Budget\Enums\BudgetStatus;
use App\Domains\ExpenseItem\Models\ExpenseItem;
use App\Domains\Vat\Models\Vat;
use RuntimeException;

final class BudgetImportRowData
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
        public int $rowNumber
    ) {}

    public function toBudgetData(): BudgetData
    {
        $vatId = Vat::where('name', $this->vat)->value('id');

        if (!$vatId) {
            throw new RuntimeException("Не найден НДС: {$this->vat}");
        }

        $expenseItemId = ExpenseItem::where('name', $this->expenseItem)->value('id');

        if (!$expenseItemId) {
            throw new RuntimeException("Не найдена статья расхода: {$this->expenseItem}");
        }

        return new BudgetData(
            budgetPeriod: $this->budgetPeriod,
            expenseMonth: $this->expenseMonth,
            paymentMonth: $this->paymentMonth,
            budgetNumber: $this->budgetNumber,
            amount: (float)$this->amount,
            vatId: $vatId,
            expenseItemId: $expenseItemId,
            status: BudgetStatus::fromLabel($this->status),
            description: $this->description
        );
    }
}
