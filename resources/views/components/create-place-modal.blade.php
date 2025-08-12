<x-modal name="{{ $name }}" title="{{ $title }}" maxWidth="3xl" :show="$errors->any()">
    <div class="max-w-3xl mx-auto py-8 px-2">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('places.store') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required
                    autofocus :value="old('name')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Description')" />
                <x-textarea id="description" class="block mt-1 w-full"
                    name="description" :value="old('description')"></x-textarea>
            </div>

            <div>
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                    :value="old('address')" />
            </div>

            <div>
                <x-input-label for="instagram" :value="__('Instagram')" />
                <div class="flex rounded-md shadow-sm">
                    <span
                        class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        instagram.com/
                    </span>
                    <x-text-input id="instagram" class="block w-full rounded-none rounded-r-md" type="text"
                        name="instagram" :value="old('instagram')" placeholder="@usuario" />
                </div>
            </div>

            <div>
                <x-input-label for="whatsapp" :value="__('WhatsApp')" />
                <x-text-input id="whatsapp" class="block mt-1 w-full" type="text" name="whatsapp"
                    :value="old('whatsapp')" />
            </div>

            <div>
                <x-input-label for="website" :value="__('Website')" />
                <x-text-input id="website" class="block mt-1 w-full" type="url" name="website"
                    :value="old('website')" />
            </div>

            <div class="flex items-center justify-end">
                <x-primary-button>
                    {{ __('Save') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
