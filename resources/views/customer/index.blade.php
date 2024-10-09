<x-app-layout>

    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                {{ __('Customer') }}

                <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm float-right">
                    {{ __('Create customer')}}
                </a>
            </div>
            <x-lists.customers-list :data=$customers />

        </div>
    </div>
    </div>
</x-app-layout>