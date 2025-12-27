<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Customer extends BaseModel
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'customer_type',
        'active',
        'created_at',
        'updated_at',
    ];

    protected array$customerType = [
        'N' => 'Natural person',
        'J' => 'Juridical person',
    ];

    public function getCustomerType(string $customerType): ?string
    {
        return $this->customerType[$customerType] ?? null;
    }

    public function getCustomerTypes(): array
    {
        return $this->customerType;
    }

    public function natural_person(): HasOne
    {
        return $this->HasOne(NaturalPerson::class);
    }

    public function juridical_person(): HasOne
    {
        return $this->HasOne(JuridicalPerson::class);
    }

    public function findListCustomers(string|int $q): Collection
    {
        return $this->where('name', 'like', '%' . $q . '%')->get();
    }

    public function getActions(): array
    {
        $actions = [
            [
                'title' => __('Edit'),
                'class' => 'btn-warning',
                'route' => route('customers.edit', ['customer' => $this->id]),
                'icon' => 'fas fa-pencil-alt',
            ],
            [
                'title' => $this->active === '1' ? __('Deactivate') : __('Activate') ,
                'class' => 'btn-' . ($this->active === '1' ? 'danger' : 'success'),
                'route' => route('customers.active_deactive', ['customer' => $this->id]),
                'icon' => 'fas fa-' . ($this->active === '1' ? 'times' : 'check'),
            ],
        ];

        return $actions;
    }
}
