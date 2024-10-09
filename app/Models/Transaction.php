<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends BaseModel
{
    protected $fillable = [
        'total',
        'date',
        'payment_method_id',
        'sale_id',
        'amount',
        'installment_number',
        'type',
        'identifier',
        'due_date',
        'paid_date',
    ];

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
