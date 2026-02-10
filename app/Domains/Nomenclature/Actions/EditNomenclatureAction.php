<?php

namespace App\Domains\Nomenclature\Actions;

use App\Domains\Category\Models\Category;
use App\Domains\Nomenclature\Models\Nomenclature;
use App\Domains\Unit\Models\Unit;
use Illuminate\View\View;

class EditNomenclatureAction
{
    public function execute(Nomenclature $nomenclature): View
    {
        return view('dictionaries.nomenclatures.form', [
            'nomenclature' => $nomenclature,
            'categories' => Category::orderBy('name')->get(),
            'units' => Unit::orderBy('name')->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Номенклатура', 'url' => route('nomenclatures.index')],
                ['title' => 'Редактирование'],
            ],
        ]);
    }
}
