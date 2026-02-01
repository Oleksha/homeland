<?php

namespace App\Domains\Budget\DTO;

use App\Domains\Budget\Enums\BudgetStatus;

final readonly class BudgetData
{
    public function __construct(
        public string $budgetPeriod,
        public string $expenseMonth,
        public string $paymentMonth,
        public string $budgetNumber,
        public float $amount,
        public int $vatId,
        public int $expenseItemId,
        public BudgetStatus $status,
        public ?string $description,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            budgetPeriod: $data['budget_period'],
            expenseMonth: $data['expense_month'],
            paymentMonth: $data['payment_month'],
            budgetNumber: $data['budget_number'],
            amount: (float)$data['amount'],
            vatId: (int)$data['vat_id'],
            expenseItemId: (int)$data['expense_item_id'],
            status: BudgetStatus::from($data['status']),
            description: $data['description'] ?? null,
        );
    }
}
