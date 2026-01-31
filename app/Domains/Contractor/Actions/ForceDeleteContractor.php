<?php

namespace App\Domains\Contractor\Actions;

use App\Support\Action;
use DomainException;

final class ForceDeleteContractor extends Action
{
    public function __invoke(int $id): void
    {
        $contractor = FindContractor::run($id);
        if ($contractor->receipts()->exists()) {
            throw new DomainException(
                'Нельзя удалить этого контрагента — есть связанные поступления'
            );
        }
        $contractor->forceDelete();
    }
}
