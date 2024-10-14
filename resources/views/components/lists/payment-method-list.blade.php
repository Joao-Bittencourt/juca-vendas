@props(['data' => []])

<div class="card-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Cod') }}</th>
                                <th>{{ __('Name')}}</th>
                                <th class="text-center">{{ __('Max installments') }}</th>
                                <th class="text-center">{{ __('Show on store') }}</th>
                                <th class="text-center">{{ __('Show on finance') }}</th>
                                <th class="text-center">{{ __('Status') }}</th>
                                <th class="text-center">{{ __('Created at') }}</th>
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
                                    {{ $unit->name }}

                                </td>
                                <td class="text-center">
                                    {{ $unit->number_max_installments }}

                                </td>
                                <td class="text-center">
                                    {{ $unit->show_on_store == '1' ? __('Yes') : __('No') }}

                                </td>
                                <td class="text-center">
                                    {{ $unit->show_on_finance == '1' ? __('Yes') : __('No') }}

                                </td>
                                <td class="text-center">
                                    {{ $unit->active == '1' ? __('Active') : __('Inactive') }}
                                </td>
                                <td class="text-center">
                                    {{ $unit->created_at->format('d/m/Y') }}
                                </td>
                                <td class="text-center">
                                    <x-action-button :data="$unit" />
                                </td>
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