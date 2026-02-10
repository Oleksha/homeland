<?php

namespace App\Domains\Nomenclature\Actions;

use App\Domains\Nomenclature\Models\Nomenclature;

class ForceDeleteNomenclatureAction
{
    public function execute(int $id): void
    {
        Nomenclature::withTrashed()
            ->findOrFail($id)
            ->forceDelete();
    }
}
