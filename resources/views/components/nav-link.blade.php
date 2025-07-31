@props([
    'active' => false,
    'click' => null,
])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-primary dark:text-primary focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
    : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-primary dark:text-primary hover:text-primary dark:hover:text-primary hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-primary dark:focus:text-primary focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

@if ($click)
    <button type="button" @click="{{ $click }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@else
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@endif
