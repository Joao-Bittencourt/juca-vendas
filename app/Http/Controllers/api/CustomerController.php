<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getListCustomers(Request $request)
    {
        $q = $request->query('q') ?? '';
        $customers = (new Customer())->findListCustomers($q);
        return response()->json($customers);
    }
}
