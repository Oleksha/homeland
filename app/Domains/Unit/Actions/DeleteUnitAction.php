<?php

namespace App\Domains\Unit\Actions;

use App\Domains\Unit\Models\Unit;

class DeleteUnitAction
{
    public static function run(Unit $unit): void
    {
        $unit->delete();
    }
}
