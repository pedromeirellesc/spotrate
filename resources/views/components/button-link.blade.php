@props([
    'href' => '#',
    'type' => 'button',
    'color' => 'primary',
    'size' => 'md',
    'target' => null,
    'rel' => null,
])

<a
    href="{{ $href }}"
    @if($target) target="{{ $target }}" @endif
    @if($rel) rel="{{ $rel }}" @endif
    @class([
        'inline-block px-4 py-2 rounded transition',
        'bg-white text-gray-900 hover:bg-gray-100' => $color === 'primary',
        'bg-secondary-600 hover:bg-secondary-700 text-white' => $color === 'secondary',
        'bg-green-600 hover:bg-green-700 text-white' => $color === 'green',
        'bg-red-600 hover:bg-red-700 text-white' => $color === 'red',
        'text-sm' => $size === 'sm',
        'text-md' => $size === 'md',
        'text-lg' => $size === 'lg',
    ])
    {{ $attributes }}
>
    {{ $slot }}
</a>