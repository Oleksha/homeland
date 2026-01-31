<?php

namespace App\Domains\Receipt\Actions;

use App\Domains\Receipt\DTO\ReceiptDTO;
use App\Domains\Receipt\Models\Receipt;

final class CreateReceipt extends BaseSaveReceipt
{
    public function __invoke(ReceiptDTO $dto): Receipt
    {
        return $this->save(new Receipt(), $dto);
    }
}
