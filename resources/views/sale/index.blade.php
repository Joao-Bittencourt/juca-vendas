<x-app-layout>

    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                {{ __('Sales') }}

                <a href="{{ route('sales.create') }}" class="btn btn-primary btn-sm float-right">
                    {{ __('Create sale')}}
                </a>
            </div>
            <x-lists.sales-list :data=$sales />

        </div>
    </div>
    </div>
</x-app-layout>