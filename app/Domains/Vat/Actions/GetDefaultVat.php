<?php

namespace App\Domains\Vat\Actions;

use App\Domains\Vat\Models\Vat;
use App\Support\Action;
use RuntimeException;

class GetDefaultVat extends Action
{
    public function __invoke(): Vat
    {
        return Vat::default()->first()
            ?? throw new RuntimeException('Ставка НДС по умолчанию не определена.');
    }
}
