<?php

namespace App\Domains\ExpenseItem\DTO;

final readonly class ExpenseItemDTO
{
    public function __construct(
        public string $name,
        public bool $is_report_selection,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            name: $data['name'],
            is_report_selection: (bool)($data['is_report_selection'] ?? true),
        );
    }
}
