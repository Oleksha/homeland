<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequestIndexRequest;
use App\Domains\Payment\Actions\IndexPaymentRequestsAction;

class PaymentRequestController extends Controller
{
    public function index(
        PaymentRequestIndexRequest $request,
        IndexPaymentRequestsAction $action
    ) {
        return view('payment-requests.index', [
            'paymentRequests' => $action->execute($request->toDto()),
            'filters' => $request->validated(),
            'breadcrumbs' => [
                ['title' => 'Заявки на оплату'],
            ],
        ]);
    }
}
