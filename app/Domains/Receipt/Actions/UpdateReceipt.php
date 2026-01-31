<?php

namespace App\Domains\Receipt\Actions;

use App\Domains\Receipt\DTO\ReceiptDTO;
use App\Domains\Receipt\Models\Receipt;

final class UpdateReceipt extends BaseSaveReceipt
{
    public function __invoke(Receipt $receipt, ReceiptDTO $dto): Receipt
    {
        return $this->save($receipt, $dto);
    }
}
