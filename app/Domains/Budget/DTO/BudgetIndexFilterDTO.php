<?php

namespace App\Domains\Budget\DTO;

use App\Domains\Budget\Enums\BudgetStatus;
use Carbon\CarbonImmutable;

class BudgetIndexFilterDTO
{
    public function __construct(
        public ?CarbonImmutable $period,
        public ?BudgetStatus $status,
        public bool $archived,
    ) {}
}
