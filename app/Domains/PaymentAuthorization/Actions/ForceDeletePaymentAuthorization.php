<?php

namespace App\Domains\PaymentAuthorization\Actions;

use App\Domains\PaymentAuthorization\Models\PaymentAuthorization;
use App\Support\Action;

class ForceDeletePaymentAuthorization extends Action
{
    public function handle(int $id): void
    {
        PaymentAuthorization::withTrashed()
            ->findOrFail($id)
            ->forceDelete();
    }
}
