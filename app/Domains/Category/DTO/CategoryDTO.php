<?php

namespace App\Domains\Category\DTO;

readonly class CategoryDTO
{
    public function __construct(
        public string $name,
        public ?int   $parent_id,
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            name: $request->string('name'),
            parent_id: $request->integer('parent_id') ?: null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ];
    }
}
