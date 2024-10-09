<x-app-layout>

    <div class="card-body">
        <!-- Basic information -->
        <div class="card mb-4">
            <form method="post" action="{{ route('brands.update', ['brand' => $brand]) }}" class="mt-6 space-y-6">
                <div class="card-header">
                    {{ __('Brands') }}

                    <a href="{{ route('brands.index') }}" class="btn btn-primary btn-sm float-right">
                        {{ __('List brands')}}
                    </a>
                </div>
                <div class="card-body">

                    @csrf
                    <div class="row">
                        <div class="col-lg-1">
                            <div class="mb-3">
                                <x-input-label for="id" :value="__('Cod')" />
                                <x-text-input id="id" name="id" type="text" class="form-control-plaintext text-center" :value="$brand->id" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-input-label for="name" :value="__('Brand')" />
                                <x-text-input id="name" name="name" type="text" class="form-control" :value="$brand->name" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>
                </div>
        </div>
    </div>

</x-app-layout>