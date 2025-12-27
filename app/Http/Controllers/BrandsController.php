<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BrandsController extends Controller
{
    public function index(): View
    {
        return view('brand.index', [
            'brands' => Brand::paginate(Controller::DEFAULT_PAGE_SIZE),
        ]);
    }

    public function create(): View
    {
        return view('brand.create');
    }

    public function store(BrandRequest $request): RedirectResponse
    {
        Brand::create($request->validated());

        return redirect()
            ->route('brands.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function edit(Brand $brand): View
    {
        return view('brand.edit', [
            'brand' => $brand
        ]);
    }

    public function update(BrandRequest $request, Brand $brand): RedirectResponse
    {
        $brand->update($request->validated());

        return redirect()
            ->route('brands.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }

    public function activeDeactive(Brand $brand): RedirectResponse
    {
        $brand->active = !$brand->active;
        $brand->save();
        return redirect()
            ->route('brands.index')
            ->with(['alert-success' => __('Data saved successfully!')]);
    }
}
