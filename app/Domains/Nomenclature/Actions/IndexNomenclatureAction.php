<?php

namespace App\Domains\Nomenclature\Actions;

use App\Domains\Nomenclature\Models\Nomenclature;
use Illuminate\View\View;

class IndexNomenclatureAction
{
    public function execute(): View
    {
        return view('dictionaries.nomenclatures.index', [
            'items' => Nomenclature::with(['category','unit'])
                ->latest()
                ->paginate(20),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Номенклатура'],
            ],
        ]);
    }
}
