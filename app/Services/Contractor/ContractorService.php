<?php

namespace App\Services\Contractor;

use App\Domains\Contractor\DTO\ContractorData;
use App\Domains\Contractor\Models\Contractor;

class ContractorService
{
    /**
     * Создание контрагента
     */
    public function store(ContractorData $dto): Contractor
    {
        return Contractor::create($dto->toArray());
    }

    /**
     * Обновление контрагента
     */
    public function update(Contractor $contractor, ContractorData $dto): Contractor
    {
        $contractor->update($dto->toArray());
        return $contractor;
    }
}
