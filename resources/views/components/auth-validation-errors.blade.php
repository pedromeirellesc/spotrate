@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'w-full']) }}>
        <ul class="bg-red-600/10 border border-red-600 text-red-500 text-sm rounded-md px-4 py-2 w-full">
            @foreach ($errors->all() as $error)
                <li class="py-1 pl-2 border-l-2 border-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif