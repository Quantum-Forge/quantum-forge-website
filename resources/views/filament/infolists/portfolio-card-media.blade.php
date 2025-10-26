@php($card = 'bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-lg rounded-xl overflow-hidden')

<div role="article" class="group {{ $card }}">
    <div class="p-5">
        <h3 class="text-sm font-semibold tracking-wide text-gray-700 dark:text-gray-300">Media & Deskripsi</h3>
        <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 line-clamp-3">{{ $record->description2 }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-5">
        <div class="aspect-video bg-gray-100 dark:bg-gray-800 rounded-lg ring-1 ring-gray-200 dark:ring-gray-700 overflow-hidden">
            @if(!empty($record->images2_url))
                <img src="{{ $record->images2_url }}" alt="Gambar 2" loading="lazy" decoding="async" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.02]" />
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No image</div>
            @endif
        </div>
        <div class="aspect-video bg-gray-100 dark:bg-gray-800 rounded-lg ring-1 ring-gray-200 dark:ring-gray-700 overflow-hidden">
            @if(!empty($record->images3_url))
                <img src="{{ $record->images3_url }}" alt="Gambar 3" loading="lazy" decoding="async" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.02]" />
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No image</div>
            @endif
        </div>
        <div class="md:col-span-2 aspect-video bg-gray-100 dark:bg-gray-800 rounded-lg ring-1 ring-gray-200 dark:ring-gray-700 overflow-hidden">
            @if(!empty($record->images4_url))
                <img src="{{ $record->images4_url }}" alt="Gambar 4" loading="lazy" decoding="async" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.02]" />
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No image</div>
            @endif
        </div>
    </div>

    {{-- Skeleton loader while Livewire loading --}}
    <div wire:loading aria-hidden="true" class="p-5 animate-pulse">
        <div class="h-5 w-1/3 bg-gray-200 dark:bg-gray-700 rounded mb-3"></div>
        <div class="h-3 w-full bg-gray-200 dark:bg-gray-700 rounded mb-4"></div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="aspect-video bg-gray-200 dark:bg-gray-800 rounded"></div>
            <div class="aspect-video bg-gray-200 dark:bg-gray-800 rounded"></div>
            <div class="md:col-span-2 aspect-video bg-gray-200 dark:bg-gray-800 rounded"></div>
        </div>
    </div>
</div>