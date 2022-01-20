@props(['customAttributes' => ['class'=>'border']])

<td {{ $attributes->merge($customAttributes) }}>
    {{ $slot }}
</td>
