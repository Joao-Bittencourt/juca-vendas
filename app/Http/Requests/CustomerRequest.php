<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'customer_type' => ['required', 'in:' . implode(',', array_flip((new Customer())->getCustomerTypes()))],
            'cpf' => ['nullable', 'string'],
            'birth_date' => ['nullable', 'string'],
            'cnpj' => ['nullable', 'string'],
        ];
    }
}
