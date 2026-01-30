<?php

namespace App\Domains\Contractor\Models;

use App\Domains\ContractorType\Models\ContractorType;
use App\Domains\Receipt\Models\Receipt;
use App\Domains\Vat\Models\Vat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contractor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'type_id',
        'is_supplier',
        'inn',
        'kpp',
        'address',
        'phone',
        'email',
        'delay',
        'vat_id',
    ];

    protected $casts = [
        'is_supplier' => 'boolean',
    ];

    /**
     * Типы Контрагентов
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ContractorType::class, 'type_id');
    }

    /**
     * Ставки НДС
     */
    public function vat(): BelongsTo
    {
        return $this->belongsTo(Vat::class);
    }

    /**
     * Поступления
     */
    public function receipts(): HasMany|Contractor
    {
        return $this->hasMany(Receipt::class);
    }
}
