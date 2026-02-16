<?php

namespace App\Http\Controllers;

use App\Domains\Contractor\Models\Contractor;
use App\Domains\Payment\DTO\PaymentRequestIndexFilterDTO;
use App\Domains\Payment\Models\PaymentRequest;
use App\Domains\Vat\Models\Vat;
use App\Http\Requests\PaymentRequestIndexRequest;
use App\Domains\Payment\Actions\IndexPaymentRequestsAction;
use Illuminate\Http\Request;

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

    public function create()
    {
        return view('payment-requests.create', [
            'contractors' => Contractor::orderBy('name')->get(),
            'vats' => Vat::orderBy('rate')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],
            'number' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'vat_id' => ['nullable', 'exists:vats,id'],
            'contractor_id' => ['required', 'exists:contractors,id'],
            'date_pay' => ['nullable', 'date'],
            'status' => ['required', 'in:unpaid,partial,paid'],
        ]);

        PaymentRequest::create($validated);

        return redirect()
            ->route('payment-requests.index')
            ->with('success', 'Заявка создана');
    }
}
