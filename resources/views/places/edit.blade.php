<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Place') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full px-4">
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <x-button-link :href="route('places.index')" class="mb-6">
                {{ __('Back to Places') }}
            </x-button-link>

            <form action="{{ route('places.update', $place) }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $place->name)" required autofocus />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <x-textarea id="description" class="block mt-1 w-full" name="description">{{ old('description', $place->description) }}</x-textarea>
                </div>

                <div>
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $place->address)" />
                </div>

                <div>
                    <x-input-label for="city" :value="__('City')" />
                    <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $place->city)" />
                </div>

                <div>
                    <x-input-label for="state" :value="__('State')" />
                    <x-text-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state', $place->state)" />
                </div>

                <div>
                    <x-input-label for="country" :value="__('Country')" />
                    <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country', $place->country)" />
                </div>

                <div>
                    <x-input-label for="instagram" :value="__('Instagram (link or @)')" />
                    <x-text-input id="instagram" class="block mt-1 w-full" type="text" name="instagram" :value="old('instagram', $place->instagram)" />
                </div>

                <div>
                    <x-input-label for="whatsapp" :value="__('WhatsApp (number or link)')" />
                    <x-text-input id="whatsapp" class="block mt-1 w-full" type="text" name="whatsapp" :value="old('whatsapp', $place->whatsapp)" />
                </div>

                <div>
                    <x-input-label for="website" :value="__('Website')" />
                    <x-text-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website', $place->website)" />
                </div>

                <div class="flex items-center justify-end">
                    <x-primary-button>
                        {{ __('Save Changes') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>