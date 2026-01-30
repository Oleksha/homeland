<?php

namespace App\Services\ContractorType;

use App\Domains\ContractorType\DTO\ContractorTypeData;
use App\Domains\ContractorType\Models\ContractorType;

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
