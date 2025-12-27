<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductsController extends Controller
{
    public function index(): View
    {
        return view('product.index', [
            'products' => Product::paginate(Controller::DEFAULT_PAGE_SIZE),
        ]);
    }

    public function create(): View
    {
        $brands = Brand::all()->where('active', 1);

        return view('product.create', [
            'brands' => $brands,
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        Product::create($request->validated());

        return redirect()
            ->route('products.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function edit(Product $product): View
    {
        $brands = Brand::all()->where('status', 1);

        return view('product.edit', [
            'product' => $product,
            'brands' => $brands,
        ]);
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function activeDeactive(Product $product): RedirectResponse
    {
        $product->active = !$product->active;
        $product->save();
        return redirect()
            ->route('products.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }
}
