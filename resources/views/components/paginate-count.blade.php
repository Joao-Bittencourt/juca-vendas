@props([
'data' => null
])

@if (is_object($data) && method_exists($data, 'links') && $data?->total() > 0)
<div class="row mt-2">
    <div class="col-lg-10">
        {{ __("Showing from ") .  $data?->firstItem() . __(' to ') . $data?->lastItem() . __(' of ') . $data?->total() }}
    </div>
    <div class="col-lg-2">
        {{ $data?->links() }}
    </div>
</div>
@endif
