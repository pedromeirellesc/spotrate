<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Places') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full px-4">
            <x-button-link :href="route('places.create')" class="mb-6">
                {{ __('Create Place') }}
            </x-button-link>
            
            @if($places->count())
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg" style="overflow:visible;">
                    <table class="min-w-full w-full text-sm text-left text-gray-700 dark:text-gray-200" style="overflow:visible;">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4 font-semibold uppercase tracking-wider"> {{ __('Name') }} </th>
                                <th class="px-6 py-4 font-semibold uppercase tracking-wider"> {{ __('Address') }} </th>
                                <th class="px-6 py-4 font-semibold uppercase tracking-wider"> {{ __('Actions') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($places as $place)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition" style="overflow:visible;">
                                    <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                        <span class="font-medium">{{ $place->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                        {{ $place->address }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700" style="position:relative;overflow:visible;">
                                        <div x-data="{ open: false }" class="relative" style="overflow:visible;">
                                            <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none">
                                                <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v.01M12 12v.01M12 18v.01" />
                                                </svg>
                                            </button>
                                            <div
                                                x-show="open"
                                                @click.away="open = false"
                                                x-transition
                                                class="fixed z-50 mt-2 w-36 bg-white dark:bg-gray-800 rounded shadow-lg border border-gray-200 dark:border-gray-700"
                                                :style="{
                                                    left: ($el.closest('td').getBoundingClientRect().left + window.scrollX) + 'px',
                                                    top: ($el.closest('td').getBoundingClientRect().bottom + window.scrollY) + 'px'
                                                }"
                                            >
                                                <a href="{{ route('places.show', $place) }}"
                                                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    {{ __('View') }}
                                                </a>
                                                <a href="{{ route('places.edit', $place) }}"
                                                   class="block px-4 py-2 text-sm text-yellow-600 hover:bg-yellow-50 dark:hover:bg-gray-700">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('places.destroy', $place) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-gray-700">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-4">
                        {{ $places->links() }}
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow text-center text-gray-500 dark:text-gray-400">
                    {{ __('No places found.') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>