<?php

namespace App\Http\Controllers;

use App\Domains\Unit\Actions\ArchiveUnitsAction;
use App\Domains\Unit\Actions\CreateUnitAction;
use App\Domains\Unit\Actions\DeleteUnitAction;
use App\Domains\Unit\Actions\ForceDeleteUnitAction;
use App\Domains\Unit\Actions\IndexUnitAction;
use App\Domains\Unit\Actions\RestoreUnitAction;
use App\Domains\Unit\Actions\UpdateUnitAction;
use App\Domains\Unit\DTO\UnitData;
use App\Domains\Unit\Models\Unit;
use App\Http\Requests\UnitRequest;

class UnitController extends Controller
{
    public function index(IndexUnitAction $action)
    {
        return $action->execute();
    }

    public function create()
    {
        return view('dictionaries.units.form', [
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Единицы измерений', 'url' => route('units.index')],
                ['title' => 'Добавление'],
            ],
        ]);
    }

    public function store(UnitRequest $request)
    {
        CreateUnitAction::run(
            UnitData::fromRequest($request->validated())
        );

        return redirect()->route('units.index')
            ->with('success','Добавлена Единица измерения.');
    }

    public function edit(Unit $unit)
    {
        return view('dictionaries.units.form', [
            'unit' => $unit,
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Единицы измерений', 'url' => route('units.index')],
                ['title' => 'Редактирование'],
            ],
        ]);
    }

    public function update(UnitRequest $request, Unit $unit)
    {
        UpdateUnitAction::run(
            $unit,
            UnitData::fromRequest($request->validated())
        );

        return redirect()->route('units.index')
            ->with('success','Изменена Единица измерения.');
    }

    public function destroy(Unit $unit)
    {
        DeleteUnitAction::run($unit);

        return redirect()->route('units.index')
            ->with('success','Единица измерения перемещена в архив.');
    }

    public function archive(ArchiveUnitsAction $action)
    {
        return $action->execute();
    }

    public function restore(int $id)
    {
        RestoreUnitAction::run($id);

        return redirect()->route('units.index')
            ->with('success','Единица измерения восстановлена.');
    }

    public function forceDelete(int $id)
    {
        ForceDeleteUnitAction::run($id);

        return redirect()->route('units.index')
            ->with('success','Единица измерения удалена навсегда');
    }
}
