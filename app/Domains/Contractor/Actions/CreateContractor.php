<?php

namespace App\Domains\Contractor\Actions;

use App\Domains\Contractor\DTO\ContractorData;
use App\Domains\Contractor\Models\Contractor;
use App\Support\Action;

final class CreateContractor extends Action
{
    public function __invoke(ContractorData $data): Contractor
    {
        return Contractor::create($data->toArray());
    }
}
