<x-app-layout>

    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                {{ __('Brands') }}

                <a href="{{ route('brands.create') }}" class="btn btn-primary btn-sm float-right">
                    {{ __('Create brand')}}
                </a>
            </div>
            <x-lists.brands-list :data=$brands />

        </div>
    </div>
    </div>
</x-app-layout>