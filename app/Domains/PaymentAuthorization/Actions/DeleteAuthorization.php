<?php

namespace App\Domains\PaymentAuthorization\Actions;

use App\Domains\PaymentAuthorization\Models\PaymentAuthorization;

final class DeleteAuthorization
{
    public static function run(PaymentAuthorization $authorization): void
    {
        $authorization->delete();
    }
}
