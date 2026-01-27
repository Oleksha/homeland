<?php

namespace App\Services\Receipt;

use App\DTO\Receipt\ReceiptItemDTO;

final class ReceiptCalculator
{
    /**
     * Рассчитать суммы по одной строке
     */
    public function calculateItem(ReceiptItemDTO $item): array
    {
        $amount = round($item->quantity * $item->price, 2);
        $vatAmount = round($amount * $item->vat_rate / 100, 2);
        $total = round($amount + $vatAmount, 2);

        return [
            'amount' => $amount,
            'vat_amount' => $vatAmount,
            'total_amount' => $total,
        ];
    }

    /**
     * Рассчитать общие суммы по массиву строк
     *
     * @param ReceiptItemDTO[] $items
     */
    public function calculateTotals(array $items): array
    {
        $totalAmount = 0;
        $totalVat = 0;

        foreach ($items as $item) {
            $row = $this->calculateItem($item);
            $totalVat += $row['vat_amount'];
            $totalAmount += $row['total_amount'];
        }

        return [
            'total_amount' => round($totalAmount, 2),
            'total_vat' => round($totalVat, 2),
        ];
    }
}
