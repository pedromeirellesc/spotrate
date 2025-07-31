<x-app-layout>
    <div class="py-12">
        <div class="w-full px-4">

            @if ($places->count())
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg" style="overflow:visible;">
                    <table class="min-w-full w-full text-sm text-left text-gray-700 dark:text-gray-200"
                        style="overflow:visible;">
                        <thead class="bg-gray-100 dark:bg-gray-700">
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
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition"
                                    style="overflow:visible;">
                                    <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                        <span class="font-medium">{{ $place->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                        {{ $place->address }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                        @php $rating = number_format($place->reviews_avg_rating, 1); @endphp
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.163c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.174 9.384c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.957z" />
                                                </svg>
                                            @endfor
                                            <span
                                                class="ml-2 text-xs text-gray-500 dark:text-gray-400">{{ $rating }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                        {{ $place->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 relative">
                                        <div x-data="{ open: false }" class="relative">
                                            <button @click="open = !open"
                                                class="p-2 rounded-full hover:bg-gray-200 focus:outline-none">
                                                <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 6v.01M12 12v.01M12 18v.01" />
                                                </svg>
                                            </button>
                                            <div x-show="open" @click.away="open = false" x-transition
                                                class="absolute right-0 z-50 mt-2 w-36 bg-white dark:bg-gray-800 rounded shadow-lg border border-gray-200 dark:border-gray-700">
                                                <a href="{{ route('places.show', $place) }}"
                                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100">
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
                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow text-center text-gray-500 dark:text-gray-400">
                    {{ __('No places found.') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
