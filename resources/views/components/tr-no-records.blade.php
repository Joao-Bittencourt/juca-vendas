@props([
    'message' => 'There are no records.',
    'traslate' => true
])

<tr {{ $attributes->merge(['class' => '']) }}>
    <td colspan="6" class="text-center">
    {{ $traslate ? __($message) : $message }}
    </td>
</tr>