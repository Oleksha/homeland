<?php

namespace App\Domains\Payment\Models;

use App\Domains\Contractor\Models\Contractor;
use App\Domains\Payment\Enums\PaymentRequestStatus;
use App\Domains\Receipt\Models\Receipt;
use App\Domains\Vat\Models\Vat;
use App\Domains\Budget\Models\Budget;
use App\Domains\PaymentAuthorization\Models\PaymentAuthorization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PaymentRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'number',
        'amount',
        'vat_id',
        'contractor_id',
        'date_pay',
        'status',
    ];

    protected $casts = [
        'date'     => 'date',
        'date_pay' => 'date',
        'amount'   => 'decimal:2',
        'status'   => PaymentRequestStatus::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Связи
    |--------------------------------------------------------------------------
    */

    public function vat(): BelongsTo
    {
        return $this->belongsTo(Vat::class);
    }

    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Contractor::class);
    }

    public function receipts(): BelongsToMany
    {
        return $this->belongsToMany(
            Receipt::class,
            'payment_request_receipt'
        )
            ->withPivot(['amount', 'vat_id'])
            ->withTimestamps();
    }

    public function authorizations(): BelongsToMany
    {
        return $this->belongsToMany(
            PaymentAuthorization::class,
            'payment_request_authorization'
        )
            ->withPivot(['amount'])
            ->withTimestamps();
    }

    public function budgets(): BelongsToMany
    {
        return $this->belongsToMany(
            Budget::class,
            'payment_request_budget'
        )
            ->withPivot(['amount', 'vat_id'])
            ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Помощники
    |--------------------------------------------------------------------------
    */

    public function paidAmount(): float
    {
        return (float) $this->receipts()->sum('payment_request_receipt.amount');
    }

    public function remainingAmount(): float
    {
        return (float) $this->amount - $this->paidAmount();
    }
}
