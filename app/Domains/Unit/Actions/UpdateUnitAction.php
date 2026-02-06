<?php

namespace App\Domains\Unit\Actions;

use App\Domains\Unit\DTO\UnitData;
use App\Domains\Unit\Models\Unit;

class UpdateUnitAction
{
    public static function run(Unit $unit, UnitData $data): Unit
    {
        $unit->update((array) $data);

        return $unit;
    }
}
