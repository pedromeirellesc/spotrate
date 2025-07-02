<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Place Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-8">
            <x-button-link :href="route('places.index')" class="mb-6">
                {{ __('Back to Places') }}
            </x-button-link>

            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $place->name }}</h3>
                @if($place->description)
                    <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $place->description }}</p>
                @endif
            </div>

            <div class="mb-2">
                <span class="font-semibold">{{ __('Address:') }}</span>
                <span>{{ $place->address }}</span>
            </div>
            <div class="mb-2">
                <span class="font-semibold">{{ __('City:') }}</span>
                <span>{{ $place->city }}</span>
            </div>
            <div class="mb-2">
                <span class="font-semibold">{{ __('State:') }}</span>
                <span>{{ $place->state }}</span>
            </div>
            <div class="mb-2">
                <span class="font-semibold">{{ __('Country:') }}</span>
                <span>{{ $place->country }}</span>
            </div>
            <div class="mb-2">
                <span class="font-semibold">{{ __('Instagram:') }}</span>
                @if($place->instagram)
                    <a href="{{ Str::startsWith($place->instagram, 'http') ? $place->instagram : 'https://instagram.com/' . ltrim($place->instagram, '@') }}" target="_blank" class="text-blue-500 hover:underline">
                        {{ $place->instagram }}
                    </a>
                @else
                    <span class="text-gray-400">-</span>
                @endif
            </div>
            <div class="mb-2">
                <span class="font-semibold">{{ __('WhatsApp:') }}</span>
                @if($place->whatsapp)
                    <a href="{{ Str::startsWith($place->whatsapp, 'http') ? $place->whatsapp : 'https://wa.me/' . preg_replace('/\D/', '', $place->whatsapp) }}" target="_blank" class="text-green-500 hover:underline">
                        {{ $place->whatsapp }}
                    </a>
                @else
                    <span class="text-gray-400">-</span>
                @endif
            </div>
            <div class="mb-2">
                <span class="font-semibold">{{ __('Website:') }}</span>
                @if($place->website)
                    <a href="{{ $place->website }}" target="_blank" class="text-blue-500 hover:underline">
                        {{ $place->website }}
                    </a>
                @else
                    <span class="text-gray-400">-</span>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>