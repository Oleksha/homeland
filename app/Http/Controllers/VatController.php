<?php

namespace App\Http\Controllers;

use App\DTO\Vat\VatData;
use App\Http\Requests\VatRequest;
use App\Models\Vat;
use App\Services\Vat\VatService;
use Illuminate\Http\Request;
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
        ]);
    }

    public function create()
    {
        return view('vats.form', [
            'vat' => new Vat(),
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
        return view('vats.form', compact('vat'));
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
