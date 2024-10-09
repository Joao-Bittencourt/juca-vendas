<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'salesCount' => Sale::count(),
            'customersCount' => Customer::count(),
        ]);
    }
}
