<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'brand_id' => ['required', 'numeric'],
            // @ToDo: revisar como fazer esta validação quando estiver fazendo update
            'name' => ['required', 'string', 'max:255'/*, 'unique:products'*/],
            'cod_product' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'price' => ['required', 'decimal:2'],
            // 'active' => ['required', 'numeric', 'in:0,1'],
        ];
    }
}
