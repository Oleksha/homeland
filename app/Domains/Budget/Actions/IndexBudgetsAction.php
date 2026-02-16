<?php

namespace App\Domains\Budget\Actions;

use App\Domains\Budget\DTO\BudgetIndexFilterDTO;
use App\Domains\Budget\Models\Budget;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexBudgetsAction
{
    public function execute(BudgetIndexFilterDTO $filter): LengthAwarePaginator
    {
        return Budget::query()
            ->when($filter->archived, fn ($q) => $q->onlyTrashed())

            ->when($filter->period, function ($q) use ($filter) {
                $q->whereBetween('budget_period', [
                    $filter->period->copy()->startOfMonth(),
                    $filter->period->copy()->endOfMonth(),
                ]);
            })

            ->when($filter->status,
                fn ($q) => $q->where('status', $filter->status->value)
            )

            ->with(['vat', 'expenseItem'])
            ->orderByDesc('budget_period')
            ->paginate(10)
            ->withQueryString();
    }
}
