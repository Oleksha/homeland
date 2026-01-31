<?php

namespace App\Domains\Receipt\Actions;

use App\Domains\Receipt\Calculators\ReceiptCalculator;
use App\Domains\Receipt\DTO\ReceiptDTO;
use App\Domains\Receipt\Models\Receipt;
use App\Support\Action;
use Illuminate\Support\Facades\DB;
use Throwable;

abstract class BaseSaveReceipt extends Action
{
    public function __construct(
        protected ReceiptCalculator $calculator
    ) {}

    /**
     * @throws Throwable
     */
    protected function save(Receipt $receipt, ReceiptDTO $dto): Receipt
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

            // при update — пересоздаем строки
            if ($receipt->exists) {
                $receipt->items()->delete();
            }

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
}
