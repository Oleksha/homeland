<?php

namespace App\Domains\Unit\Actions;

use App\Domains\Unit\Models\Unit;

class RestoreUnitAction
{
    public static function run(int $id): void
    {
        Unit::withTrashed()
            ->findOrFail($id)
            ->restore();
    }
}
