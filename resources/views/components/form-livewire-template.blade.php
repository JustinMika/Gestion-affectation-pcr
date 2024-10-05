@props(['action', 'name', 'fonction', 'class'])
<form wire:ignore.self action="{{ isset($action) && !empty($action) ? $action : '#' }}" id="{{ $name }}" name="{{ $name }}" wire:submit.prevent="{{ isset($fonction) && !empty($fonction) ? $fonction : '' }}" class="space-y-2 {{ $class ?? '' }}">
    {{ $slot }}
</form>
