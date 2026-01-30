<?php

namespace App\Http\Controllers;

use App\Domains\Contractor\DTO\ContractorTypeData;
use App\Domains\Contractor\Models\ContractorType;
use App\Http\Requests\ContractorTypeRequest;
use App\Services\ContractorType\ContractorTypeService;

class ContractorTypeController extends Controller
{
    public function __construct(
        private readonly ContractorTypeService $service
    ) {}

    public function index()
    {
        return view('contractor-types.index', [
            'types' => ContractorType::orderBy('name')->get(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Типы контрагентов'],
            ],
        ]);
    }

    public function create()
    {
        return view('contractor-types.form', [
            'type' => new ContractorType(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Типы контрагентов', 'url' => route('contractor-types.index')],
                ['title' => 'Добавление'],
            ],
        ]);
    }

    public function store(ContractorTypeRequest $request)
    {
        $this->service->store(
            ContractorTypeData::fromArray($request->payload())
        );

        return redirect()
            ->route('contractor-types.index')
            ->with('success', 'Создан Тип контрагента.');
    }

    public function edit(ContractorType $contractorType)
    {
        return view('contractor-types.form', [
            'type' => $contractorType,
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'Типы контрагентов', 'url' => route('contractor-types.index')],
                ['title' => 'Редактирование'],
            ],
        ]);
    }

    public function update(
        ContractorTypeRequest $request,
        ContractorType $contractorType
    ) {
        $this->service->update(
            $contractorType,
            ContractorTypeData::fromArray($request->payload())
        );

        return redirect()
            ->route('contractor-types.index')
            ->with('success', 'Изменен Тип контрагента.');
    }

    public function destroy(ContractorType $contractorType)
    {
        $this->service->delete($contractorType);

        return redirect()
            ->route('contractor-types.index')
            ->with('success', 'Удален Тип контрагента.');
    }
}
