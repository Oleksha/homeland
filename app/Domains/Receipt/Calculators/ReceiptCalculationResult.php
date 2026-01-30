<?php

namespace App\Domains\Receipt\Calculators;

use App\Domains\Receipt\DTO\ReceiptItemDTO;

final class ReceiptCalculationResult
{
    /**
     * @param ReceiptItemDTO[] $items
     */
    public function __construct(
        public array $items,
        public float $totalAmount,
        public float $totalVat,
    ) {}
}

