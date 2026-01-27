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
     * Создать поступление с элементами
     * @throws Throwable
     */
    public function create(ReceiptDTO $dto): Receipt
    {
        return DB::transaction(function () use ($dto) {

            $totals = $this->calculator->calculateTotals($dto->items);

            $receipt = Receipt::create([
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
            ]);

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
     * Обновить поступление
     * @throws Throwable
     */
    public function update(Receipt $receipt, ReceiptDTO $dto): Receipt
    {
        return DB::transaction(function () use ($receipt, $dto) {

            $totals = $this->calculator->calculateTotals($dto->items);

            $receipt->update([
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
            ]);

            $receipt->items()->delete();

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
