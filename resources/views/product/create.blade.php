<x-app-layout>

    <div class="card-body">
        <!-- Basic information -->
        <div class="card mb-4">
            <x-card-header title="Products" />
            <div class="card-body">
                <form method="post" action="{{ route('products.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-input-label for="name" :value="__('Product')" />
                                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <x-input-label for="cod_product" :value="__('Cod product')" />
                                <x-text-input id="cod_product" name="cod_product" type="text" class="form-control" :value="old('cod_product')" required autofocus autocomplete="cod_product" />
                                <x-input-error class="mt-2" :messages="$errors->get('cod_product')" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <x-input-label for="brands" :value="__('Brand')" />
                            <select id="brands" name="brand_id" class="form-control">
                                <option value=""> {{ __('Select') }} </option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('brand_id')" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea name="description" rows="3" class="form-control" :value="old('description')" required autofocus>{{old('description')}}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="form-control maskMoney" :value="old('price')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>
                    </div>

            </div>
            <div class="card-footer">
                <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>
            </div>
        </div>
    </div>


</x-app-layout>