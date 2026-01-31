<?php

namespace App\Domains\Contractor\Actions;

use App\Support\Action;

final class RestoreContractor extends Action
{
    public function __invoke(int $id): void
    {
        FindContractor::run($id)->restore();
    }
}
