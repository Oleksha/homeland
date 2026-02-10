<?php

namespace App\Domains\Unit\Queries;

use App\Domains\Unit\Models\Unit;
use Illuminate\Pagination\LengthAwarePaginator;

class UnitQuery
{
    public function get(): LengthAwarePaginator|Unit|array
    {
        return Unit::query()
            ->orderBy('name')
            ->paginate(10);
    }
}
