<?php

namespace App\Services\Receipt;

use App\DTO\Receipt\ReceiptDTO;
use App\Models\Receipt;
use Illuminate\Support\Facades\DB;
use Throwable;

readonly class ReceiptService
{
    public function __construct(
        private ReceiptCalculator $calculator
    ) {}

    /**
     * Создать поступление
     * @throws Throwable
     */
    public function create(ReceiptDTO $dto): Receipt
    {
        return $this->save(new Receipt(), $dto);
    }

    /**
     * Обновить поступление
     * @throws Throwable
     */
    public function update(Receipt $receipt, ReceiptDTO $dto): Receipt
    {
        return $this->save($receipt, $dto);
    }

    /**
     * Общий приватный метод сохранения
     * @throws Throwable
     */
    private function save(Receipt $receipt, ReceiptDTO $dto): Receipt
    {
        return DB::transaction(function () use ($receipt, $dto) {

            $totals = $this->calculator->calculateTotals($dto->items);

            // Сохраняем шапку
            $receipt->fill([
                'date' => $dto->date,
                'number' => $dto->number,
                'type' => $dto->type,
                'contractor_id' => $dto->contractor_id,
                'document_number' => $dto->document_number,
                'document_date' => $dto->document_date,
                'note' => $dto->note,
                'status' => $dto->status,
                'total_amount' => $totals['total_amount'],
                'total_vat' => $totals['total_vat'],
            ])->save();

            // Удаляем старые строки (если это update)
            if ($receipt->exists) {
                $receipt->items()->delete();
            }

            // Создаем строки
            foreach ($dto->items as $item) {
                $row = $this->calculator->calculateItem($item);
                $receipt->items()->create([
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'vat_id' => $item->vat_id,
                    'amount' => $row['amount'],
                    'vat_amount' => $row['vat_amount'],
                    'total_amount' => $row['total_amount'],
                ]);
            }

            return $receipt;
        });
    }

    /**
     * Опционально: удалить (soft delete)
     */
    public function delete(Receipt $receipt): void
    {
        $receipt->delete();
    }
}
