<x-app-layout>
    <div class="py-12">
        <div class="w-full px-4">

            @if ($places->count())
                <div class="bg-white rounded-lg" style="overflow:visible;">
                    <table class="min-w-full w-full text-sm text-left text-gray-700"
                        style="overflow:visible;">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 font-semibold uppercase tracking-wider"> {{ __('Name') }} </th>
                                <th class="px-6 py-4 font-semibold uppercase tracking-wider"> {{ __('Address') }} </th>
                                <th class="px-6 py-4 font-semibold uppercase tracking-wider"> {{ __('Rating') }} </th>
                                <th class="px-6 py-4 font-semibold uppercase tracking-wider"> {{ __('Created') }} </th>
                                <th class="px-6 py-4 font-semibold uppercase tracking-wider"> {{ __('Actions') }} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($places as $place)
                                <tr class="hover:bg-gray-50"
                                    style="overflow:visible;">
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        <span class="font-medium">{{ $place->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $place->address }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        <x-star-rating :rating="$place->reviews_avg_rating" />
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200">
                                        {{ $place->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 relative">
                                        <div x-data="{ open: false }" class="relative">
                                            <button @click="open = !open"
                                                class="p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                                                <svg class="w-6 h-6 text-gray-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 6v.01M12 12v.01M12 18v.01" />
                                                </svg>
                                            </button>
                                            <div x-show="open" @click.away="open = false" x-transition
                                                class="absolute right-0 z-50 mt-2 w-36 bg-white border border-gray-200">
                                                <a href="{{ route('places.show', $place) }}"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    {{ __('View') }}
                                                </a>
                                                <a href="{{ route('places.edit', $place) }}"
                                                    class="block px-4 py-2 text-sm text-blue-600 hover:bg-blue-50">
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('places.destroy', $place) }}" method="POST"
                                                    onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
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
                <div class="bg-white p-6 rounded shadow text-center text-gray-500">
                    {{ __('No places found.') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
