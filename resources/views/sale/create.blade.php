<x-app-layout>

    <div class="card-body">

        <div id="erros"></div>

        <div class="card mb-4">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6 class="h6 mb-4"> {{ __('Product') }} </h6>
                        <input type="text" class="form-control" id="search-produto" placeholder="Pesquise por nome..." onkeyup="pesquisarProdutoPorNome(this)">
                        <div id="carregar-produtos"></div>

                    </div>
                    <div class="col-md-6 mb-3">
                        <h6 class="h6 mb-4"> {{ __('Customer') }} </h6>
                        <input type="text" class="form-control" id="search-cliente" placeholder="Pesquise por nome..." onkeyup="pesquisarClientePorNome(this)">
                        <div id="carregar-clientes"></div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form method="post" action="{{ route('sales.store') }}" class="mt-6 space-y-6" id="form-sale">
                    @csrf

                    <div class="row">

                        <div class="card col-md-8">
                            <div class="card-body">
                                <h3 class="h6 mb-4"> {{ __('Products') }} </h3>

                                <table class="table tabela-ajustada tabela-de-produto" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Produto</th>
                                            <th>Preço</th>
                                            <th>QTD</th>
                                            <th>Total</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody id="venda-produtos">

                                    </tbody>
                                    <tfoot></tfoot>
                                </table>

                            </div>
                        </div>

                        <div class="card col-md-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <x-input-label for="date" :value="__('Date')" />
                                    <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required autofocus />
                                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="form-label">Total</label>
                                    <div id="valor-total"></div>
                                </div>
                                <hr>
                                <div>
                                    <x-input-label for="customer_name" :value="__('Customer')" />
                                    <x-text-input id="customer_name" class="block mt-1 w-full" type="text" readonly name="customer_name" :value="old('customer_name')" required autofocus />
                                    <x-text-input id="customer_id" class="block mt-1 w-full" type="hidden" name="customer_id" :value="old('customer_id')" />
                                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card col-md-12">
                            <div class="card-body">
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
                                    <input type="hidden" name="type" value="credit">

                                    <div class="col-lg-3">
                                        <x-input-label for="date" :value="__('Date')" />
                                        <x-text-input id="transaction_date" name="date" type="date" class="form-control" :value="old('date')" required autofocus autocomplete="date" />
                                        <x-input-error class="mt-2" :messages="$errors->get('date')" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input-label for="due_date" :value="__('Due date')" />
                                        <x-text-input id="due_date" name="due_date" type="date" class="form-control" :value="old('due_date')" required autofocus autocomplete="due_date" />
                                        <x-input-error class="mt-2" :messages="$errors->get('due_date')" />
                                    </div>
                                    <div class="col-lg-3">
                                        <x-input-label for="paid_date" :value="__('Paid date')" />
                                        <x-text-input id="paid_date" name="paid_date" type="date" class="form-control" :value="old('paid_date')" required autofocus autocomplete="paid_date" />
                                        <x-input-error class="mt-2" :messages="$errors->get('paid_date')" />
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <x-input-label for="amount" :value="__('Paided')" />
                                        <x-text-input id="amount" name="amount" type="number" step="0.01" class="form-control maskMoney" :value="old('amount')" required autofocus autocomplete="amount" />
                                        <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                                    </div>
                                    <div class="col-lg-4">
                                        <x-input-label for="installment_quantity" :value="__('Installment quantity')" />
                                        <x-text-input id="installment_quantity" name="installment_quantity" type="number" class="form-control" :value="old('installment_quantity')" required autofocus autocomplete="installment_quantity" />
                                        <x-input-error class="mt-2" :messages="$errors->get('installment_quantity')" />
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div id="installments"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>
                    </div>

            </div>
        </div>
    </div>

    <script>
        const format = (num, decimals) => num.toLocaleString('en-US', {
            useGrouping: false,
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });
        const formatCurrency = (num, decimals) => num.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL',
            useGrouping: false,
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });
        const formatCurrencyOnly = (num, decimals) => num.toLocaleString('pt-BR', {

            useGrouping: false,
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });
        document.getElementById('date').valueAsDate = new Date();

        function pesquisarClientePorNome(context) {

            if (context.value.length <= 0) {
                let div = document.getElementById('carregar-clientes');
                div.innerHTML = '';
                return;
            }

            if (context.value.length < 3) {
                return;
            }

            fetch("{{ route('api.customers.list') }}?q=" + context.value)
                .then(response => response.json()) // converter para json
                .then(json => {

                    let div = document.getElementById('carregar-clientes');
                    div.innerHTML = '';

                    if (json.length < 1) {
                        div.innerHTML = 'Nenhum resultado encontrado!';
                        return;
                    }

                    let divList = document.createElement('div');
                    divList.classList.add('list-group');

                    json.forEach(element => {

                        let li = document.createElement('li');
                        li.classList.add('list-group-item');
                        li.classList.add('list-group-item-action');

                        li.innerHTML =
                            '<div onclick="adicionarCliente(' +
                            element.id +
                            ',\'' + element.name +
                            '\')" >' +
                            element.name +
                            '</div>';

                        divList.appendChild(li);
                    });

                    div.appendChild(divList);
                });

        }

        function adicionarCliente(id, name) {

            document.getElementById('customer_name').value = name;
            document.getElementById('customer_id').value = id;

            document.getElementById('carregar-clientes').innerText = '';
            document.getElementById('search-cliente').value = '';
        }

        function pesquisarProdutoPorNome(context) {

            if (context.value.length <= 0) {
                let div = document.getElementById('carregar-produtos');
                div.innerHTML = '';
                return;
            }

            if (context.value.length < 3) {
                return;
            }

            fetch("{{ route('api.products.list') }}?q=" + context.value)
                .then(response => response.json()) // converter para json
                .then(json => {

                    let div = document.getElementById('carregar-produtos');
                    div.innerHTML = '';

                    if (json.length < 1) {
                        div.innerHTML = 'Nenhum resultado encontrado!';
                        return;
                    }

                    let divList = document.createElement('div');
                    divList.classList.add('list-group');

                    json.forEach(element => {

                        let li = document.createElement('li');
                        li.classList.add('list-group-item');
                        li.classList.add('list-group-item-action');

                        li.innerHTML =
                            '<div onclick="adicionarItem(' +
                            element.id +
                            ',\'' + element.name +
                            '\',\'' + format(element.price) +
                            '\')" >' +
                            element.cod_product +
                            ' | ' + element.name +
                            ' | ' + formatCurrency(element.price) +
                            '</div>';

                        divList.appendChild(li);
                    });

                    div.appendChild(divList);
                });

        }

        function adicionarItem(id, name, price) {

            let tbody = document.getElementById('venda-produtos');
            let tr = document.createElement('tr');

            var randomId = 'xxxxx'.replace(/[xy]/g, function(c) {
                var r = Math.random() * 5 | 1,
                    v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(10);
            });


            tr.setAttribute('id', randomId);
            tr.innerHTML =
                '<td>' + id + '</td>' +
                '<td>' + name + '</td>' +
                '<td>' + formatCurrency(price) + '</td>' +
                '<td>' + '<input type="number" name="saleItem[' + randomId + '][quantity]" value="1" onchange="totalItem(' + randomId + ')"></td>' +
                '<td id="total-item-' + randomId + '">' + formatCurrency(price) + '</td>' +
                '<td>' + '<button type="button" class="btn btn-danger btn-sm btn-remove" onclick="removerItem(' + randomId + ')">X</button></td>' +
                '<input type="hidden" name="saleItem[' + randomId + '][product_id]" value="' + id + '">' +
                '<input type="hidden" name="saleItem[' + randomId + '][product_price]" value="' + format(price) + '">' +
                '<input type="hidden" name="saleItem[' + randomId + '][price]" value="' + format(price) + '">';
            tbody.appendChild(tr);

            totalItem(randomId);

            document.getElementById('carregar-produtos').innerText = '';
            document.getElementById('search-produto').value = '';
        }

        function total() {

            var table = document.getElementById('venda-produtos');
            let totalItems = 0.00;
            for (let i = 0; i < table.rows.length; i++) {
                totalItems += Number(table.rows[i].cells[4].textContent.replace('R$', '').replace(',', '.').trim());
            }

            document.getElementById('valor-total').innerHTML = formatCurrency(totalItems) +
                '<input type="hidden" id="total" name="total" value="' + format(totalItems) + '">';

            document.getElementById('amount').value = document.getElementById('total').value;
        }

        function totalItem(id) {


            var item = document.getElementById(id.toString());
            let totalItem = 0.00;

            totalItem = Number(item.cells[2].textContent.replace('R$', '').replace(',', '.').trim()) * Number(item.cells[3].children[0].value);
            document.getElementById('total-item-' + id.toString()).innerHTML = formatCurrency(totalItem) +
                '<input type="hidden" name="saleItem[' + id.toString() + '][total]" value="' + format(totalItem) + '">';

            total();
        }

        function removerItem(id) {

            document.getElementById(id.toString(10)).remove();
            total();
        }

        // set today date in date input on load page
        document.getElementById('transaction_date').valueAsDate = new Date();
        document.getElementById('due_date').valueAsDate = new Date();
        document.getElementById('paid_date').valueAsDate = new Date();


        document.getElementById('installment_quantity').addEventListener('change', function() {
            const amount = document.getElementById('amount').value;

            if (amount >= 0) {
                document.getElementById('installments').innerHTML = '';

                const installments = document.getElementById('installment_quantity').value;

                const InstallmentValue = installments > 0 ? amount / installments : amount;
                for (let i = 1; i <= installments; i++) {

                    addIntallments(i, formatCurrencyOnly(InstallmentValue, 2));
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

        const formE1 = document.getElementById('form-sale');
        formE1.addEventListener('submit', evento => {
            evento.preventDefault();

            fetch("{{ route('sales.validate') }}", {
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