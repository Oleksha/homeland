<?php

namespace App\DTO\Receipt;

final readonly class ReceiptItemDTO
{
    public function __construct(
        public string $name,
        public float  $quantity,
        public float  $price, // цена С НДС
        public int    $vat_id,
        public float  $amount,       // без НДС
        public float  $vat_amount,
        public float  $total_amount, // С НДС
    ) {}

    public static function fromArray(array $data, float $vatRate): self
    {
        $quantity = (float) $data['quantity'];
        $price = (float) $data['price'];

        $total = round($quantity * $price, 2);

        $vatAmount = $vatRate > 0
            ? round($total * $vatRate / (100 + $vatRate), 2)
            : 0.0;

        $amount = round($total - $vatAmount, 2);

        return new self(
            name: $data['name'],
            quantity: $quantity,
            price: $price,
            vat_id: (int) $data['vat_id'],
            amount: $amount,
            vat_amount: $vatAmount,
            total_amount: $total,
        );
    }
}
