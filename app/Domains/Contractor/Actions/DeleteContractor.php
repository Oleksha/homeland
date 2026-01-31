<?php

namespace App\Domains\Contractor\Actions;

use App\Domains\Contractor\Models\Contractor;
use App\Support\Action;

final class DeleteContractor extends Action
{
    public function __invoke(Contractor $contractor): void
    {
        $contractor->delete();
    }
}
