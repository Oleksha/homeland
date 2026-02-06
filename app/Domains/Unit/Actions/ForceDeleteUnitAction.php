<?php

namespace App\Domains\Unit\Actions;

use App\Domains\Unit\Models\Unit;

class ForceDeleteUnitAction
{
    public static function run(int $id): void
    {
        Unit::withTrashed()
            ->findOrFail($id)
            ->forceDelete();
    }
}
