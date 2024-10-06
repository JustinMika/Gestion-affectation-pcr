@props(['name', 'label', 'placeholder', 'id', 'value'])
<div>
    <label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $label }}</label>
    <input type="number" step="0.10" id="{{ $id ?? '' }}" name="{{ $name }}" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="{{ $placeholder }}" required wire:model="{{ $name }}">
    @error($name)
    <span class="text-red-600 font-bold">{{ $message }}</span>
    @enderror
</div>
