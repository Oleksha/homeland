<?php

namespace App\Domains\ContractorType\Models;

use App\Domains\Contractor\Models\Contractor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContractorType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function contractors(): HasMany
    {
        return $this->hasMany(Contractor::class, 'type_id');
    }
}
