<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class TransactionsController extends Controller
{
    public function index(): View
    {
        return view('transaction.index', [
            'transactions' => Transaction::with('paymentMethod')->paginate(Controller::DEFAULT_PAGE_SIZE)
        ]);
    }

    public function create(): View
    {
        $paymentMethods = PaymentMethod::all()
            ->where('show_on_finance', 1)
            ->pluck('id', 'name', 'number_max_installments')
            ->toArray();

        return view('transaction.create', [
            'paymentMethods' => $paymentMethods,
            'types' => ['credit', 'debit'],
        ]);
    }

    public function store(TransactionRequest $request): RedirectResponse
    {
        $requestValidated = $request->validated();
        $transactionIdentifier = str()->uuid();

        $installments = $requestValidated['installments'];
        foreach ($installments as $key => $installment) {
            $installmentAmount = str_replace('R$ ', '', $installment['amount']);
            $installmentAmount = str_replace(',', '.', $installmentAmount);

            $installment['identifier'] = $transactionIdentifier;
            $installment['amount'] = $installmentAmount;
            $installment['installment_number'] = $key;
            $installment['type'] = $requestValidated['type'];
            $installment['payment_method_id'] = $requestValidated['payment_method_id'];

            Transaction::create($installment);
        }


        return redirect()
            ->route('transactions.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function edit(Transaction $transaction): View
    {
        return view('transaction.edit', [
            'transaction' => $transaction
        ]);
    }

    public function update(TransactionRequest $request, Transaction $transaction): RedirectResponse
    {
        $transaction->update($request->validated());

        return redirect()
            ->route('transactions.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function activeDeactive(Transaction $transaction): RedirectResponse
    {
        $transaction->active = !$transaction->active;
        $transaction->save();
        return redirect()
            ->route('transactions.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function transactionValidate(TransactionRequest $request): JsonResponse
    {
        $request->validated();

        return response()->json(['valid' => true], 200);
    }
}
