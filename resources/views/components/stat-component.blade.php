@props(['data', 'titre', 'icon'])
<div
    class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="w-fit">
        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $titre }}</h3>
        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $data }}</span>
    </div>
    <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
        <span class="flex items-center mr-1.5 text-sm text-green-500 dark:text-green-400">
            @if($icon === 'user')
            <svg class="w-8 h-8 text-2xl" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                </path>
            </svg>
            @elseif($icon === 'stat')
            <svg class="w-8 h-8 text-2xl" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z">
                </path>
            </svg>
            @endif
        </span>
    </p>
</div>
