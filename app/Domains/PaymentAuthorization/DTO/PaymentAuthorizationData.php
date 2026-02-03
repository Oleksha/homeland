<?php

namespace App\Domains\PaymentAuthorization\DTO;

final readonly class PaymentAuthorizationData
{
    public function __construct(
        public int $contractorId,
        public int $expenseItemId,
        public string $number,
        public string $dateStart,
        public string $dateEnd,
        public int $delay,
        public float $amount,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            contractorId: (int)$data['contractor_id'],
            expenseItemId: (int)$data['expense_item_id'],
            number: $data['number'],
            dateStart: $data['date_start'],
            dateEnd: $data['date_end'],
            delay: (int)($data['delay'] ?? 0),
            amount: (float)$data['amount'],
        );
    }
}
