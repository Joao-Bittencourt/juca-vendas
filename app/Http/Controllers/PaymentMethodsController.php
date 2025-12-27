<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentMethodsController extends Controller
{
    public function index(): View
    {
        return view('payment-method.index', [
            'paymentMethods' => PaymentMethod::paginate(Controller::DEFAULT_PAGE_SIZE),
        ]);
    }

    public function create(): View
    {
        return view('payment-method.create');
    }

    public function store(PaymentMethodRequest $request): RedirectResponse
    {
        PaymentMethod::create($request->validated());

        return redirect()
            ->route('payment-methods.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function edit(PaymentMethod $paymentMethod): View
    {
        return view('payment-method.edit', [
            'paymentMethod' => $paymentMethod,
        ]);
    }

    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod): RedirectResponse
    {
        $paymentMethod->update($request->validated());

        return redirect()
            ->route('payment-methods.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function activeDeactive(PaymentMethod $paymentMethod): RedirectResponse
    {
        $paymentMethod->active = !$paymentMethod->active;
        $paymentMethod->save();

        return redirect()
            ->route('payment-methods.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }
}
