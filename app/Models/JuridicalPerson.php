<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JuridicalPerson extends BaseModel
{
    protected $fillable = [
        'id',
        'customer_id',
        'corporate_name',
        'cnpj',
        'created_at',
        'updated_at',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
