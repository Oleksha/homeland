<?php

namespace App\Domains\PaymentAuthorization\Actions;

use App\Domains\PaymentAuthorization\DTO\PaymentAuthorizationData;
use App\Domains\PaymentAuthorization\Models\PaymentAuthorization;

final class UpdatePaymentAuthorization
{
    public static function run(
        PaymentAuthorization     $authorization,
        PaymentAuthorizationData $data
    ): PaymentAuthorization
    {
        $authorization->update([
            'contractor_id' => $data->contractorId,
            'expense_item_id' => $data->expenseItemId,
            'number' => $data->number,
            'date_start' => $data->dateStart,
            'date_end' => $data->dateEnd,
            'delay' => $data->delay,
            'amount' => $data->amount,
        ]);

        return $authorization;
    }
}
