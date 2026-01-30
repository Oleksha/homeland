<?php

namespace App\Http\Controllers;

use App\Domains\ExpenseItem\Actions\CreateExpenseItem;
use App\Domains\ExpenseItem\Actions\DeleteExpenseItem;
use App\Domains\ExpenseItem\Actions\ForceDeleteExpenseItem;
use App\Domains\ExpenseItem\Actions\RestoreExpenseItem;
use App\Domains\ExpenseItem\Actions\UpdateExpenseItem;
use App\Domains\ExpenseItem\DTO\ExpenseItemDTO;
use App\Domains\ExpenseItem\Models\ExpenseItem;
use App\Http\Requests\ExpenseItemRequest;

class ExpenseItemController extends Controller
{
    public function index()
    {
        $items = ExpenseItem::query()
            ->orderBy('expense_items.name')
            ->paginate(10);

        return view('dictionaries.expense_items.index', compact('items'));
    }

    public function create()
    {
        return view('dictionaries.expense_items.create');
    }

    public function store(ExpenseItemRequest $request)
    {
        CreateExpenseItem::run(
            ExpenseItemDTO::fromRequest($request->validated())
        );

        return redirect()
            ->route('expense-items.index')
            ->with('success', 'Статья расхода создана');
    }

    public function edit(ExpenseItem $expenseItem)
    {
        return view(
            'dictionaries.expense_items.edit',
            ['item' => $expenseItem]
        );
    }

    public function update(ExpenseItemRequest $request, ExpenseItem $expenseItem)
    {
        UpdateExpenseItem::run(
            $expenseItem,
            ExpenseItemDTO::fromRequest($request->validated())
        );

        return redirect()
            ->route('expense-items.index')
            ->with('success', 'Статья расхода обновлена');
    }

    public function destroy(ExpenseItem $expenseItem)
    {
        DeleteExpenseItem::run($expenseItem);

        return redirect()
            ->route('expense-items.index')
            ->with('success', 'Статья расхода отправлена в архив');
    }

    public function archive()
    {
        $items = ExpenseItem::onlyTrashed()
            ->latest('deleted_at')
            ->paginate(20);

        return view('dictionaries.expense_items.archive', compact('items'));
    }

    public function restore(int $id)
    {
        RestoreExpenseItem::run($id);

        return redirect()
            ->route('expense-items.archive')
            ->with('success', 'Статья восстановлена');
    }

    public function forceDelete(int $id)
    {
        ForceDeleteExpenseItem::run($id);

        return redirect()
            ->route('expense-items.archive')
            ->with('success', 'Статья удалена окончательно');
    }
}
