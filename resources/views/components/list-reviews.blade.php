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
                        <button
                            class="text-gray-500 hover:text-gray-700 focus:outline-none"
                            id="review-menu-{{ $review->id }}"
                            @click="open = !open"
                            @click.away="open = false"
                        >
                            ⋮
                        </button>
                        <div
                            x-show="open"
                            x-transition
                            class="absolute right-0 mt-2 w-32 bg-white border rounded shadow z-10"
                        >
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
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
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
            No reviews yet.
        </div>
        @endforelse
    <div class="p-4">
        {{ $reviews->links() }}
    </div>
</div>
