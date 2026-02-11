<?php

namespace App\Domains\Budget\Enums;

use RuntimeException;

enum BudgetStatus: string
{
    case Draft     = 'draft';
    case Pending   = 'pending';
    case Approved  = 'approved';
    case Rejected  = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Draft    => 'На формировании',
            self::Pending  => 'На согласовании',
            self::Approved => 'Согласован',
            self::Rejected => 'Отклонен',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Draft     => 'secondary',
            self::Pending   => 'warning',
            self::Approved  => 'success',
            self::Rejected  => 'danger',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function fromLabel(string $label): self
    {
        $label = mb_strtolower(trim($label));

        return match ($label) {
            'на формировании' => self::Draft,
            'на согласовании' => self::Pending,
            'согласован', 'согласовано' => self::Approved,
            'отклонен', 'отклонено' => self::Rejected,

            default => throw new RuntimeException("Неизвестный статус бюджета: {$label}")
        };
    }
}
