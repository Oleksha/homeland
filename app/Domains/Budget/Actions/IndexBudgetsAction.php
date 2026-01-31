<?php

namespace App\Domains\Budget\Actions;

use App\Domains\Budget\DTO\BudgetIndexFilterDTO;
use App\Domains\Budget\Models\Budget;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexBudgetsAction
{
    public function execute(BudgetIndexFilterDTO $filter): LengthAwarePaginator
    {
        $query = Budget::query();

        // Архив
        if ($filter->archived) {
            $query->onlyTrashed();
        }

        // Период (сценарий)
        if ($filter->period) {
            $query->whereDate('budget_period', $filter->period);
        }

        // Статус
        if ($filter->status) {
            $query->where('status', $filter->status->value);
        }

        return $query
            ->with(['vat', 'expenseItem'])
            ->orderByDesc('budget_period')
            ->paginate(20)
            ->withQueryString();
    }
}
