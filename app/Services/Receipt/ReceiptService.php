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

            // 🔥 ЕДИНСТВЕННЫЙ расчет
            $calculated = $this->calculator->calculate($dto->items);

            // Шапка
            $receipt->fill([
                'date' => $dto->date,
                'number' => $dto->number,
                'type' => $dto->type,
                'contractor_id' => $dto->contractor_id,
                'document_number' => $dto->document_number,
                'document_date' => $dto->document_date,
                'note' => $dto->note,
                'status' => $dto->status,
                'total_amount' => $calculated->totalAmount,
                'total_vat' => $calculated->totalVat,
            ])->save();

            // строки при update
            if ($receipt->exists) {
                $receipt->items()->delete();
            }

            // строки
            foreach ($calculated->items as $item) {
                $receipt->items()->create([
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'vat_id' => $item->vat_id,
                    'amount' => $item->amount,
                    'vat_amount' => $item->vat_amount,
                    'total_amount' => $item->total_amount,
                ]);
            }

            return $receipt;
        });
    }

    /**
     * Удаление (soft delete)
     */
    public function delete(Receipt $receipt): void
    {
        $receipt->delete();
    }

    /**
     * Восстановление записей
     */
    public function restore(Receipt $receipt): void
    {
        $receipt->restore();
    }
}
