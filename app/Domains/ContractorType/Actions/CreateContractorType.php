<?php

namespace App\Domains\ContractorType\Actions;

use App\Domains\ContractorType\DTO\ContractorTypeData;
use App\Domains\ContractorType\Models\ContractorType;
use App\Support\Action;

class CreateContractorType extends Action
{
    public function __invoke(ContractorTypeData $dto): ContractorType
    {
        return ContractorType::create($dto->toArray());
    }
}
