<?php

namespace App\Domains\Payment\Enums;

enum PaymentRequestStatus: string
{
    case Unpaid    = 'unpaid';
    case Partial   = 'partial';
    case Paid      = 'paid';

    public function label(): string
    {
        return match ($this) {
            self::Unpaid  => 'Не оплачена',
            self::Partial => 'Частично оплачена',
            self::Paid    => 'Оплачена',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Unpaid  => 'danger',
            self::Partial => 'warning',
            self::Paid    => 'success',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
