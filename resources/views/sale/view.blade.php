<x-app-layout>

    <div class="card-body">
        <div class="card mb-4">
            <div class="card-header">
                {{ __('Sales') }}

                <a href="{{ route('sales.index') }}" class="btn btn-primary btn-sm float-right">
                    {{ __('List sales') }}
                </a>
            </div>

            <x-lists.sales-list :data=[$sale] :renderActions=false />
            <div class="card-body">
                <h3 class="h6 mb-4"> {{ __('Sale Items') }} </h3>
                @php $saleItems = $sale->saleItems; @endphp
                <x-lists.sale-items-list :data=$saleItems :renderActions=false />
            </div>
        </div>

    </div>

</x-app-layout>