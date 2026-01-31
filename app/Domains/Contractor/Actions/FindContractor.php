<?php

namespace App\Domains\Contractor\Actions;

use App\Domains\Contractor\Models\Contractor;
use App\Support\Action;

final class FindContractor extends Action
{
    public function __invoke(int $id): Contractor
    {
        return Contractor::withTrashed()->findOrFail($id);
    }
}
