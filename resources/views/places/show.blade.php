<x-app-layout>
    <div x-data>
        <x-place-view :place="$place" />

        <x-create-review-modal name="create-review-modal" title="Create Review" :place="$place" />

        <div class="max-w-4xl mx-auto mt-10">
            <x-secondary-button
                click="window.dispatchEvent(new CustomEvent('open-modal', { detail: { id: 'create-review-modal' } }))">
                {{ __('Add Review') }}
            </x-secondary-button>
        </div>

        <x-list-reviews :reviews="$reviews" />
    </div>
</x-app-layout>
