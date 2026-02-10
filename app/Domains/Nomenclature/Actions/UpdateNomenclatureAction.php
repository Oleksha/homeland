<?php

namespace App\Domains\Nomenclature\Actions;

use App\Domains\Nomenclature\DTO\NomenclatureData;
use App\Domains\Nomenclature\Models\Nomenclature;

class UpdateNomenclatureAction
{
    public function execute(Nomenclature $nomenclature, NomenclatureData $dto): void
    {
        $nomenclature->update([
            'category_id' => $dto->categoryId,
            'name' => $dto->name,
            'unit_id' => $dto->unitId,
            'image' => $dto->image,
            'description' => $dto->description,
        ]);
    }
}
