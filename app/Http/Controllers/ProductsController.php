<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        return view('product.index', [
            'products' => Product::all(),
        ]);
    }

    public function create()
    {
        $brands = Brand::all()->where('active', 1);

        return view('product.create', [
            'brands' => $brands,
        ]);
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()
            ->route('products.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function edit(Product $product)
    {
        $brands = Brand::all()->where('status', 1);

        return view('product.edit', [
            'product' => $product,
            'brands' => $brands,
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function activeDeactive(Product $product)
    {
        $product->active = !$product->active;
        $product->save();
        return redirect()
            ->route('products.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }
}
