<?php

namespace App\Domains\Receipt\Models;

use App\Domains\Vat\Models\Vat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceiptItem extends Model
{
    protected $fillable = [
        'receipt_id',
        'name',
        'quantity',
        'price',
        'amount',
        'vat_id',
        'vat_amount',
        'total_amount',
    ];

    public function receipt(): BelongsTo
    {
        return $this->belongsTo(Receipt::class);
    }

    public function vat(): BelongsTo
    {
        return $this->belongsTo(Vat::class);
    }
}
