<?php

namespace App\Domains\Contractor\Actions;

use App\Domains\Contractor\Models\Contractor;
use App\Support\Action;

final class RestoreContractor extends Action
{
    public function __invoke(int $id): void
    {
        Contractor::withTrashed()
            ->findOrFail($id)
            ->restore();
    }
}
