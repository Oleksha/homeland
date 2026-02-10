<?php

namespace App\Domains\Nomenclature\Models;

use App\Domains\Category\Models\Category;
use App\Domains\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomenclature extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'unit_id',
        'image',
        'description',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
