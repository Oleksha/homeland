<?php

namespace App\Http\Controllers;

use App\DTO\Vat\VatData;
use App\Http\Requests\VatRequest;
use App\Models\Vat;
use App\Services\Vat\VatService;
use Throwable;

class VatController extends Controller
{
    public function __construct(
        private readonly VatService $vatService
    ) {}

    public function index()
    {
        return view('vats.index', [
            'vats' => $this->vatService->getActive(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => '#'],
                ['title' => 'НДС'],
            ],
        ]);
    }

    public function create()
    {
        return view('vats.form', [
            'vat' => new Vat(),
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => '#'],
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
        $this->vatService->store(
            VatData::fromArray($request->payload())
        );

        return redirect()
            ->route('vats.index')
            ->with('success', 'Ставка НДС сохранена.');
    }

    public function edit(Vat $vat)
    {
        return view('vats.form', [
            'vat' => $vat,
            'breadcrumbs' => [
                ['title' => 'Справочники', 'url' => '#'],
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
        $this->vatService->update(
            $vat,
            VatData::fromArray($request->payload())
        );

        return redirect()
            ->route('vats.index')
            ->with('success', 'Ставка НДС обновлена.');
    }

    public function destroy(Vat $vat)
    {
        if ($vat->is_default) {
            return back();
        }

        $vat->delete();

        return redirect()
            ->route('vats.index')
            ->with('success', 'Ставка НДС удалена.');
    }
}
