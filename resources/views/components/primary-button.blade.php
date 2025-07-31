@props([
    'click' => null,
])

@php
    $class = $attributes->get('class', 'inline-flex items-center px-4 py-2 bg-primary-dark border border-transparent rounded-md font-semibold text-xs text-primary uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-white hover:text-green-900 focus:bg-gray-100 active:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-4');
@endphp

@if ($click)
    <button type="button" @click="{{ $click }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </button>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $class]) }}>
        {{ $slot }}
    </button>
@endif