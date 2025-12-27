<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

class Product extends BaseModel
{
    protected $fillable = [
        'brand_id',
        'name',
        'description',
        'cod_product',
        'price',
        'active',
        'created_at',
        'updated_at',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function findListProducts(string|int $q): Collection
    {
        return $this->where('name', 'like', "%{$q}%")
            ->orWhere('cod_product', 'like', "%{$q}%")
            ->where('active', 1)
            ->get();
    }

    public function getActions(): array
    {
        $actions = [
            [
                'title' => __('Edit'),
                'class' => 'btn-warning',
                'route' => route('products.edit', ['product' => $this->id]),
                'icon' => 'fas fa-pencil-alt',
            ],
            [
                'title' => $this->active === '1' ? __('Deactivate') : __('Activate'),
                'class' => 'btn-' . ($this->active === '1' ? 'danger' : 'success'),
                'route' => route('products.active_deactive', ['product' => $this->id]),
                'icon' => 'fas fa-' . ($this->active === '1' ? 'times' : 'check'),
            ],
        ];

        return $actions;
    }
}
