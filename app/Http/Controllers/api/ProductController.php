<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getListProducts(Request $request)
    {
        $q = $request->query('q') ?? '';
        $products = (new Product())->findListProducts($q);
        return response()->json($products);
    }
}
