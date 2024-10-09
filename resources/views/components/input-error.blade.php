@props(['messages'])

<style>
    .text-sm {
        font-size: 0.875 rem;
    }

    .text-red-600 {
        color: #dc3545;
    }

    .dark.text-red-400 {
        color: #f56565;
    }

    .space-y-1>*+* {
        margin-top: 0.25 rem;
    }
</style>

@if ($messages)
<ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 space-y-1']) }}>
    @foreach ((array) $messages as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
@endif