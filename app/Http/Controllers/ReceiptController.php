<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Vat;
use App\Services\Receipt\ReceiptService;
use App\Http\Requests\ReceiptRequest;
use App\Models\Receipt;
use Throwable;

class ReceiptController extends Controller
{
    /**
     * Список поступлений
     */
    public function index()
    {
        $receipts = Receipt::query()
            ->with('contractor')
            ->orderByDesc('date')
            ->paginate(20);

        return view('receipts.index', compact('receipts'));
    }

    /**
     * Форма создания
     */
    public function create()
    {
        return view('receipts.form', [
            'receipt' => new Receipt(),
            'contractors' => Contractor::orderBy('name')->get(),
            'vats'        => Vat::orderBy('rate')->get(),
        ]);
    }
    
    /**
     * Сохранение
     * @throws Throwable
     */
    public function store(
        ReceiptRequest $request,
        ReceiptService $service)
    {
        $service->create($request->validatedDTO());

        return redirect()
            ->route('receipts.index')
            ->with('success', 'Поступление создано');
    }

    /**
     * Просмотр карточки (сделаем следующим шагом)
     */
    public function show(Receipt $receipt)
    {
        $receipt->load([
            'contractor',
            'items.vat',
        ]);

        return view('receipts.show', compact('receipt'));
    }

    /**
     * Форма редактирования
     */
    public function edit(Receipt $receipt)
    {
        return view('receipts.form', [
            'receipt' => $receipt,
            'contractors' => Contractor::all(),
            'vats' => Vat::all(),
        ]);
    }
    
    /**
     * Обновление
     * @throws Throwable
     */
    public function update(
        ReceiptRequest $request,
        Receipt $receipt,
        ReceiptService $service)
    {
        $service->update($receipt, $request->validatedDTO());

        return redirect()
            ->route('receipts.show', $receipt)
            ->with('success', 'Поступление обновлено');
    }

    /**
     * Удаление (soft delete)
     */
    public function destroy(Receipt $receipt)
    {
        $receipt->delete();

        return redirect()
            ->route('receipts.index')
            ->with('success', 'Поступление удалено');
    }
}
