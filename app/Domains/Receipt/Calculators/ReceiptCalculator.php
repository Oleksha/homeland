<?php

namespace App\Domains\Receipt\Calculators;

use App\Domains\Receipt\DTO\ReceiptItemDTO;

final class ReceiptCalculator
{
    /**
     * @param ReceiptItemDTO[] $items
     */
    public function calculate(array $items): ReceiptCalculationResult
    {
        $totalAmount = 0;
        $totalVat = 0;

        foreach ($items as $item) {
            $totalAmount += $item->total_amount;
            $totalVat += $item->vat_amount;
        }

        return new ReceiptCalculationResult(
            items: $items,
            totalAmount: round($totalAmount, 2),
            totalVat: round($totalVat, 2),
        );
    }
}

