<?php

namespace App\Http\Requests;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    public function rules(): array
    {
        $maxInstallments = 1;
        if (!empty($this->payment_method_id)) {
            $maxInstallments = PaymentMethod::find($this->payment_method_id)->number_max_installments;
        }

        return [
            'customer_id' => ['required', 'numeric'],
            'salesman_id' => ['sometimes', 'numeric'],
            'total' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'saleItem.*.product_id' => ['required'],
            'saleItem.*.price' => ['required'],
            'saleItem.*.quantity' => ['required'],

            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'type' => ['required', 'in:credit,debit'],
            'installment_quantity' => ['required', 'numeric', 'min:1', 'max:' . $maxInstallments],
            'installments.*.amount' => ['sometimes', 'regex:/[0-9][,|.][0-9]{2}/'],
            'installments.*.date' => ['sometimes', 'date'],
            'installments.*.due_date' => ['sometimes', 'date'],
            'installments.*.paid_date' => ['sometimes', 'date'],
        ];
    }
}
