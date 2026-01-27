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
    public function __construct(
        private readonly ReceiptService $service,
    )
    {}

    /**
     * Список поступлений
     */
    public function index()
    {
        $receipts = Receipt::query()
            ->with('contractor')
            ->orderByDesc('date')
            ->paginate(20);

        return view('receipts.index', [
            'receipts' => $receipts,
            'breadcrumbs' => [
                ['title' => 'Поступления'],
            ],
        ]);
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
            'breadcrumbs' => [
                ['title' => 'Поступления', 'url' => route('receipts.index')],
                ['title' => 'Добавление'],
            ],
        ]);
    }

    /**
     * Сохранение
     * @throws Throwable
     */
    public function store(
        ReceiptRequest $request)
    {
        $this->service->create($request->validatedDTO());

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

        return view('receipts.show', [
            'receipt' => $receipt,
            'breadcrumbs' => [
                ['title' => 'Поступления', 'url' => route('receipts.index')],
                ['title' => "Поступление №{$receipt->number}"],
            ],
        ]);
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
            'breadcrumbs' => [
                ['title' => 'Поступления', 'url' => route('receipts.index')],
                ['title' => 'Изменение поступления ' . $receipt->number],
            ],
        ]);
    }

    /**
     * Обновление
     * @throws Throwable
     */
    public function update(
        ReceiptRequest $request,
        Receipt $receipt)
    {
        $this->service->update($receipt, $request->validatedDTO());

        return redirect()
            ->route('receipts.show', $receipt)
            ->with('success', 'Поступление обновлено');
    }

    /**
     * Удаление (soft delete)
     */
    public function destroy(Receipt $receipt)
    {
        $this->service->delete($receipt); // soft delete через сервис
        return redirect()
            ->route('receipts.index')
            ->with('success', 'Поступление перемещено в архив.');
    }

    /**
     * Просмотр архива
     */
    public function archive()
    {
        $receipts = Receipt::onlyTrashed()->with('contractor')->get();

        return view('receipts.archive', [
            'receipts' => $receipts,
            'breadcrumbs' => [
                ['title' => 'Поступления', 'url' => route('receipts.index')],
                ['title' => 'Просмотр архивных поступлений'],
            ],
        ]);
    }

    /**
     * Восстановление из архива
     */
    public function restore(int $id)
    {
        $receipt = Receipt::withTrashed()->findOrFail($id);
        $this->service->restore($receipt);

        return redirect()
            ->route('receipts.index')
            ->with('success', 'Поступление восстановлено');
    }

    /**
     * Окончательное удаление
     */
    public function forceDelete(int $id)
    {
        Receipt::withTrashed()->findOrFail($id)->forceDelete();

        return redirect()
            ->route('receipts.archive')
            ->with('success', 'Поступление удалено окончательно');
    }
}
