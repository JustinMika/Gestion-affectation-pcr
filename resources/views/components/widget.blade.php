@props(['titre'])
<div class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-1" style="margin-bottom: 20px !important">
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="text-base font-light text-gray-500 dark:text-gray-400">{{ $titre ?? '' }}</h3>
        {{ $slot }}
    </div>
</div>
