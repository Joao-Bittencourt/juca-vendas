<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\JuridicalPerson;
use App\Models\NaturalPerson;

class CustomersController extends Controller
{
    public function index()
    {
        return view('customer.index', [
            'customers' => Customer::all(),
        ]);
    }

    public function create()
    {
        return view('customer.create', [
            'customerTypes' => (new Customer())->getCustomerTypes(),
        ]);
    }

    public function store(CustomerRequest $request)
    {
        $customer = new Customer($request->validated());

        if ($customer->customer_type == 'N') {
            $customerType = new NaturalPerson();
            $customerType->cpf = $request->cpf;
            $customerType->birth_date = $request->birth_date;
            $modelRelated = 'natural_person';
        }

        if ($customer->customer_type == 'J') {
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

    public function edit(Customer $customer)
    {
        return view('customer.edit', [
            'customer' => $customer,
            'customerTypes' => (new Customer())->getCustomerTypes(),
        ]);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        if ($request->customer_type == 'N') {
            $customerType['cpf'] = $request->cpf ?? null;
            $customerType['birth_date'] = $request->birth_date ?? null;
            $modelRelated = 'natural_person';
        }

        if ($request->customer_type == 'J') {
            $customerType['cnpj'] = $request->cnpj ?? null;
            $modelRelated = 'juridical_person';
        }

        $customer->update($request->validated());
        $customer->$modelRelated()->update($customerType);

        return redirect()
            ->route('customers.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function activeDeactive(Customer $customer)
    {
        $customer->active = ! $customer->active;
        $customer->save();

        return redirect()
            ->route('customers.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }
}
