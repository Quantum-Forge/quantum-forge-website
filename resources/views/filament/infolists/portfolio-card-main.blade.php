@php($url = route('portfolio.details', $record))
@php($card = 'bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-lg rounded-xl overflow-hidden')

<a href="{{ $url }}" class="relative block focus:outline-none focus:ring-2 focus:ring-primary-500 rounded-xl" title="Buka detail portfolio">
    <div role="article" class="group {{ $card }} transition-transform hover:scale-[1.02]">
        <div class="aspect-video bg-gray-100 dark:bg-gray-800">
            @if(!empty($record->images1_url))
                <img src="{{ $record->images1_url }}" alt="{{ $record->title }}" loading="lazy" decoding="async" class="w-full h-full object-cover" />
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No thumbnail</div>
            @endif
        </div>
        <div class="p-5">
            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">{{ $record->title }}</h3>
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 line-clamp-3">{{ $record->description_proyek }}</p>
            <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-500 dark:text-gray-400">
                <span class="inline-flex items-center"><span class="mr-1" aria-hidden="true">📅</span>{{ optional($record->date)->format('d M Y') }}</span>
                <span class="inline-flex items-center"><span class="mr-1" aria-hidden="true">🏷️</span>{{ $record->category }}</span>
                @if(!empty($record->clients))
                    <span class="inline-flex items-center"><span class="mr-1" aria-hidden="true">👤</span>{{ $record->clients }}</span>
                @endif
                @if(!empty($record->kota))
                    <span class="inline-flex items-center"><span class="mr-1" aria-hidden="true">📍</span>{{ $record->kota }}</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Skeleton loader while Livewire loading --}}
    <div wire:loading aria-hidden="true" class="absolute inset-0 rounded-xl">
        <div class="bg-white/70 dark:bg-gray-900/70 backdrop-blur-sm rounded-xl animate-pulse">
            <div class="aspect-video bg-gray-200 dark:bg-gray-800"></div>
            <div class="p-5 space-y-3">
                <div class="h-5 w-1/2 bg-gray-200 dark:bg-gray-700 rounded"></div>
                <div class="h-3 w-full bg-gray-200 dark:bg-gray-700 rounded"></div>
                <div class="h-3 w-5/6 bg-gray-200 dark:bg-gray-700 rounded"></div>
            </div>
        </div>
    </div>
</a>