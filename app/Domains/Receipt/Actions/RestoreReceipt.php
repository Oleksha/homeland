<?php

namespace App\Domains\Receipt\Actions;

use App\Domains\Receipt\Models\Receipt;
use App\Support\Action;

final class RestoreReceipt extends Action
{
    public function __invoke(int $id): void
    {
        FindReceipt::run($id)->restore();
    }
}

