<?php

namespace App\Domains\Unit\Actions;

use App\Domains\Unit\Models\Unit;
use Illuminate\View\View;

class ArchiveUnitsAction
{
    public function execute(): View
    {
        return view('dictionaries.units.archive', [
            'units' => Unit::onlyTrashed()->orderBy('name')->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Единицы измерений'],
            ],
        ]);
    }
}
