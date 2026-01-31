<?php

namespace App\Domains\Vat\Actions;

use App\Domains\Vat\Models\Vat;
use Illuminate\Support\Collection;
use App\Support\Action;

class GetActiveVats extends Action
{
    public function __invoke(): Collection
    {
        return Vat::active()
            ->orderBy('rate')
            ->get();
    }
}
