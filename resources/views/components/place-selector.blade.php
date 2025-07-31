@props([
    'redirectTo' => '/reviews/create/',
])

<div x-data="placeSelector('{{ $redirectTo }}')" x-init="init()" class="w-full flex justify-center items-center"
    style="min-height: 70vh;">
    <div class="w-full max-w-2xl">
        <div class="bg-white rounded-lg shadow p-6">
            <x-input-label for="place" :value="__('Select a place')" :class="'text-primary'" />
            <x-text-input :placeholder="__('Type a place...')" x-model="query" @input.debounce.300ms="fetchPlaces" @keydown.escape="clear"
                @focus="open = true" @click.away="open = false" class="w-full" />
            <ul x-show="open"
                class="absolute z-10 w-auto bg-white text-black border border-gray-300 rounded mt-1 max-h-60 overflow-auto">
                <template x-if="results.length > 0">
                    <template x-for="place in results" :key="place.id">
                        <li @click="select(place)" class="px-4 py-2 hover:bg-gray-200 cursor-pointer"
                            x-text="place.name"></li>
                    </template>
                </template>
                <template x-if="query.length >= 2 && results.length === 0">
                    <li class="px-4 py-2 text-sm text-gray-600">
                        {{ __('No places found.') }}
                        <x-primary-button
                            @click="window.openModal('create-place-modal'); $nextTick(() => { document.getElementById('name').value = query })">
                            {{ __('Add new place') }}
                        </x-primary-button>
                    </li>
                </template>
            </ul>
            <x-create-place-modal name="create-place-modal" title="Create place"/>
        </div>
    </div>
</div>

<script>
    function placeSelector(redirectTo) {
        return {
            query: '',
            results: [],
            open: false,
            openModal: false,
            newPlaceName: '',

            init() {
                this.clear();
            },

            fetchPlaces() {
                if (this.query.length < 2) {
                    this.results = [];
                    return;
                }

                fetch(`/places/search?q=${encodeURIComponent(this.query)}`)
                    .then(res => res.json())
                    .then(data => {
                        this.results = data;
                        this.open = true;
                    });
            },

            select(place) {
                this.query = place.name;
                this.open = false;
                window.location.href = `${redirectTo}${place.id}`;
            },

            clear() {
                this.query = '';
                this.results = [];
                this.open = false;
            }
        };
    }
</script>
