<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function rules(): array
    {
        $maxInstallments = 1;
        if (is_numeric($this?->payment_method_id)) {
            $maxInstallments = PaymentMethod::find($this->payment_method_id)?->number_max_installments;
        }

        return [
            'payment_method_id' => ['required', 'numeric', 'exists:payment_methods,id'],
            'type' => ['required', 'in:credit,debit'],
            'amount' => ['required', 'numeric', 'regex:/[0-9][,|.][0-9]{2}/'],
            'date' => ['required', 'date'],
            'due_date' => ['nullable', 'date'],
            'paid_date' => ['nullable', 'date'],
            'installment_quantity' => ['required', 'numeric', 'min:1', 'max:' . $maxInstallments],
            'installments.*.amount' => ['required', 'regex:/[0-9][,|.][0-9]{2}/'],
            'installments.*.date' => ['required', 'date'],
            'installments.*.due_date' => ['nullable', 'date'],
            'installments.*.paid_date' => ['nullable', 'date'],
        ];
    }
}
