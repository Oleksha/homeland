<?php

namespace App\Domains\Vat\Models;

use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    protected $fillable = [
        'name',
        'rate',
        'code',
        'is_active',
        'is_default',
    ];

    protected $casts = [
        'rate' => 'decimal:2',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    /* ---------- Scopes ---------- */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
}

