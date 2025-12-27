<?php

declare(strict_types=1);

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    public function getListCustomers(Request $request): JsonResponse
    {
        $q = $request->query('q') ?? '';
        $customers = (new Customer())->findListCustomers($q);
        return response()->json($customers);
    }
}
