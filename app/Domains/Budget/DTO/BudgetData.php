<?php

namespace App\Domains\Budget\DTO;

use App\Domains\Budget\Enums\BudgetStatus;
use Carbon\Carbon;

final readonly class BudgetData
{
    public function __construct(
        public Carbon $budgetPeriod,
        public Carbon $expenseMonth,
        public Carbon $paymentMonth,
        public string $budgetNumber,
        public float $amount,
        public int $vatId,
        public int $expenseItemId,
        public BudgetStatus $status,
        public ?string $description,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            budgetPeriod: Carbon::parse($data['budget_period']),
            expenseMonth: Carbon::parse($data['expense_month']),
            paymentMonth: Carbon::parse($data['payment_month']),
            budgetNumber: $data['budget_number'],
            amount: (float)$data['amount'],
            vatId: (int)$data['vat_id'],
            expenseItemId: (int)$data['expense_item_id'],
            status: BudgetStatus::from($data['status']),
            description: $data['description'] ?? null,
        );
    }
}
