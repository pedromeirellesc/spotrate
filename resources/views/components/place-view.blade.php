@props(['place'])

<section class="bg-primary-dark text-primary rounded-2xl p-6 max-w-4xl mx-auto mb-10 shadow mt-32">
    <h1 class="heading-main text-primary">{{ $place->name }}</h1>

    <div class="flex items-center mb-4">
        @php $rating = number_format($place->reviews_avg_rating ?? 0, 1); @endphp
        <div class="flex items-center">
            @for ($i = 1; $i <= 5; $i++)
                <svg class="w-5 h-5 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor"
                     viewBox="0 0 20 20">
                    <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.163c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.174 9.384c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.957z"/>
                </svg>
            @endfor
            <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">{{ $rating }}</span>
        </div>
    </div>

    <div class="flex items-center text-sm text-primary mb-4">
        <x-icon name="map-pin" class="w-5 h-5 mr-2 text-gray-400"/>
        {{ $place->address }}
    </div>

    @if ($place->instagram)
        <div class="flex items-center text-sm text-primary mb-4">
            <x-icon name="instagram" class="w-5 h-5 mr-2 text-gray-400"/>
            <a href="https://instagram.com/{{ $place->instagram }}" target="_blank" rel="noopener noreferrer"
               class="text-primary hover:underline">
                {{ '@' . $place->instagram }}
            </a>
        </div>
    @endif

    @if ($place->website)
        <div class="flex items-center text-sm text-primary mb-4">
            <x-icon name="globe" class="w-5 h-5 mr-2 text-gray-400"/>
            <a href="{{ $place->website }}" target="_blank" rel="noopener noreferrer"
               class="text-primary hover:underline">
                {{ $place->website }}
            </a>
        </div>
    @endif

    @if ($place->whatsapp)
        <div class="flex items-center text-sm text-primary mb-4">
            <x-icon name="whatsapp" class="w-5 h-5 mr-2 text-gray-400"/>
            <a href="https://wa.me/{{ $place->whatsapp }}" target="_blank" rel="noopener noreferrer"
               class="text-primary hover:underline">
                {{ $place->whatsapp }}
            </a>
        </div>
    @endif

    @if ($place->description)
        <h2 class="text-lg font-semibold text-primary">{{ __('About') }}</h2>
        <p class="text-primary mb-4">{{ $place->description }}</p>
    @endif


</section>
