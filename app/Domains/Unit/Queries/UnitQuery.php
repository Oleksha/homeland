<?php

namespace App\Domains\Unit\Queries;

use App\Domains\Unit\Models\Unit;

class UnitQuery
{
    public function get(): Unit|array
    {
        return Unit::query()
            ->orderBy('name')
            ->get();
    }
}
