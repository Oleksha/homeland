<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiptItem extends Model
{
    use SoftDeletes;

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
