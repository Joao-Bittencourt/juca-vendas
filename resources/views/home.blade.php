<x-app-layout>

    <div class="container-fluid">
        <h1>{{ __('Welcome') . ' ' . Auth::user()->name }}</h1>
        <div class="row mt-1">
            <div class="col-sm-6">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart text-primary"></i>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ ($salesCount ?? 0) . ' ' . __('Sales') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div class="col">
                                <div class="font-weight-medium">
                                    {{ ($customersCount ?? 0 ) . ' ' . __('Customers') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>