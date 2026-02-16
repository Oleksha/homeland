<?php

namespace App\Http\Controllers;

use App\Domains\Payment\DTO\PaymentRequestIndexFilterDTO;
use App\Http\Requests\PaymentRequestIndexRequest;
use App\Domains\Payment\Actions\IndexPaymentRequestsAction;

class PaymentRequestController extends Controller
{
    public function index(PaymentRequestIndexRequest $request, IndexPaymentRequestsAction $action)
    {
        $filter = PaymentRequestIndexFilterDTO::fromRequest($request);

        return view('payment-requests.index', [
            'paymentRequests' => $action->execute($filter),
            'filter' => $filter,
        ]);
    }

}
