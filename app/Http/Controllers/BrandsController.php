<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;

class BrandsController extends Controller
{
    public function index()
    {
        return view('brand.index', [
            'brands' => Brand::paginate(Controller::DEFAULT_PAGE_SIZE),
        ]);
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(BrandRequest $request)
    {
        Brand::create($request->validated());

        return redirect()
            ->route('brands.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function edit(Brand $brand)
    {
        return view('brand.edit', [
            'brand' => $brand
        ]);
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());

        return redirect()
            ->route('brands.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function activeDeactive(Brand $brand)
    {
        $brand->active = !$brand->active;
        $brand->save();
        return redirect()
            ->route('brands.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }
}
