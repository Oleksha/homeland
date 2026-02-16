<?php

namespace App\Domains\Payment\Actions;

use App\Domains\Payment\DTO\PaymentRequestIndexFilterDTO;
use App\Domains\Payment\Models\PaymentRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class IndexPaymentRequestsAction
{
    public function execute(PaymentRequestIndexFilterDTO $filter): LengthAwarePaginator
    {
        return PaymentRequest::query()

            ->when($filter->archived, fn ($q) => $q->onlyTrashed())

            ->when($filter->period, function ($q) use ($filter) {
                $q->whereBetween('date', [
                    $filter->period->startOfMonth(),
                    $filter->period->endOfMonth(),
                ]);
            })

            ->when(
                $filter->status,
                fn ($q) => $q->where('status', $filter->status->value)
            )

            ->with(['contractor', 'vat'])
            ->orderByDesc('date')
            ->paginate(15)
            ->withQueryString();
    }
}
