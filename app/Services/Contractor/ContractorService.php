<?php

namespace App\Services\Contractor;

use App\DTO\Contractor\ContractorData;
use App\Models\Contractor;

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
