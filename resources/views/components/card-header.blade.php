@props([
    'title' => '',
    'titleLink' => '',
    'controller' => '',
    'action' => 'index',
])

@php
$titleLower = strtolower($title);
$titleLink = $titleLink ?: 'List ' . $titleLower; 
$controller = $controller ?: $titleLower;
@endphp
<div class="card-header">
    {{ __($title) }}
    <a href="{{ route($controller . '.' . $action) }}" class="btn btn-primary btn-sm float-right">
        {{ __($titleLink)}}
    </a>
</div>