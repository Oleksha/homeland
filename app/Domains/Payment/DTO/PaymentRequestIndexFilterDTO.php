<?php

namespace App\Domains\Payment\DTO;

use App\Domains\Payment\Enums\PaymentRequestStatus;
use Carbon\CarbonImmutable;

final class PaymentRequestIndexFilterDTO
{
    public function __construct(
        public ?CarbonImmutable $period,
        public ?PaymentRequestStatus $status,
        public bool $archived,
    ) {}
}
