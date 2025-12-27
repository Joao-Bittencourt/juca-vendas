<?php

declare(strict_types=1);

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function getListProducts(Request $request): JsonResponse
    {
        $q = $request->query('q') ?? '';
        $products = (new Product())->findListProducts($q);
        return response()->json($products);
    }
}
