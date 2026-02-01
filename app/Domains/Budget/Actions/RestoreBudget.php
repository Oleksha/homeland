<?php

namespace App\Domains\Budget\Actions;

use App\Domains\Budget\Models\Budget;
use App\Support\Action;

final class RestoreBudget extends Action
{
    public function __invoke(int $id): void
    {
        Budget::withTrashed()->findOrFail($id)->restore();
    }
}
