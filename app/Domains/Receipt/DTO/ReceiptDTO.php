<?php

namespace App\Domains\Receipt\DTO;

use App\Domains\Receipt\Enums\ReceiptType;
use Carbon\Carbon;
use InvalidArgumentException;

final readonly class ReceiptDTO
{
    /**
     * @param ReceiptItemDTO[] $items
     */
    public function __construct(
        public Carbon      $date,
        public string      $number,
        public ReceiptType $type,
        public int         $contractor_id,
        public ?string     $document_number,
        public ?Carbon     $document_date,
        public ?string     $note,
        public bool        $status,
        public float       $total_amount, // сумма С НДС
        public float       $total_vat,    // НДС внутри суммы
        public array       $items,
    ) {}

    public static function fromRequest(array $data, array $vatRates): self
    {
        if (empty($data['date'])) {
            throw new InvalidArgumentException('Требуется указать дату поступления.');
        }

        $items = collect($data['items'] ?? [])
            ->map(function ($item) use ($vatRates) {
                $vatId = (int) $item['vat_id'];

                if (!isset($vatRates[$vatId])) {
                    throw new InvalidArgumentException("Неизвестная ставка НДС: $vatId");
                }

                return ReceiptItemDTO::fromArray(
                    $item,
                    (float) $vatRates[$vatId]
                );
            })
            ->values()
            ->all();

        return new self(
            date: Carbon::parse($data['date']),
            number: $data['number'],
            type: ReceiptType::from((int)$data['type']),
            contractor_id: (int)$data['contractor_id'],
            document_number: $data['document_number'] ?? null,
            document_date: !empty($data['document_date'])
                ? Carbon::parse($data['document_date'])
                : null,
            note: $data['note'] ?? null,
            status: (bool)($data['status'] ?? true),
            total_amount: round(collect($items)->sum('total_amount'), 2),
            total_vat: round(collect($items)->sum('vat_amount'), 2),
            items: $items,
        );
    }
}
