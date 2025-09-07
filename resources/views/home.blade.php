<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-[60vh] py-8 px-4 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 text-primary-900">{{ __('Welcome to SpotRate') }}</h1>
        <p class="text-lg sm:text-xl mb-8 text-primary-700">{{ __('Start now your journey rating places.') }}</p>
        <x-button-link class="px-6 py-3 rounded-lg bg-primary-600 text-white text-base font-semibold hover:bg-primary-700 transition" href="{{ route('reviews.select-place') }}">
            {{ __('Rate places') }}
        </x-button-link>
    </div>
</x-app-layout>
