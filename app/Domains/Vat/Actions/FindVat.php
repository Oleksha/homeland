<?php

namespace App\Domains\Vat\Actions;

use App\Domains\Vat\Models\Vat;
use App\Support\Action;

class FindVat extends Action
{
    public function __invoke(int $id): Vat
    {
        return Vat::active()->findOrFail($id);
    }
}
