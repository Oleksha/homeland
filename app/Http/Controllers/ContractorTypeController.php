<?php

namespace App\Http\Controllers;

use App\Models\ContractorType;
use App\Http\Requests\ContractorTypeRequest;
use App\Services\ContractorType\ContractorTypeService;
use App\DTO\ContractorType\ContractorTypeData;

class ContractorTypeController extends Controller
{
    public function __construct(
        private readonly ContractorTypeService $service
    ) {}

    public function index()
    {
        return view('contractor-types.index', [
            'types' => ContractorType::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('contractor-types.form', [
            'type' => new ContractorType(),
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
