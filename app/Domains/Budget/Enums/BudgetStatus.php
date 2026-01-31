<?php

namespace App\Domains\Budget\Enums;

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

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
