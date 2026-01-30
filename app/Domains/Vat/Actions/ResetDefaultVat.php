<?php

namespace App\Domains\Vat\Actions;

use App\Domains\Vat\Models\Vat;
use App\Support\Action;

class ResetDefaultVat extends Action
{
    public function __invoke(?int $exceptId = null): void
    {
        Vat::where('is_default', true)
            ->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))
            ->update(['is_default' => false]);
    }
}
