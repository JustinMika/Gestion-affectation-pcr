@props(['name', 'label', 'placeholder', 'id', 'type', 'disable'])
<div>
    <label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    <input type="{{ $type ?? "text" }}" id="{{ $id ?? '' }}" name="{{ $name }}" class="block flex-grow-1 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="{{ $placeholder }}" {{ isset($disable) && !empty($disable) ? 'disabled' : '' }} wire:model.live="{{ $name }}" {{ $attributes }}>
    @error($name)
    <span class="text-red-600 bg-red-200 px-3 py-2 rounded-md w-full block mt-2 font-bold">{{ $message }}</span>
    @enderror
</div>
