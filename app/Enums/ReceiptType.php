<?php

    namespace App\Enums;

    enum ReceiptType: int
    {
        case GOODS = 1;
        case PREPAYMENT = 2;
        case ADVANCE = 3;

        public function label(): string
        {
            return match ($this) {
                self::GOODS => 'Поступление товаров и услуг',
                self::PREPAYMENT => 'Предоплата поставщику',
                self::ADVANCE => 'Авансовый отчет',
            };
        }

        public static function options(): array
        {
            return collect(self::cases())
                ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
                ->toArray();
        }
    }
