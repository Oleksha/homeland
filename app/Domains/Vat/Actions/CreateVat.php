<?php

namespace App\Domains\Vat\Actions;

use App\Domains\Vat\Models\Vat;
use App\Support\Action;
use Illuminate\Support\Facades\DB;
use App\Domains\Vat\DTO\VatData;
use Throwable;

class CreateVat extends Action
{
    /**
     * @throws Throwable
     */
    public function __invoke(VatData $dto): Vat
    {
        return DB::transaction(function () use ($dto) {

            if ($dto->isDefault) {
                ResetDefaultVat::run();
            }

            return Vat::create($dto->toArray());
        });
    }
}
