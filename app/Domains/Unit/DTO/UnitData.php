<?php

namespace App\Domains\Unit\DTO;

class UnitData
{
    public function __construct(
        public string $name,
        public string $short_name,
        public ?string $code,
        public bool $is_active,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            short_name: $data['short_name'],
            code: $data['code'] ?? null,
            is_active: $data['is_active'] ?? true,
        );
    }
}
