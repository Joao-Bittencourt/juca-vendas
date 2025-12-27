<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends BaseModel
{
    protected $fillable = [
        'sale_id',
        'product_id',
        'product_price',
        'price',
        'quantity',
        'total',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
