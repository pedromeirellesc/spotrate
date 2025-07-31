@props(['value', 'class' => ''])

@php
    $attributes = $attributes->class( $class ? $class : 'block font-medium text-sm text-secondary dark:text-secondary ')
@endphp

<label {{ $attributes }}>
    {{ $value ?? $slot }}
</label>
