<?php

namespace App\DTO\Vat;

readonly class VatData
{
    public function __construct(
        public string  $name,
        public float   $rate,
        public ?string $code,
        public bool    $isActive,
        public bool    $isDefault,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            rate: (float) $data['rate'],
            code: $data['code'] ?? null,
            isActive: (bool) ($data['is_active'] ?? false),
            isDefault: (bool) ($data['is_default'] ?? false),
        );
    }

    public function toArray(): array
    {
        return [
            'name'       => $this->name,
            'rate'       => $this->rate,
            'code'       => $this->code,
            'is_active'  => $this->isActive,
            'is_default' => $this->isDefault,
        ];
    }
}
