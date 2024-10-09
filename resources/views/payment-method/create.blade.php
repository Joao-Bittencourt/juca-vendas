<x-app-layout>

    <div class="card-body">
        <!-- Basic information -->
        <div class="card mb-4">
            <x-card-header title="Payment methods" controller="payment-methods" />
            <div class="card-body">
                <form method="post" action="{{ route('payment-methods.store') }}" class="mt-6 space-y-6">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <x-input-label for="number_max_installments" :value="__('Number max installments')" />
                            <select id="number_max_installments" name="number_max_installments" class="form-control">
                                <option value=""> {{ __('Select') }} </option>
                                @for ($i = 1; $i <= App\Models\PaymentMethod::MAX_INSTALLMENTS ; $i++) 
                                    <option value="{{ $i}}"> {{ $i }} </option>
                                @endfor
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('number_max_installments')" />
                        </div>
                        <div class="col-lg-2">
                            <x-input-label for="show_on_store" :value="__('Show on store')" />
                            <select id="show_on_store" name="show_on_store" class="form-control">
                                <option value=""> Selecione </option>
                                <option value="0"> {{ __('No') }} </option>
                                <option value="1"> {{ __('Yes') }} </option>
                            
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('show_on_store')" />
                        </div>
                        <div class="col-lg-2">
                            <x-input-label for="show_on_finance" :value="__('Show on finance')" />
                            <select id="show_on_finance" name="show_on_finance" class="form-control">
                                <option value=""> Selecione </option>
                                <option value="0"> {{ __('No') }} </option>
                                <option value="1"> {{ __('Yes') }} </option>
                            
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('show_on_finance')" />
                        </div>
                    </div>
                    

            </div>
            <div class="card-footer">
                <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>
            </div>
        </div>
    </div>


</x-app-layout>