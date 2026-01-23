<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function type(): BelongsTo
    {
        return $this->belongsTo(ContractorType::class, 'type_id');
    }

    public function vat(): BelongsTo
    {
        return $this->belongsTo(Vat::class);
    }
}
