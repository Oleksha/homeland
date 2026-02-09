<?php

namespace App\Domains\StorageLocation\DTO;

readonly class StorageLocationDTO
{
    public function __construct(
        public string $name,
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            name: $request->string('name')
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
