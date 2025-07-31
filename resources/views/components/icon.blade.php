@props(['name', 'class' => 'w-5 h-5'])

@switch($name)
    @case('map-pin')
        <svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 22s8-6.5 8-13A8 8 0 0 0 4 9c0 6.5 8 13 8 13z" />
        </svg>
    @break

    @case('instagram')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M7.75 2A5.75 5.75 0 0 0 2 7.75v8.5A5.75 5.75 0 0 0 7.75 22h8.5A5.75 5.75 0 0 0 22 16.25v-8.5A5.75 5.75 0 0 0 16.25 2h-8.5Zm0 1.5h8.5A4.25 4.25 0 0 1 20.5 7.75v8.5a4.25 4.25 0 0 1-4.25 4.25h-8.5a4.25 4.25 0 0 1-4.25-4.25v-8.5A4.25 4.25 0 0 1 7.75 3.5ZM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 1.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7Zm5.25-.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
        </svg>
    @break

    @case('globe')
        <svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 0c3.5 3.5 3.5 13 0 16m0-16C8.5 5.5 8.5 15.5 12 18" />
        </svg>
    @break

    @case('whatsapp')
        <svg {{ $attributes->merge(['class' => $class]) }} fill="currentColor" viewBox="0 0 32 32"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M16.003 3.2c-7.072 0-12.8 5.73-12.8 12.8 0 2.258.593 4.464 1.716 6.409L3.2 28.8l6.602-1.683A12.742 12.742 0 0 0 16.003 28.8c7.071 0 12.797-5.73 12.797-12.8s-5.726-12.8-12.797-12.8Zm0 23.2a10.34 10.34 0 0 1-5.292-1.458l-.379-.225-3.92 1 .998-3.818-.246-.391a10.405 10.405 0 1 1 8.839 5.892Zm5.479-7.947c-.301-.15-1.777-.879-2.054-.98-.276-.104-.478-.15-.68.15s-.78.98-.956 1.183c-.175.2-.35.225-.65.075-.301-.15-1.272-.468-2.421-1.494a8.998 8.998 0 0 1-1.65-2.05c-.175-.3-.018-.462.132-.612.136-.135.301-.351.452-.527.15-.18.2-.3.3-.5.1-.2.05-.375-.025-.527-.075-.15-.68-1.638-.931-2.241-.244-.586-.493-.508-.679-.518a1.63 1.63 0 0 0-.562.05c-.15.05-.476.174-.726.425-.25.25-.95.928-.95 2.263s.975 2.625 1.11 2.805c.136.18 1.92 2.933 4.655 4.118.65.281 1.155.45 1.55.575.65.206 1.242.177 1.708.108.521-.077 1.777-.726 2.029-1.428.251-.7.251-1.3.176-1.426-.075-.125-.276-.2-.577-.35Z" />
        </svg>
    @break

    @default
        <svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor">
            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM10 18a8 8 0 110-16 8 8 0 010 16z" />
        </svg>
@endswitch
