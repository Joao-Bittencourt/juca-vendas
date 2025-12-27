<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\JuridicalPerson;
use App\Models\NaturalPerson;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CustomersController extends Controller
{
    public function index(): View
    {
        return view('customer.index', [
            'customers' => Customer::paginate(Controller::DEFAULT_PAGE_SIZE),
        ]);
    }

    public function create(): View
    {
        return view('customer.create', [
            'customerTypes' => (new Customer())->getCustomerTypes(),
        ]);
    }

    public function store(CustomerRequest $request): RedirectResponse
    {
        $customer = new Customer($request->validated());

        if ($customer->customer_type === 'N') {
            $customerType = new NaturalPerson();
            $customerType->cpf = $request->cpf;
            $customerType->birth_date = $request->birth_date;
            $modelRelated = 'natural_person';
        }

        if ($customer->customer_type === 'J') {
            $customerType = new JuridicalPerson();
            $customerType->cnpj = $request->cnpj;
            $modelRelated = 'juridical_person';
        }

        $customer->save();
        $customer->{$modelRelated}()->save($customerType);

        return redirect()
            ->route('customers.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function edit(Customer $customer): View
    {
        return view('customer.edit', [
            'customer' => $customer,
            'customerTypes' => (new Customer())->getCustomerTypes(),
        ]);
    }

    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        if ($request->customer_type === 'N') {
            $customerType['cpf'] = $request->cpf ?? null;
            $customerType['birth_date'] = $request->birth_date ?? null;
            $modelRelated = 'natural_person';
        }

        if ($request->customer_type === 'J') {
            $customerType['cnpj'] = $request->cnpj ?? null;
            $modelRelated = 'juridical_person';
        }

        $customer->update($request->validated());
        $customer->$modelRelated()->update($customerType);

        return redirect()
            ->route('customers.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function activeDeactive(Customer $customer): RedirectResponse
    {
        $customer->active = !$customer->active;
        $customer->save();

        return redirect()
            ->route('customers.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }
}
