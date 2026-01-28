<?php

namespace App\Services\Receipt;

use App\DTO\Receipt\ReceiptItemDTO;

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

