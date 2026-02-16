<?php

namespace App\Domains\Payment\DTO;

use App\Http\Requests\PaymentRequestIndexRequest;
use Carbon\CarbonImmutable;

final readonly class PaymentRequestIndexFilterDTO
{
    public function __construct(
        public CarbonImmutable $month,
        public ?string $status = null,
    ) {}

    public static function fromRequest(PaymentRequestIndexRequest $request): self
    {
        $month = $request->get('month')
            ? CarbonImmutable::createFromFormat('Y-m', $request->get('month'))->startOfMonth()
            : CarbonImmutable::now()->startOfMonth();

        return new self(
            month: $month,
            status: $request->get('status')
        );
    }
}
