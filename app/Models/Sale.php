<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends BaseModel
{
    protected $fillable = [
        'customer_id',
        'salesman_id',
        'total',
        'date',
        'situation',
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function salesman(): BelongsTo
    {
        return $this->belongsTo(User::class, 'salesman_id');
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function getActions(): array
    {
        $actions = [
            [
                'title' => __('View'),
                'class' => 'btn-primary',
                'route' => route('sales.view', ['sale' => $this->id]),
                'icon' => 'fas fa-eye',
            ],
        ];

        return $actions;
    }
}
