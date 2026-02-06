<?php

namespace App\Domains\Unit\Actions;

use App\Domains\Unit\DTO\UnitData;
use App\Domains\Unit\Models\Unit;

class CreateUnitAction
{
    public static function run(UnitData $data): Unit
    {
        return Unit::create((array) $data);
    }
}
