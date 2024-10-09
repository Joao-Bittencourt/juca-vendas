@props([
'title' => 'Actions',
'data' => []
])


@php $actions = $data->getActions() ?? []; @endphp

@if (!empty($actions))

@if (config('app.action_buttons') == 'icon')
@foreach ($actions as $action)
    <a href="{{ $action['route'] ?? '#' }}" class="btn {{$action['class'] ?? ''}} btn-sm" title="{{ $action['title'] ?? '-' }}">
        @if (!empty($action['icon']))
        <i class="{{ $action['icon'] }}"></i>
        @endif
    </a>

@endforeach
@endif

@if (config('app.action_buttons') == 'action')
    <div class="btn-group">
        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ __($title) }}
        </button>
        <ul class="dropdown-menu">

            @foreach ($actions as $action)
            <li>
                <a class="dropdown-item" type="button" href="{{ $action['route'] ?? '#' }}">{{ $action['title'] ?? '-' }}</a>
            </li>
            @endforeach

        </ul>
    </div>
@endif
@endif