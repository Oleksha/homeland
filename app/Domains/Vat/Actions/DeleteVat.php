<?php

namespace App\Domains\Vat\Actions;

use App\Domains\Vat\Models\Vat;
use App\Support\Action;
use RuntimeException;

class DeleteVat extends Action
{
    public function __invoke(Vat $vat): void
    {
        if ($vat->is_default) {
            throw new RuntimeException('Нельзя удалить НДС по умолчанию');
        }

        $vat->delete();
    }
}
