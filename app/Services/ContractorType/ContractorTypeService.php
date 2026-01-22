<?php

namespace App\Services\ContractorType;

use App\Models\ContractorType;
use App\DTO\ContractorType\ContractorTypeData;

class ContractorTypeService
{
    public function store(ContractorTypeData $dto): ContractorType
    {
        return ContractorType::create($dto->toArray());
    }

    public function update(ContractorType $type, ContractorTypeData $dto): ContractorType
    {
        $type->update($dto->toArray());

        return $type;
    }

    public function delete(ContractorType $type): void
    {
        $type->delete();
    }
}
