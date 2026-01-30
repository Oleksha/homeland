<?php

namespace App\Http\Controllers;

use App\Domains\Contractor\DTO\ContractorData;
use App\Domains\Contractor\Models\Contractor;
use App\Domains\ContractorType\Models\ContractorType;
use App\Domains\Vat\Models\Vat;
use App\Http\Requests\ContractorRequest;
use App\Services\Contractor\ContractorService;

class ContractorController extends Controller
{
    public function index()
    {
        return view('contractors.index', [
            'contractors' => Contractor::with(['type', 'vat'])
                ->orderBy('name')
                ->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Контрагенты'],
            ],
        ]);
    }

    public function archive()
    {
        return view('contractors.archive', [
            'contractors' => Contractor::onlyTrashed()
                ->with(['type', 'vat'])
                ->orderBy('name')
                ->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Контрагенты', 'url' => route('contractors.index')],
                ['title' => 'Архив'],
            ],
        ]);
    }

    public function create()
    {
        return view('contractors.form', [
            'contractor' => new Contractor(),
            'types' => ContractorType::all(),
            'vats' => Vat::all(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Контрагенты', 'url' => route('contractors.index')],
                ['title' => 'Добавление'],
            ],
        ]);
    }

    public function store(
        ContractorRequest $request,
        ContractorService $service
    ) {
        $service->store(ContractorData::fromArray($request->validated()));

        return redirect()
            ->route('contractors.index')
            ->with('success', 'Контрагент добавлен');
    }

    public function show(Contractor $contractor)
    {
        $contractor->load('type', 'vat');

        $receipts = $contractor->receipts()
            ->latest('date')
            ->limit(20) // чтобы не убить страницу
            ->get();

        return view('contractors.show', [
            'contractor' => $contractor,
            'receipts' => $receipts,
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Контрагенты', 'url' => route('contractors.index')],
                ['title' => $contractor->name],
            ],
        ]);
    }

    public function edit(Contractor $contractor)
    {
        return view('contractors.form', [
            'contractor' => $contractor,
            'types' => ContractorType::orderBy('name')->get(),
            'vats' => Vat::orderBy('rate')->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Контрагенты', 'url' => route('contractors.index')],
                ['title' => 'Редактирование'],
            ],
        ]);
    }

    public function update(
        ContractorRequest $request,
        Contractor $contractor,
        ContractorService $service)
    {
        $dto = ContractorData::fromArray($request->validated());
        $service->update($contractor, $dto);

        return redirect()->route('contractors.index')
            ->with('success', 'Контрагент обновлён');
    }

    public function destroy(Contractor $contractor)
    {
        $contractor->delete();

        return redirect()
            ->route('contractors.index')
            ->with('success', 'Контрагент перемещён в архив');
    }

    public function restore(int $id)
    {
        $contractor = Contractor::onlyTrashed()->findOrFail($id);
        $contractor->restore();

        return redirect()
            ->route('contractors.archive')
            ->with('success', 'Контрагент восстановлен');
    }

    public function forceDelete(int $id)
    {
        $contractor = Contractor::onlyTrashed()->findOrFail($id);
        $contractor->forceDelete();

        return redirect()
            ->route('contractors.archive')
            ->with('success', 'Контрагент удалён навсегда');
    }

}
