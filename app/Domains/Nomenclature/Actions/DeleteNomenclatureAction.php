<?php

namespace App\Domains\Nomenclature\Actions;

use App\Domains\Nomenclature\Models\Nomenclature;

class DeleteNomenclatureAction
{
    public function execute(Nomenclature $nomenclature): void
    {
        $nomenclature->delete();
    }
}
