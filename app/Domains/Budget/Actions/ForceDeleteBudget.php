<?php

namespace App\Domains\Budget\Actions;

use App\Domains\Budget\Models\Budget;
use App\Support\Action;

final class ForceDeleteBudget extends Action
{
    public function handle(int $id): void
    {
        Budget::withTrashed()->findOrFail($id)->forceDelete();
    }
}
