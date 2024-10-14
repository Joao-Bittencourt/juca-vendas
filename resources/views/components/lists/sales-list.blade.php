@props([
'data' => [],
'renderActions' => true,
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
                                <th>{{ __('Customer')}}</th>
                                <th>{{ __('Salesman')}}</th>
                                <th>{{ __('Date')}}</th>
                                <th>{{ __('Total')}}</th>
                                <th>{{ __('Situation')}}</th>
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
                                    {{ $unit->customer->name }}
                                </td>
                                <td>
                                    {{ $unit->salesman->name }}
                                </td>
                                <td>
                                    {{ $unit->date->format('d/m/Y') }}
                                </td>
                                <td>
                                    {{ $unit->total }}
                                </td>
                                <td class="text-center">
                                    {{ $unit->situation }}
                                </td>
                                @if($renderActions)
                                <td class="text-center">
                                    <x-action-button :data="$unit" />
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