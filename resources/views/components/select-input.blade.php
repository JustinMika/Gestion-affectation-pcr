@props(['id', 'name', 'label', 'data'])
<div class="w-full">
    <label for="{{ $name }}" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Accès" required wire:model="{{ $name }}">
        <option value="">--{{ $label }}--</option>
        @if(!empty($data ?? []) > 0)
        @foreach ($data as $r)
        <option value="{{ $r->id }}">{{ $r->name ?? $r->designation }}</option>
        @endforeach
        @endif
    </select>
    @error($name)<span for="name" class="block mb-2 text-sm font-medium text-red-700">{{ $message }}</label>@enderror
</div>
