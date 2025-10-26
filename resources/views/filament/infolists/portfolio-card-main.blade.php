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
            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 line-clamp-5">{{ $record->description_proyek }}</p>
        </div>
    </div>
</a>
<div class="mt-4 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 p-4">
    <div class="grid grid-cols-2 gap-3">
        <div class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-300">
            <x-filament::icon icon="heroicon-o-tag" class="w-4 h-4" />
            <span>{{ $record->category }}</span>
        </div>
        @if(!empty($record->clients))
            <div class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-300">
                <x-filament::icon icon="heroicon-o-user" class="w-4 h-4" />
                <span>{{ $record->clients }}</span>
            </div>
        @endif
        @if(!empty($record->kota))
            <div class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-300">
                <x-filament::icon icon="heroicon-o-map-pin" class="w-4 h-4" />
                <span>{{ $record->kota }}</span>
            </div>
        @endif
        @if(!empty($record->date))
            <div class="flex items-center gap-2 text-xs text-gray-600 dark:text-gray-300">
                <x-filament::icon icon="heroicon-o-calendar" class="w-4 h-4" />
                <span>{{ $record->date->format('d/m/Y') }}</span>
            </div>
        @endif
    </div>
</div>