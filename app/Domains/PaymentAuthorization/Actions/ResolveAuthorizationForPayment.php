<?php

namespace App\Domains\PaymentAuthorization\Actions;

use App\Domains\PaymentAuthorization\Models\PaymentAuthorization;
use Carbon\Carbon;

final class ResolveAuthorizationForPayment
{
    public function execute(
        int $partnerId,
        int $expenseItemId,
        Carbon $paymentDate,
        float $amount
    ): ?PaymentAuthorization {
        return PaymentAuthorization::query()
            ->where('partner_id', $partnerId)
            ->where('expense_item_id', $expenseItemId)
            ->whereDate('date_start', '<=', $paymentDate)
            ->where(function ($q) use ($paymentDate) {
                $q->whereNull('date_end')
                    ->orWhereDate('date_end', '>=', $paymentDate);
            })
            ->where('amount', '>=', $amount)
            ->orderBy('date_start', 'desc')
            ->first();
    }
}
