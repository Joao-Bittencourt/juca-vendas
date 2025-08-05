@props([
'data' => [],
'renderActions' => true,
// 'whitoutFields' => [],
])

<div class="card-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Cod') }}</th>
                                <th>{{ __('Sale')}}</th>
                                <th>{{ __('Product')}}</th>
                                <th>{{ __('Price')}}</th>
                                <th>{{ __('Quantity')}}</th>
                                <th>{{ __('Total')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($data as $unit)
                            <tr>
                                <td>
                                    {{ $unit->id }}
                                </td>
                                <td>
                                    {{ $unit->sale_id }}
                                </td>
                                <td>
                                    {{ $unit->product->name }}
                                </td>
                                <td>
                                    {{ $unit->price }}
                                </td>
                                <td>
                                    {{ $unit->quantity }}
                                </td>
                                <td>
                                    {{ $unit->total }}
                                </td>
                                @if($renderActions)
                                <td class="text-center">
                                    action
                                </td>
                                @endif
                            </tr>
                            @empty
                            <x-tr-no-records />
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-paginate-count :data=$data />
</div>