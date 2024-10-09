<x-app-layout>

    <div class="card-body">

        <div class="card mb-4">
            <x-card-header title="Customers" />
            <div class="card-body">
                <form method="post" action="{{ route('customers.update', ['customer' => $customer]) }}" class="mt-6 space-y-6">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="form-control" :value="$customer->name" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="text" class="form-control" :value="$customer->email" required autofocus autocomplete="email" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <x-input-label for="customer_type" :value="__('Customer type')" />
                            <div class="card mb-4">

                                <select id="customer_type" name="customer_type" class="form-control">
                                    <option value=""> {{ __('Select') }} </option>
                                    @foreach($customerTypes as $customerKey => $customerTypeName)
                                    <option value="{{ $customerKey }}" {{ $customerKey == $customer->customer_type ? 'selected' : ''}}> {{ __($customerTypeName) }} </option>
                                    @endforeach
                                </select>

                                <x-input-error class="mt-2" :messages="$errors->get('customer_type')" />
                            </div>

                        </div>
                        <div class="col-md-8" id="natural_person">
                            <div class="row">
                                <div class="col-md-6">
                                    <x-input-label for="cpf" :value="__('CPF')" />
                                    <x-text-input id="cpf" name="cpf" type="text" class="form-control" :value="$customer->natural_person?->cpf" />
                                    <x-input-error class="mt-2" :messages="$errors->get('cpf')" />
                                </div>
                                <div class="col-md-6">
                                    <x-input-label for="birth_date" :value="__('Birth date')" />
                                    <x-text-input id="birth_date" name="birth_date" type="text" class="form-control" :value="$customer->natural_person?->birth_date" />
                                    <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="juridical_person">
                            <div class="col-md-6">
                                <x-input-label for="cnpj" :value="__('CNPJ')" />
                                <x-text-input id="cnpj" name="cnpj" type="text" class="form-control" :value="$customer->juridical_person?->cnpj" />
                                <x-input-error class="mt-2" :messages="$errors->get('cnpj')" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('natural_person').style.display = "none";
        document.getElementById('juridical_person').style.display = "none";
        customerType();
        document.getElementById('customer_type').onchange = function() {
            customerType();
        };

        function customerType() {
            var customerType = document.getElementById('customer_type').value;

            if (customerType == "N") {
                document.getElementById('natural_person').style.display = '';
                document.getElementById('juridical_person').style.display = "none";
            }

            if (customerType == "J") {
                document.getElementById('juridical_person').style.display = '';
                document.getElementById('natural_person').style.display = "none";
            }
        }
    </script>

</x-app-layout>