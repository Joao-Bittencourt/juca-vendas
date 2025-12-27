<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NaturalPerson extends BaseModel
{
    protected $fillable = [
        'id',
        'customer_id',
        'cpf',
        'birth_date',
        'created_at',
        'updated_at',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
