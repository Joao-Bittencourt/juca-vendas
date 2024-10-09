<x-app-layout>

    <div class="card-body">
        <!-- Basic information -->
        <div class="card mb-4">
            <div class="card-header">
                {{ __('Brands') }}

                <a href="{{ route('brands.index') }}" class="btn btn-primary btn-sm float-right">
                    {{ __('List brands')}}
                </a>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('brands.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-input-label for="name" :value="__('Brand')" />
                                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>
                    </div>
            </div>
        </div>
    </div>

</x-app-layout>