<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'is_report_selection',
    ];

    protected $casts = [
        'is_report_selection' => 'boolean',
    ];

    public function scopeForReports($query)
    {
        return $query->where('is_report_selections', true);
    }
}
