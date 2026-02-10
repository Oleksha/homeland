<?php

namespace App\Http\Controllers;

use App\Domains\Nomenclature\Actions\{CreateNomenclatureAction,
    DeleteNomenclatureAction,
    EditNomenclatureAction,
    ForceDeleteNomenclatureAction,
    IndexNomenclatureAction,
    RestoreNomenclatureAction,
    StoreNomenclatureAction,
    UpdateNomenclatureAction};
use App\Domains\Nomenclature\DTO\NomenclatureData;
use App\Domains\Nomenclature\Models\Nomenclature;
use App\Http\Requests\NomenclatureRequest;

class NomenclatureController extends Controller
{
    public function index(IndexNomenclatureAction $action)
    {
        return $action->execute();
    }

    public function create(CreateNomenclatureAction $action)
    {
        return $action->execute();
    }

    public function store(NomenclatureRequest $request, StoreNomenclatureAction $action)
    {
        $action->execute(
            NomenclatureData::fromRequest($request->validated())
        );

        return redirect()
            ->route('nomenclatures.index')
            ->with('success','Номенклатура добавлена.');
    }

    public function edit(Nomenclature $nomenclature, EditNomenclatureAction $action)
    {
        return $action->execute($nomenclature);
    }

    public function update(NomenclatureRequest $request, Nomenclature $nomenclature, UpdateNomenclatureAction $action)
    {
        $action->execute(
            $nomenclature,
            NomenclatureData::fromRequest($request->validated())
        );

        return redirect()
            ->route('nomenclatures.index')
            ->with('success','Номенклатура изменена.');
    }

    public function destroy(Nomenclature $nomenclature, DeleteNomenclatureAction $action)
    {
        $action->execute($nomenclature);

        return redirect()
            ->route('nomenclatures.index')
            ->with('success','Номенклатура перемещена в архив.');
    }

    public function restore($id, RestoreNomenclatureAction $action)
    {
        $action->execute($id);

        return redirect()
            ->route('nomenclatures.index')
            ->with('success','Номенклатура восстановлена.');
    }

    public function archive()
    {
        return view('dictionaries.nomenclatures.archive', [
            'items' => Nomenclature::onlyTrashed()
                ->with(['category','unit'])
                ->paginate(20),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Архив номенклатуры'],
            ],
        ]);
    }

    public function forceDelete($id, ForceDeleteNomenclatureAction $action)
    {
        $action->execute($id);

        return redirect()->route('nomenclatures.index')
            ->with('success','Номенклатура удалена навсегда.');
    }

}
