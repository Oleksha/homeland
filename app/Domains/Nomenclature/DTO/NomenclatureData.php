<?php

namespace App\Domains\Nomenclature\DTO;

class NomenclatureData
{
    public function __construct(
        public int $categoryId,
        public string $name,
        public int $unitId,
        public ?string $image,
        public ?string $description,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            categoryId: $data['category_id'],
            name: $data['name'],
            unitId: $data['unit_id'],
            image: $data['image'] ?? null,
            description: $data['description'] ?? null,
        );
    }
}
