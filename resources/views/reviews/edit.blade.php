<x-app-layout>

    <x-place-view :place="$review->place" />

    <div class="max-w-3xl mx-auto py-8 px-2">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('reviews.update', $review) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div x-data="ratingComponent({{ old('rating', $review->rating) }})" class="flex space-x-1 mt-1">
                <template x-for="star in 5" :key="star">
                    <button type="button" @click="setRating(star)" @mouseover="setHover(star)" @mouseleave="setHover(0)"
                        class="focus:outline-none" :aria-pressed="star <= rating"
                        :aria-label="`{{ __('Rate') }} ${star}`">
                        <svg :class="star <= (hover || rating) ? 'text-yellow-400' : 'text-gray-300'"
                            xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.462a1 1 0 00-.364 1.118l1.286 3.974c.3.921-.755 1.688-1.54 1.118L10 13.347l-3.388 2.462c-.784.57-1.838-.197-1.539-1.118l1.285-3.974a1 1 0 00-.364-1.118L3.606 9.4c-.783-.57-.38-1.81.588-1.81h4.181a1 1 0 00.95-.69l1.284-3.974z" />
                        </svg>
                    </button>
                </template>
                <input type="hidden" name="rating" :value="rating" />
            </div>

            <div>
                <x-input-label for="comment" :value="__('Comment')" />
                <x-textarea id="comment" class="block mt-1 w-full"
                    name="comment">{{ old('comment', $review->comment) }}</x-textarea>
                <x-input-error :messages="$errors->get('comment')" class="mt-2" />
            </div>

            <div>
                <x-text-input id="place_id" type="hidden" name="place_id" value="{{ $review->place_id }}" />
                <x-text-input id="user_id" type="hidden" name="user_id" value="{{ $review->user_id }}" />
            </div>
            <div class="flex items-center justify-end">
                <x-primary-button>
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('ratingComponent', (initial = 0) => ({
            rating: Number(initial) || 0,
            hover: 0,
            setRating(value) {
                this.rating = value;
            },
            setHover(value) {
                this.hover = value;
            }
        }));
    });
</script>
