<?php

namespace App\Domains\Budget\Actions;

use App\Domains\Budget\Models\Budget;
use App\Domains\ExpenseItem\Models\ExpenseItem;
use App\Domains\Vat\Models\Vat;
use Illuminate\View\View;

class BudgetFormAction
{
    public function execute(?Budget $budget = null): View
    {
        $isEdit = $budget !== null;

        return view(
            $isEdit ? 'budget.edit' : 'budget.create',
            [
                'budget' => $budget,
                'expenseItems' => ExpenseItem::orderBy('name')->get(),
                'vats' => Vat::orderBy('rate')->get(),
                'breadcrumbs' => $this->breadcrumbs($budget),
            ]
        );
    }

    private function breadcrumbs(?Budget $budget): array
    {
        return [
            ['title' => 'Бюджетные операции', 'url' => route('budgets.index')],
            [
                'title' => $budget
                    ? 'Изменение бюджетной операции'
                    : 'Новая бюджетная операция'
            ],
        ];
    }
}
