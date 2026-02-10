<?php

namespace App\Domains\Nomenclature\Actions;

use App\Domains\Category\Models\Category;
use App\Domains\Nomenclature\Models\Nomenclature;
use App\Domains\Unit\Models\Unit;
use Illuminate\View\View;

class CreateNomenclatureAction
{
    public function execute(?int $categoryId = null): View
    {
        return view('dictionaries.nomenclatures.form', [
            'nomenclature' => new Nomenclature([
                'category_id' => $categoryId
            ]),
            'categories' => Category::orderBy('name')->get(),
            'units' => Unit::orderBy('name')->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Номенклатура', 'url' => route('nomenclatures.index')],
                ['title' => 'Добавление']
            ],
        ]);
    }
}
