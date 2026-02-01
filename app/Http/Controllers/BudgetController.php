<?php

namespace App\Http\Controllers;

use App\Domains\Budget\Actions\BudgetFormAction;
use App\Domains\Budget\Actions\CreateBudget;
use App\Domains\Budget\Actions\DeleteBudget;
use App\Domains\Budget\Actions\ForceDeleteBudget;
use App\Domains\Budget\Actions\IndexBudgetsAction;
use App\Domains\Budget\Actions\RestoreBudget;
use App\Domains\Budget\Actions\UpdateBudget;
use App\Domains\Budget\DTO\BudgetData;
use App\Domains\Budget\Models\Budget;
use App\Http\Requests\BudgetIndexRequest;
use App\Http\Requests\BudgetRequest;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        BudgetIndexRequest $request,
        IndexBudgetsAction $action
    )
    {
        return view('budget.index', [
            'budgets' => $action->execute($request->toDto()),
            'filters' => $request->validated(),
            'breadcrumbs' => [
                ['title' => 'Бюджетные операции'],
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BudgetFormAction $action)
    {
        return $action->execute();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BudgetRequest $request)
    {
        CreateBudget::run(BudgetData::fromArray($request->validated()));

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Бюджетная операция добавлена.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget, BudgetFormAction $action)
    {
        return $action->execute($budget);
        /*return view('budget.edit', [
            'budget' => $budget,
            'breadcrumbs' => [
                ['title' => 'Бюджетные операции', 'url' => route('budgets.index')],
                ['title' => 'Изменение бюджетной операции'],
            ],
        ]);*/
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BudgetRequest $request, Budget $budget)
    {
        UpdateBudget::run($budget, BudgetData::fromArray($request->validated()));

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Бюджетная операция изменена.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget)
    {
        DeleteBudget::run($budget);

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Бюджетная операция перемещена в архив.');
    }

    public function restore(int $id)
    {
        RestoreBudget::run($id);

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Бюджетная операция восстановлена.');
    }

    public function forceDelete(int $id)
    {
        ForceDeleteBudget::run($id);

        return redirect()
            ->route('budgets.archive')
            ->with('success', 'Бюджетная операция удалена навсегда.');
    }
}
