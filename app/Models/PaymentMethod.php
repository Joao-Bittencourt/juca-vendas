<?php

namespace App\Models;

class PaymentMethod extends BaseModel
{
    public const MAX_INSTALLMENTS = 99;

    protected $fillable = [
        'id',
        'name',
        'number_max_installments',
        'show_on_store',
        'show_on_finance',
        'active',
        'created_at',
        'updated_at',
    ];

    public function getActions(): array
    {
        $actions = [
            [
                'title' => __('Edit'),
                'class' => 'btn-warning',
                'route' => route('payment-methods.edit', ['paymentMethod' => $this->id]),
                'icon' => 'fas fa-pencil-alt',
            ],
            [
                'title' => $this->active == '1' ? __('Deactivate') : __('Activate'),
                'class' => 'btn-' . ($this->active == '1' ? 'danger' : 'success'),
                'route' => route('payment-methods.active_deactive', ['paymentMethod' => $this->id]),
                'icon' => 'fas fa-' . ($this->active == '1' ? 'times' : 'check'),
            ],
        ];

        return $actions;
    }
}
