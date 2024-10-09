<x-app-layout>

    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                {{ __('Products') }}

                @can(\App\Enums\PermissionEnum::PRODUCTS_CREATE)
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right">
                    {{ __('Create product')}}
                </a>
                @endcan
            </div>
            <x-lists.products-list :data=$products />

        </div>
    </div>
    </div>
</x-app-layout>