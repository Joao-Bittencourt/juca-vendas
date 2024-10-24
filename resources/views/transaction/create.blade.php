<x-app-layout>

    <div class="card-body">
        <div id="erros"></div>
        <!-- Basic information -->
        <div class="card mb-4">
            <x-card-header title="Transactions" />
            <div class="card-body">
                <form method="post" action="{{ route('transactions.store') }}" class="mt-6 space-y-6" id="form-transaction">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3">
                            <x-input-label for="customer_type" :value="__('Payment method')" />
                            <div class="card mb-4">

                                <select id="payment_method_id" name="payment_method_id" class="form-control">
                                    <option value=""> {{ __('Select') }} </option>
                                    @foreach($paymentMethods as $paymentMethodName => $paymentMethodId)
                                    <option value="{{ $paymentMethodId }}"> {{ __($paymentMethodName) }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('payment_method_id')" />
                        </div>

                        <div class="col-lg-2">
                            <x-input-label for="type" :value="__('Type')" />
                            <div class="card mb-4">
                                <select id="type" name="type" class="form-control">
                                    <option value=""> {{ __('Select') }} </option>
                                    @foreach($types as $typeKey => $type)
                                    <option value="{{ $type }}"> {{ __($type) }} </option>
                                    @endforeach
                                </select>


                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('type')" />
                        </div>

                        <div class="col-lg-2">
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input id="date" name="date" type="date" class="form-control" :value="old('date')" required autofocus autocomplete="date" />
                            <x-input-error class="mt-2" :messages="$errors->get('date')" />
                        </div>
                        <div class="col-lg-2">
                            <x-input-label for="due_date" :value="__('Due date')" />
                            <x-text-input id="due_date" name="due_date" type="date" class="form-control" :value="old('due_date')" autofocus autocomplete="due_date" />
                            <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
                        </div>
                        <div class="col-lg-2">
                            <x-input-label for="paid_date" :value="__('Paid date')" />
                            <x-text-input id="paid_date" name="paid_date" type="date" class="form-control" :value="old('paid_date')" autofocus autocomplete="paid_date" />
                            <x-input-error class="mt-2" :messages="$errors->get('paid_date')" />
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <x-input-label for="amount" :value="__('Paided')" />
                            <x-text-input id="amount" name="amount" type="number" step="0.01" class="form-control maskMoney" :value="old('amount')" required autofocus autocomplete="amount" />
                            <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                        </div>
                        <div class="col-lg-2">
                            <x-input-label for="customer_type" :value="__('Installment quantity')" />
                            <x-text-input id="installment_quantity" name="installment_quantity" type="number" class="form-control" :value="old('installment_quantity')" required autofocus autocomplete="installment_quantity" />
                            <x-input-error class="mt-2" :messages="$errors->get('installment_quantity')" />
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div id="installments"> </div>
                    </div>

                    <div class="card-footer">
                        <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>
                    </div>
            </div>
        </div>
    </div>
    <script>
        const formatCurrency = (num, decimals) => num.toLocaleString('pt-BR', {
            // style: 'currency',
            // currency: 'BRL',
            useGrouping: false,
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });

        // set today date in date input on load page
        document.getElementById('date').valueAsDate = new Date();
        document.getElementById('due_date').valueAsDate = new Date();
        document.getElementById('paid_date').valueAsDate = new Date();

        document.getElementById('installment_quantity').addEventListener('change', function() {
            const amount = document.getElementById('amount').value;

            if (amount >= 0) {
                document.getElementById('installments').innerHTML = '';

                const installments = document.getElementById('installment_quantity').value;

                const InstallmentValue = installments > 0 ? amount / installments : amount;
                for (let i = 1; i <= installments; i++) {

                    addIntallments(i, formatCurrency(InstallmentValue, 2));
                }
            }
        });

        function addIntallments(i, InstallmentValue) {

            let installmentDate = document.getElementById('date').value;
            let installmentDueDate = document.getElementById('due_date').value;
            let installmentPaidDate = document.getElementById('paid_date').value;


            const div = document.createElement('div');
            div.classList.add('form-group');
            div.innerHTML = `
            <div class="row">
                <div class="col-lg-3">
                    <label class="form-label">{{ __('Installment') }} ${i}</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="text" name="installments[${i}][amount]" class="form-control" value="${InstallmentValue}">
                    </div>
                </div>
                <input type="hidden" name="installments[${i}][installment]" class="form-control" value="${i}">
                
                <div class="col-lg-3">
                    <label class="form-label">{{ __('Date') }}</label>
                    <input type="date" name="installments[${i}][date]" class="form-control" value="${installmentDate}">
                </div>

                <div class="col-lg-3">
                    <label class="form-label">{{ __('Due date') }}</label>
                    <input type="date" name="installments[${i}][due_date]" class="form-control" value="${installmentDueDate}">
                </div>

                <div class="col-lg-3">
                    <label class="form-label">{{ __('Paid date') }}</label>
                    <input type="date" name="installments[${i}][paid_date]" class="form-control" value="${installmentPaidDate}">    
                </div>
            </div>
            `;
            document.getElementById('installments').appendChild(div);
        }

        const formE1 = document.getElementById('form-transaction');
        formE1.addEventListener('submit', evento => {
            evento.preventDefault();

            fetch("{{ route('transactions.validate') }}", {
                method: 'post',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(Object.fromEntries(new FormData(formE1))),
            }).then(async response => {

                const json = await response.json();

                if (!response.ok) {
                    var errors = json.errors;

                    var divErros = document.getElementById('erros');
                    divErros.innerHTML = '';
                    Object.keys(errors).forEach(key => {

                        errors[key].forEach(error => {
                            divErros.innerHTML += '<div class="alert alert-danger alert-dismissible fade show">' +
                                error +
                                '</div>';
                        })

                    });
                    return;
                }

                formE1.submit();

            })
        });
    </script>

</x-app-layout>