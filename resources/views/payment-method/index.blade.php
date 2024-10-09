<x-app-layout>

    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                {{ __('Payment methods') }}
                 
                <a href="{{ route('payment-methods.create') }}" class="btn btn-primary btn-sm float-right">
                    {{ __('Create payment method')}}
                </a>
            </div>
            <x-lists.payment-method-list :data=$paymentMethods />

        </div>
    </div>
    </div>
</x-app-layout>