<?php

namespace App\Domains\Unit\Actions;

use App\Domains\Unit\Queries\UnitQuery;
use Illuminate\View\View;

class IndexUnitAction
{
    public function execute(): View
    {
        return view('dictionaries.units.index', [
            'units' => (new UnitQuery())->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Единицы измерений'],
            ],
        ]);
    }
}
