@props(['headers', '_data', 'data'])
<div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                @foreach ($headers as $header)
                <th scope="col" class="px-4 py-3 uppercase tracking-wider">
                    {{ $header }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @if (!empty($_data))
            @foreach ($_data as $c)
            <tr class="border-b dark:border-gray-700 hover:bg-slate-100/10">
                <th scope="row" class="px-4 py-3">
                    <x-profil :profil="$c->profil" :name="$c->name" />
                </th>
                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $c->name }}</th>
                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $c->email }}</th>
                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $c->phone ?? '-' }}</th>
                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $c->hasRole->name }}</th>
                <td class="px-4 py-3">{{ $c->created_at }}</td>
                <td class="px-4 py-3">{{ $c->updated_at }}</td>
                <td class="px-4 py-3">{{ $c->active ? 'active' : 'banis' }}</td>
                <td class="px-4 py-3 flex items-center justify-center text-center">
                    @if ($c->hasRole->id === 1)
                    <button class="flex justify-start items-start p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100" type="button">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </button>
                    @else
                    <button type="button" title="Supprimer {{ $c->name }}" class="block py-2 px-4 text-red-500 hover:bg-900-200 dark:hover:bg-700-600 dark:hover:text-900-500" wire:click='deleteUser({{ $c->id }})'>Supprimer</button>
                    @endif
                </td>
            </tr>
            @endforeach
            @else
            <x-alert-message :message="'No Data'" />
            @endif
        </tbody>
    </table>

    <!-- Affichage de la pagination -->
    {!! $data !!}
</div>
