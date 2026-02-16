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

            ->whereBetween('date', [
                $filter->month->startOfMonth(),
                $filter->month->endOfMonth(),
            ])

            ->when($filter->status,
                fn ($q) => $q->where('status', $filter->status)
            )

            ->with(['contractor', 'vat'])
            ->orderByDesc('date')
            ->paginate(20)
            ->withQueryString();
    }
}
