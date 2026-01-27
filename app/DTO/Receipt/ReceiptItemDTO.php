<?php

namespace App\DTO\Receipt;

use App\Models\Vat;

final readonly class ReceiptItemDTO
{
    public function __construct(
        public string $name,
        public float  $quantity,
        public float  $price,
        public int    $vat_id,
        public float  $vat_rate,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            quantity: (float) $data['quantity'],
            price: (float) $data['price'],
            vat_id: (int) $data['vat_id'],
            vat_rate: (float) Vat::findOrFail($data['vat_id'])->rate,
        );
    }
}
