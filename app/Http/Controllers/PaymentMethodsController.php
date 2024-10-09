<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;

class PaymentMethodsController extends Controller
{
    public function index()
    {
        return view('payment-method.index', [
            'paymentMethods' => PaymentMethod::all(),
        ]);
    }

    public function create()
    {
        return view('payment-method.create');
    }

    public function store(PaymentMethodRequest $request)
    {
        PaymentMethod::create($request->validated());

        return redirect()
            ->route('payment-methods.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('payment-method.edit', [
            'paymentMethod' => $paymentMethod,
        ]);
    }

    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->update($request->validated());

        return redirect()
            ->route('payment-methods.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function activeDeactive(PaymentMethod $paymentMethod)
    {
        $paymentMethod->active = ! $paymentMethod->active;
        $paymentMethod->save();

        return redirect()
            ->route('payment-methods.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }
}
