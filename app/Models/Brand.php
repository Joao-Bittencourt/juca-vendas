<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends BaseModel
{
    protected $fillable = [
        'id',
        'name',
        'active',
        'created_at',
        'updated_at',
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    public function getActions(): array
    {

        $actions = [
            [
                'title' => __('Edit'),
                'class' => 'btn-warning',
                'route' => route('brands.edit', ['brand' => $this->id]),
                'icon' => 'fas fa-pencil-alt',
            ],
            [
                'title' => $this->active == '1' ? __('Deactivate') : __('Activate'),
                'class' => 'btn-' . ($this->active == '1' ? 'danger' : 'success'),
                'route' => route('brands.active_deactive', ['brand' => $this->id]),
                'icon' => 'fas fa-' . ($this->active == '1' ? 'times' : 'check'),
            ],
        ];

        return $actions;
    }
}
