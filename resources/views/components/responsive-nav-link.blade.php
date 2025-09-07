@props(['active' => false, 'href' => false, 'click' => false])

@php
$classes = 'block w-full ps-3 pe-4 py-2 border-l-4 text-start text-sm font-medium leading-5 text-primary transition duration-150 ease-in-out';
$classes .= $active
    ? ' border-primary-400 text-primary-700 bg-primary-50 focus:outline-none focus:text-primary-800 focus:bg-primary-100 focus:border-primary-700'
    : ' border-transparent text-primary hover:text-primary-800 hover:bg-primary-50 hover:border-primary-300 focus:outline-none focus:text-primary-800 focus:bg-primary-50 focus:border-primary-300';
@endphp

@if ($href)
    <a {{ $attributes->merge(['class' => $classes, 'href' => $href]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes, '@click' => $click, 'type' => 'button']) }}>
        {{ $slot }}
    </button>
@endif
