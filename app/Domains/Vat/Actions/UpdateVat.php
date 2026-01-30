<?php

namespace App\Domains\Vat\Actions;

use App\Domains\Vat\DTO\VatData;
use App\Domains\Vat\Models\Vat;
use App\Support\Action;
use Illuminate\Support\Facades\DB;
use Throwable;

class UpdateVat extends Action
{
    /**
     * @throws Throwable
     */
    public function __invoke(Vat $vat, VatData $dto): Vat
    {
        return DB::transaction(function () use ($vat, $dto) {

            if ($dto->isDefault) {
                ResetDefaultVat::run($vat->id);
            }

            $vat->update($dto->toArray());

            return $vat;
        });
    }
}
