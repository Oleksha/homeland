<?php

namespace App\Http\Controllers;

use App\Domains\Contractor\Models\Contractor;
use App\Domains\ExpenseItem\Models\ExpenseItem;
use App\Http\Requests\PaymentAuthorizationRequest;
use App\Domains\PaymentAuthorization\Models\PaymentAuthorization;
use App\Domains\PaymentAuthorization\DTO\PaymentAuthorizationData;
use App\Domains\PaymentAuthorization\Actions\{CreatePaymentAuthorization,
    ForceDeletePaymentAuthorization,
    RestorePaymentAuthorization,
    UpdatePaymentAuthorization,
    DeletePaymentAuthorization};

class PaymentAuthorizationController extends Controller
{
    public function index()
    {
        return view('payment-authorizations.index', [
            'authorizations' => PaymentAuthorization::latest()->paginate(20),
            'breadcrumbs' => [
                ['title' => 'Разрешения на оплату'],
            ],
        ]);
    }

    public function create()
    {
        return view('payment-authorizations.form', [
            'contractors' => Contractor::orderBy('name')->get(),
            'expenseItems' => ExpenseItem::orderBy('name')->get(),
            'breadcrumbs' => [
                ['title' => 'Разрешения на оплату', 'url' => route('payment-authorizations.index')],
                ['title' => 'Создать разрешение'],
            ],
        ]);
    }

    public function store(PaymentAuthorizationRequest $request)
    {
        CreatePaymentAuthorization::run(
            PaymentAuthorizationData::fromArray($request->validated())
        );

        return redirect()
            ->route('payment-authorizations.index')
            ->with('success', 'Разрешение создано');
    }

    public function edit(PaymentAuthorization $paymentAuthorization)
    {
        return view('payment-authorizations.form', [
            'authorization' => $paymentAuthorization,
            'contractors' => Contractor::orderBy('name')->get(),
            'expenseItems' => ExpenseItem::orderBy('name')->get(),
            'breadcrumbs' => [
                ['title' => 'Разрешения на оплату', 'url' => route('payment-authorizations.index')],
                ['title' => 'Изменить разрешение'],
            ],
        ]);
    }

    public function update(
        PaymentAuthorizationRequest $request,
        PaymentAuthorization        $paymentAuthorization
    ) {
        UpdatePaymentAuthorization::run(
            $paymentAuthorization,
            PaymentAuthorizationData::fromArray($request->validated())
        );

        return redirect()
            ->route('payment-authorizations.index')
            ->with('success', 'Разрешение обновлено');
    }

    public function destroy(PaymentAuthorization $paymentAuthorization)
    {
        DeletePaymentAuthorization::run($paymentAuthorization);

        return back()->with('success', 'Разрешение удалено');
    }

    public function archive()
    {
        $items = PaymentAuthorization::onlyTrashed()
            ->with(['partner', 'expenseItem'])
            ->paginate();

        return view('payment-authorizations.archive', [
            'items' => $items,
            'breadcrumbs' => [
                ['title' => 'Архив разрешений'],
            ],
        ]);
    }

    public function restore(int $id)
    {
        RestorePaymentAuthorization::run($id);

        return back()->with('success', 'Разрешение восстановлено');
    }

    public function forceDelete(int $id)
    {
        ForceDeletePaymentAuthorization::run($id);

        return back()->with('success', 'Разрешение удалено окончательно');
    }
}
