<?php

namespace App\Domains\ContractorType\Actions;

use App\Domains\ContractorType\Models\ContractorType;
use App\Support\Action;
use DomainException;

class DeleteContractorType extends Action
{
    public function __invoke(ContractorType $type): void
    {
        if ($type->contractors()->exists()) {
            throw new DomainException(
                'Нельзя удалить тип — есть связанные контрагенты'
            );
        }
        $type->delete();
    }
}
