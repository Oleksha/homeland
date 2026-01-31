<?php

namespace App\Domains\Receipt\Actions;

use App\Domains\Contractor\Actions\FindContractor;
use App\Support\Action;
use DomainException;

final class ForceDeleteReceipt extends Action
{
    public function __invoke(int $id): void
    {
        $receipt = FindReceipt::run($id);
        $receipt->forceDelete();
    }
}
