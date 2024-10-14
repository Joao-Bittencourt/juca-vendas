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
                                <!-- <th>{{ __('Identifier') }}</th> -->

                                <th class="text-center">{{ __('Payment method') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Installment number') }}</th>
                                <th class="text-center">{{ __('Amount') }}</th>
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
                                <!-- <td>
                                {{ $unit->identifier }}
                            </td> -->
                                <td class="text-center">
                                    {{ $unit->paymentMethod->name ?? '-' }}
                                </td>
                                <td>
                                    {{ __($unit->type) }}
                                </td>
                                <td>
                                    {{ $unit->installment_number ?? '-' }}
                                </td>
                                <td class="text-center">
                                    {{ $unit->amount ?? '-' }}
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