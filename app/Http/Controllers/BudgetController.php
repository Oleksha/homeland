<?php

namespace App\Http\Controllers;

use App\Domains\Budget\Actions\BudgetFormAction;
use App\Domains\Budget\Actions\CreateBudget;
use App\Domains\Budget\Actions\DeleteBudget;
use App\Domains\Budget\Actions\ForceDeleteBudget;
use App\Domains\Budget\Actions\ImportBudgetsAction;
use App\Domains\Budget\Actions\IndexBudgetsAction;
use App\Domains\Budget\Actions\RestoreBudget;
use App\Domains\Budget\Actions\UpdateBudget;
use App\Domains\Budget\DTO\BudgetData;
use App\Domains\Budget\Imports\BudgetXlsxImport;
use App\Domains\Budget\Models\Budget;
use App\Http\Requests\BudgetImportRequest;
use App\Http\Requests\BudgetIndexRequest;
use App\Http\Requests\BudgetRequest;
use Vtiful\Kernel\Excel;

class BudgetController extends Controller
{
    /**
     * Отображение списка бюджетных операций.
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
     * Вывод формы добавления бюджетной операции.
     */
    public function create(BudgetFormAction $action)
    {
        return $action->execute();
    }

    /**
     * Сохранение новой БО в БД.
     */
    public function store(BudgetRequest $request)
    {
        CreateBudget::run(BudgetData::fromArray($request->validated()));

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Бюджетная операция добавлена.');
    }

    /**
     * Просмотр выбранной БО.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Вывод формы изменения бюджетной операции.
     */
    public function edit(Budget $budget, BudgetFormAction $action)
    {
        return $action->execute($budget);
    }

    /**
     * Сохранение изменений БО в БД.
     */
    public function update(BudgetRequest $request, Budget $budget)
    {
        UpdateBudget::run($budget, BudgetData::fromArray($request->validated()));

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Бюджетная операция изменена.');
    }

    /**
     * Перенос БО в архив.
     */
    public function destroy(Budget $budget)
    {
        DeleteBudget::run($budget);

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Бюджетная операция перемещена в архив.');
    }

    /**
     * Восстановление БО из архив.
     */
    public function restore(int $id)
    {
        RestoreBudget::run($id);

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Бюджетная операция восстановлена.');
    }

    /**
     * Полное удаление БО из БД.
     */
    public function forceDelete(int $id)
    {
        ForceDeleteBudget::run($id);

        return redirect()
            ->route('budgets.archive')
            ->with('success', 'Бюджетная операция удалена навсегда.');
    }

    /**
     * Импорт списка БО из файла Excel.
     */
    public function import(BudgetImportRequest $request)
    {
        $import = new BudgetXlsxImport();

        Excel::import($import, $request->file('file'));

        $result = ImportBudgetsAction::run($import->rows());

        return back()->with('importResult', $result);
    }

}
