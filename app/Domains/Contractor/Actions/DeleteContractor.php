<?php

namespace App\Domains\Contractor\Actions;

use App\Domains\Contractor\Models\Contractor;
use App\Support\Action;
use DomainException;

final class DeleteContractor extends Action
{
    public function __invoke(Contractor $contractor): void
    {
        if ($contractor->receipts()->exists()) {
            throw new DomainException(
                'Нельзя удалить этого контрагента — есть связанные поступления'
            );
        }
        $contractor->delete();
    }
}
