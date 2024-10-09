<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'number_max_installments' => ['required', 'integer', 'min:1', 'max:99'],
            'show_on_store' => ['required', 'integer', 'in:0,1'],
            'show_on_finance' => ['required', 'integer', 'in:0,1'],
            // 'active' => ['required', 'integer', 'in:0,1'],
        ];
    }
}
