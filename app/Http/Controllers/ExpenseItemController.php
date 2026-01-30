<?php

namespace App\Http\Controllers;

use App\Domains\ExpenseItem\DTO\ExpenseItemDTO;
use App\Domains\ExpenseItem\Models\ExpenseItem;
use App\Http\Requests\ExpenseItemRequest;
use App\Services\ExpenseItem\ExpenseItemService;

class ExpenseItemController extends Controller
{
    public function __construct(
        private readonly ExpenseItemService $service
    ) {}

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
        $dto = ExpenseItemDTO::fromRequest($request->validated());

        $this->service->create($dto);

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
        $dto = ExpenseItemDTO::fromRequest($request->validated());

        $this->service->update($expenseItem, $dto);

        return redirect()
            ->route('expense-items.index')
            ->with('success', 'Статья расхода обновлена');
    }

    public function destroy(ExpenseItem $expenseItem)
    {
        $this->service->delete($expenseItem);

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
        $this->service->restore($id);

        return redirect()
            ->route('expense-items.archive')
            ->with('success', 'Статья восстановлена');
    }

    public function forceDelete(int $id)
    {
        $this->service->forceDelete($id);

        return redirect()
            ->route('expense-items.archive')
            ->with('success', 'Статья удалена окончательно');
    }
}
