@props(['rating' => null])

<div class="flex items-center">
    @for ($i = 1; $i <= 5; $i++)
        @php
            $currentRating = $rating ?? 0;

            $fillPercentage = 0;

            $fillPercentage = ($currentRating >= $i) ? 100 : ($currentRating > $i - 1 ? ($currentRating - ($i - 1)) * 100 : 0);

            $gradientId = 'star-gradient-' . $i . '-' . uniqid();
        @endphp

        <div class="relative">
            <svg class="w-5 h-5" viewBox="0 0 20 20">
                <defs>
                    <linearGradient id="{{ $gradientId }}" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="{{ $fillPercentage }}%" style="stop-color:#FBBF24;stop-opacity:1" />
                        <stop offset="{{ $fillPercentage }}%" style="stop-color:#D1D5DB;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <path fill="url(#{{ $gradientId }})"
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.163c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.174 9.384c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.957z"/>
            </svg>
        </div>
    @endfor
    <span class="ml-2 text-xs text-gray-500">{{ number_format($rating ?? 0, 1) }}</span>
</div>
