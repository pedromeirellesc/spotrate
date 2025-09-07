<x-app-layout>
    <div class="py-12">
        <div class="w-full px-2 sm:px-4">
            @if ($places->count())
                                    <div class="bg-white rounded-lg overflow-x-auto">
                    <table class="min-w-full w-full text-sm text-left text-gray-700">
                        <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-3 py-3.5 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700 uppercase tracking-wider">{{ __('Name') }}</th>
                                    <th class="hidden sm:table-cell px-3 py-3.5 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700 uppercase tracking-wider">{{ __('Address') }}</th>
                                    <th class="px-3 py-3.5 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700 uppercase tracking-wider">{{ __('Rating') }}</th>
                                    <th class="hidden md:table-cell px-3 py-3.5 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700 uppercase tracking-wider">{{ __('Created') }}</th>
                                    <th class="px-3 py-3.5 sm:px-6 text-left text-xs sm:text-sm font-semibold text-gray-700 uppercase tracking-wider">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($places as $place)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-3 py-4 sm:px-6 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">{{ $place->name }}</div>
                                                <div class="sm:hidden ml-2 text-xs text-gray-500">
                                                    {{ Str::limit($place->address, 30) }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="hidden sm:table-cell px-3 py-4 sm:px-6 text-sm text-gray-500">
                                            {{ $place->address }}
                                        </td>
                                        <td class="px-3 py-4 sm:px-6">
                                            <x-star-rating :rating="$place->reviews_avg_rating" />
                                        </td>
                                        <td class="hidden md:table-cell px-3 py-4 sm:px-6 text-sm text-gray-500">
                                            {{ $place->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-3 py-4 sm:px-6 relative">
                                        <div x-data="{ open: false }" class="relative">
                                            <button @click="open = !open"
                                                class="inline-flex items-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                                <span class="sr-only">Open options</span>
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6v.01M12 12v.01M12 18v.01" />
                                                </svg>
                                            </button>
                                            <div x-show="open" @click.away="open = false"
                                                x-transition:enter="transition ease-out duration-100"
                                                x-transition:enter-start="transform opacity-0 scale-95"
                                                x-transition:enter-end="transform opacity-100 scale-100"
                                                x-transition:leave="transition ease-in duration-75"
                                                x-transition:leave-start="transform opacity-100 scale-100"
                                                x-transition:leave-end="transform opacity-0 scale-95"
                                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none z-50">
                                                <div class="py-1">
                                                    <a href="{{ route('places.show', $place) }}"
                                                        class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        {{ __('View') }}
                                                    </a>
                                                    <a href="{{ route('places.edit', $place) }}"
                                                        class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        {{ __('Edit') }}
                                                    </a>
                                                </div>
                                                <div class="py-1">
                                                    <form action="{{ route('places.destroy', $place) }}" method="POST"
                                                        onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="group flex w-full items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                                            <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">{{ __('No places') }}</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ __('Get started by creating a new place.') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
