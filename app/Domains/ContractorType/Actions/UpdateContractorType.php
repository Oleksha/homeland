<?php

namespace App\Domains\ContractorType\Actions;

use App\Domains\ContractorType\DTO\ContractorTypeData;
use App\Domains\ContractorType\Models\ContractorType;
use App\Support\Action;

class UpdateContractorType extends Action
{
    public function __invoke(
        ContractorType $type,
        ContractorTypeData $dto
    ): ContractorType
    {
        $type->update($dto->toArray());

        return $type;
    }
}
