<?php

namespace App\Domains\PaymentAuthorization\Models;

use App\Domains\Contractor\Models\Contractor;
use App\Domains\ExpenseItem\Models\ExpenseItem;
use App\Domains\Payment\Models\PaymentRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class PaymentAuthorization extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'contractor_id',
        'expense_item_id',
        'number',
        'date_start',
        'date_end',
        'delay',
        'amount',
    ];

    protected $casts = [
        'date_start' => 'date',
        'date_end'   => 'date',
    ];

    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Contractor::class)->withTrashed();
    }

    public function expenseItem(): BelongsTo
    {
        return $this->belongsTo(ExpenseItem::class)->withTrashed();
    }

    public function paymentRequests(): BelongsToMany
    {
        return $this->belongsToMany(
            PaymentRequest::class,
            'payment_request_authorization'
        )->withPivot(['amount'])
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->where('date_end', '>=', now())->where('date_start', '<', now());
        });
    }

    public function isActiveForDate(Carbon $date): bool
    {
        return $date->gte($this->date_start)
            && $date->lte($this->date_end);
    }
}
