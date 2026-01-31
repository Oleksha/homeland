<?php

namespace App\Domains\Receipt\Actions;

use App\Domains\Receipt\Models\Receipt;
use App\Support\Action;

final class FindReceipt extends Action
{
    public function __invoke(int $id): Receipt
    {
        return Receipt::withTrashed()->findOrFail($id);
    }
}
