<?php

namespace App\Domains\Budget\Models;

use App\Domains\Budget\Enums\BudgetStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'budget_period',
        'expense_month',
        'payment_month',
        'budget_number',
        'amount',
        'vat_amount',
        'total_amount',
        'vat_id',
        'expense_item_id',
        'status',
        'description',
    ];

    protected $casts = [
        'budget_period' => 'date',
        'expense_month' => 'date',
        'payment_month' => 'date',
        'status' => BudgetStatus::class,
    ];
}
