<?php

namespace App\Domains\Contractor\Actions;

use App\Domains\Contractor\DTO\ContractorData;
use App\Domains\Contractor\Models\Contractor;
use App\Support\Action;

final class UpdateContractor extends Action
{
    public function __invoke(Contractor $contractor, ContractorData $data): Contractor
    {
        $contractor->update($data->toArray());

        return $contractor;
    }
}
