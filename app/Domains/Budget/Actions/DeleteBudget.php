<?php

namespace App\Domains\Budget\Actions;

use App\Domains\Budget\Models\Budget;
use App\Support\Action;

final class DeleteBudget extends Action
{
    public function handle(Budget $budget): void
    {
        $budget->delete();
    }
}
