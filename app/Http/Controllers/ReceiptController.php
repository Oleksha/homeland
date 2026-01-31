<?php

namespace App\Http\Controllers;

use App\Domains\Contractor\Models\Contractor;
use App\Domains\Receipt\Actions\CreateReceipt;
use App\Domains\Receipt\Actions\DeleteReceipt;
use App\Domains\Receipt\Actions\ForceDeleteReceipt;
use App\Domains\Receipt\Actions\RestoreReceipt;
use App\Domains\Receipt\Actions\UpdateReceipt;
use App\Domains\Receipt\DTO\ReceiptDTO;
use App\Domains\Receipt\Models\Receipt;
use App\Domains\Vat\Models\Vat;
use App\Http\Requests\ReceiptRequest;
use Illuminate\Http\Request;
use Throwable;

class ReceiptController extends Controller
{
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
    public function create(Request $request)
    {
        $contractorId = $request->get('contractor_id');

        return view('receipts.form', [
            'receipt' => new Receipt([
                'contractor_id' => $contractorId,
            ]),
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
        // Получаем ставки НДС ОДИН раз
        $vatRates = Vat::query()
            ->pluck('rate', 'id') // [id => rate]
            ->toArray();

        // Создаем DTO
        $dto = ReceiptDTO::fromRequest(
            $request->validated(),
            $vatRates
        );

        // Передаем в Action
        $receipt = CreateReceipt::run($dto);

        return redirect()
            ->route('receipts.show', $receipt)
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
                ['title' => "Поступление №$receipt->number"],
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
        $vatRates = Vat::query()
            ->pluck('rate', 'id')
            ->toArray();

        $dto = ReceiptDTO::fromRequest(
            $request->validated(),
            $vatRates
        );

        UpdateReceipt::run($receipt, $dto);

        return redirect()
            ->route('receipts.show', $receipt)
            ->with('success', 'Поступление обновлено');
    }

    /**
     * Удаление (soft delete)
     */
    public function destroy(Receipt $receipt)
    {
        DeleteReceipt::run($receipt);

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
        RestoreReceipt::run($id);

        return redirect()
            ->route('receipts.index')
            ->with('success', 'Поступление восстановлено');
    }

    /**
     * Окончательное удаление
     */
    public function forceDelete(int $id)
    {
        ForceDeleteReceipt::run($id);

        return redirect()
            ->route('receipts.archive')
            ->with('success', 'Поступление удалено окончательно');
    }
}
