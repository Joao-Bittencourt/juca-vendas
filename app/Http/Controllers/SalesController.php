<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Models\PaymentMethod;
use App\Models\Sale;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        return view('sale.index', [
            'sales' => Sale::with('customer', 'salesman')->paginate()
        ]);
    }

    public function view(Sale $sale)
    {
        $sale = Sale::with('customer', 'salesman', 'saleItems', 'saleItems.product')->where('id', (string) $sale->id)->first();
        return view('sale.view', [
            'sale' => $sale
        ]);
    }

    public function create()
    {
        $paymentMethods = PaymentMethod::all()
            ->where('show_on_store', 1)
            ->pluck('id', 'name')
            ->toArray();

        return view('sale.create', [
            'paymentMethods' => $paymentMethods,
            'types' => ['credit', 'debit'],
        ]);
    }

    public function store(SaleRequest $request)
    {

        $request->validated();

        $sale = new Sale();
        $sale->customer_id = $request->customer_id ?? 0;
        $sale->salesman_id = $request->salesman_id ?? Auth::user()->id;
        $sale->total = $request->total;
        $sale->date = $request->date ?? now();
        $sale->situation = $request->situation ?? 1;
        $sale->save();

        foreach ($request->saleItem as $item) {
            // $item['sale_id'] = $sale->id;
            $sale->saleItems()->create($item);
        }

        $transactionIdentifier = str()->uuid();
        $transactionType = $request->type;
        $transactionPaymentMethodId = $request->payment_method_id;

        $installments = $request->installments;
        foreach ($installments as $key => $installment) {

            $installmentAmount = str_replace('R$ ', '', $installment['amount']);
            $installmentAmount = str_replace(',', '.', $installmentAmount);

            $installment['identifier'] = $transactionIdentifier;
            $installment['sale_id'] = $sale->id;
            $installment['amount'] = $installmentAmount;
            $installment['installment_number'] = $key;
            $installment['type'] = $transactionType;
            $installment['payment_method_id'] = $transactionPaymentMethodId;

            Transaction::create($installment);
        }

        return redirect()
            ->route('sales.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function saleValidate(SaleRequest $request)
    {
        $request->validated();

        return response()->json(['valid' => true], 200);
    }
}
