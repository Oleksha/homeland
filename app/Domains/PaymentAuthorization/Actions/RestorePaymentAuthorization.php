<?php

namespace App\Domains\PaymentAuthorization\Actions;

use App\Domains\PaymentAuthorization\Models\PaymentAuthorization;
use App\Support\Action;

class RestorePaymentAuthorization extends Action
{
    public function __invoke(int $id): void
    {
        PaymentAuthorization::withTrashed()
            ->findOrFail($id)
            ->restore();
    }
}
