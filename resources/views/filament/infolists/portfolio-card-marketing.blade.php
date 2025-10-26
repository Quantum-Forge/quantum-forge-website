@php($card = 'bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 shadow-lg rounded-xl overflow-hidden')

<div role="article" class="{{ $card }}">
    <div class="p-5 space-y-2">
        <h3 class="text-sm font-semibold tracking-wide text-gray-700 dark:text-gray-300">Pemasaran Digital</h3>
        <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-3">{{ $record->heading }}</p>
        <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-3">{{ $record->description2 }}</p>
    </div>
    <div class="p-5">
        @if(!empty($record->link))
            <a href="{{ $record->link }}" target="_blank" rel="noopener" title="Buka tautan pemasaran" class="inline-flex items-center gap-2 rounded-md px-3 py-2 bg-primary-600 text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-900">
                <span>Selengkapnya</span>
                <span aria-hidden="true">↗</span>
            </a>
        @else
            <span class="text-xs text-gray-500">Tidak ada tautan pemasaran</span>
        @endif
    </div>

    {{-- Skeleton loader while Livewire loading --}}
    <div wire:loading aria-hidden="true" class="p-5 animate-pulse">
        <div class="h-5 w-1/3 bg-gray-200 dark:bg-gray-700 rounded mb-3"></div>
        <div class="h-3 w-full bg-gray-200 dark:bg-gray-700 rounded mb-2"></div>
        <div class="h-3 w-5/6 bg-gray-200 dark:bg-gray-700 rounded"></div>
    </div>
</div>