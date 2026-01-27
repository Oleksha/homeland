<?php

namespace App\Models;

use App\Enums\ReceiptType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'number',
        'type',
        'contractor_id',
        'document_number',
        'document_date',
        'note',
        'status',
        'total_amount',
        'total_vat',
    ];

    protected $casts = [
        'date' => 'date',
        'document_date' => 'date',
        'type' => ReceiptType::class,
        'total_amount' => 'decimal:2',
        'total_vat' => 'decimal:2',
        'status' => 'boolean',
    ];

    protected array $dates = ['date', 'document_date', 'deleted_at'];

    public function items(): HasMany
    {
        return $this->hasMany(ReceiptItem::class);
    }

    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Contractor::class);
    }
}
