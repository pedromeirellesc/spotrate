<x-app-layout>
    <div class="flex flex-col items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="heading-main">{{ __('Welcome to SpotRate') }}</h1>
            <p class="subtitle-main">{{ __('Start now your journey rating places.') }}</p>
            <x-button-link class="btn-main mt-8" href="{{ route('reviews.select-place') }}">
                {{ __('Rating places') }}
            </x-button-link>
        </div>
    </div>
</x-app-layout>
