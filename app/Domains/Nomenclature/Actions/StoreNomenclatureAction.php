<?php

namespace App\Domains\Nomenclature\Actions;

use App\Domains\Nomenclature\DTO\NomenclatureData;
use App\Domains\Nomenclature\Models\Nomenclature;

class StoreNomenclatureAction
{
    public function execute(NomenclatureData $dto): void
    {
        Nomenclature::create([
            'category_id' => $dto->categoryId,
            'name' => $dto->name,
            'unit_id' => $dto->unitId,
            'image' => $dto->image,
            'description' => $dto->description,
        ]);
    }
}
