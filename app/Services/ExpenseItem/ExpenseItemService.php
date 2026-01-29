<?php

namespace App\Services\ExpenseItem;

use App\DTO\ExpenseItem\ExpenseItemDTO;
use App\Models\ExpenseItem;

readonly class ExpenseItemService
{
    public function create(ExpenseItemDTO $dto): ExpenseItem
    {
        return ExpenseItem::create([
            'name' => $dto->name,
            'is_report_selection' => $dto->is_report_selection,
        ]);
    }

    public function update(ExpenseItem $item, ExpenseItemDTO $dto): ExpenseItem
    {
        $item->update([
            'name' => $dto->name,
            'is_report_selection' => $dto->is_report_selection,
        ]);

        return $item;
    }

    public function delete(ExpenseItem $item): void
    {
        $item->delete();
    }

    public function restore(int $id): void
    {
        ExpenseItem::withTrashed()
            ->findOrFail($id)
            ->restore();
    }

    public function forceDelete(int $id): void
    {
        ExpenseItem::withTrashed()
            ->findOrFail($id)
            ->forceDelete();
    }
}
