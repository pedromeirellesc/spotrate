@props(['place'])

<section class="bg-primary-dark text-primary rounded-2xl p-6 max-w-4xl mx-auto mb-10 shadow mt-32">
    <h1 class="heading-main text-primary">{{ $place->name }}</h1>

    <div class="flex items-center mb-4">
        <x-star-rating :rating="$place->reviews_avg_rating" />
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
