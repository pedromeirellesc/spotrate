@props(['reviews'])

<div class="p-4 bg-gray-100 rounded-lg shadow-md">
    @forelse($reviews as $review)
        <div class="review-item border-b py-4">
            <div class="flex items-center mb-2 justify-between">
                <div>
                    <span class="text-primary">{{ $review->user->name }}</span>
                    <span class="ml-2 text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                </div>
                @canany(['update', 'delete'], $review)
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                                class="p-2 rounded-full hover:bg-gray-200 focus:outline-none"
                                id="review-menu-{{ $review->id }}">
                            <svg class="w-6 h-6 text-gray-600" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M12 6v.01M12 12v.01M12 18v.01"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-transition
                             class="absolute right-0 z-50 mt-2 w-36 bg-white border border-gray-200">
                            @can('update', $review)
                                <a href="{{ route('reviews.edit', $review) }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('Edit') }}
                                </a>
                            @endcan
                            @can('delete', $review)
                                <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @endcanany
            </div>
            <div class="mb-1">
                <span class="text-yellow-400">
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < $review->rating)
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </span>
            </div>
            <div class="text-primary">
                {{ $review->comment }}
            </div>
        </div>
    @empty
        <div class="py-4 text-gray-500 text-center">
            {{ __('No reviews yet.') }}
        </div>
    @endforelse
    <div class="p-4">
        {{ $reviews->links() }}
    </div>
</div>
