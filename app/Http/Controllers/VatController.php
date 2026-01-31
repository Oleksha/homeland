<?php

namespace App\Http\Controllers;

use App\Domains\Vat\Actions\CreateVat;
use App\Domains\Vat\Actions\DeleteVat;
use App\Domains\Vat\Actions\GetActiveVats;
use App\Domains\Vat\Actions\UpdateVat;
use App\Domains\Vat\DTO\VatData;
use App\Domains\Vat\Models\Vat;
use App\Http\Requests\VatRequest;
use Throwable;

class VatController extends Controller
{
    public function index()
    {
        return view('dictionaries.vats.index', [
            'vats' => GetActiveVats::run(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'НДС'],
            ],
        ]);
    }

    public function create()
    {
        return view('dictionaries.vats.form', [
            'vat' => new Vat(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'НДС', 'url' => route('vats.index')],
                ['title' => 'Добавление'],
            ],
        ]);
    }

    /**
     * @throws Throwable
     */
    public function store(VatRequest $request)
    {
        CreateVat::run(VatData::fromArray($request->payload()));

        return redirect()
            ->route('vats.index')
            ->with('success', 'Ставка НДС сохранена.');
    }

    public function edit(Vat $vat)
    {
        return view('dictionaries.vats.form', [
            'vat' => $vat,
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => route('directories.index')],
                ['title' => 'НДС', 'url' => route('vats.index')],
                ['title' => 'Редактирование'],
            ],
        ]);
    }

    /**
     * @throws Throwable
     */
    public function update(VatRequest $request, Vat $vat)
    {
        UpdateVat::run($vat, VatData::fromArray($request->payload()));

        return redirect()
            ->route('vats.index')
            ->with('success', 'Ставка НДС обновлена.');
    }

    public function destroy(Vat $vat)
    {
        DeleteVat::run($vat);

        return redirect()
            ->route('vats.index')
            ->with('success', 'Ставка НДС удалена.');
    }
}
