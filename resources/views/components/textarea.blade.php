@props(['name', 'label', 'placeholder', 'id', 'value', 'class', 'rows'])
<div class="sm:col-span-2_ {{ $class ?? '' }}">
    <label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">{{ $placeholder }}</label>
    <textarea id="{{ $id }}" rows="{{ !empty($rows) ? $rows : '6' }}" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="{{ $placeholder }}" wire:model="{{ $name }}"></textarea>
    @error($name)
    <span class="text-red-600 font-bold">{{ $message }}</span>
    @enderror
</div>
