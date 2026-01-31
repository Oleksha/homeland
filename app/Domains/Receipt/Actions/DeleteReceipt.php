<?php

namespace App\Domains\Receipt\Actions;

use App\Domains\Receipt\Models\Receipt;
use App\Support\Action;

final class DeleteReceipt extends Action
{
    public function __invoke(Receipt $receipt): void
    {
        $receipt->delete();
    }
}
