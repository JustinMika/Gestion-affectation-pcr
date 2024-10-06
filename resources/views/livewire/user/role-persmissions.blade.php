<div>
    @include('partials.breadcump', ['titre' => "Roles et permissions", 'titre2' => "Rôles et permissions"])
    <section class="bg-gray-50 dark:bg-gray-900 ">
        <div class="max-w-screen-xl- px-4 mx-auto lg:px-12 w-full">
            <x-header-page>
                <x-slot name="left">
                    <x-input-search-icon :id="'search-input'" :name="'search_input'" :placeholder="'Search ...'" />
                    <x-leading />
                </x-slot>
                <x-slot name="right">
                    <x-button-modal :titre="'Editer'" :id="'_btn'" :arg="''" :titre="'Ajouter une nouvelle permission'" :modal="'modal-add-permission'" icon="add" />
                </x-slot>
            </x-header-page>
            <x-messages :message="session('_error_')" :titre="'Info'" :id="'alert-2-2'" :color="'blue'" :hasMessage="Session::has('_error_')" />
            <x-table-template :headers="['#ID', 'permission', 'Date d\'ajout', 'guard_name', '###']" :data="''">
                @if (!empty($permission))
                @php
                $id = 1;
                @endphp
                @foreach ($permission as $c)
                <tr class="border-b dark:border-gray-700 dark:bg-gray-800 darkhover:bg-gray-400 hover:bg-gray-400">
                    <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-normal dark:text-white" colspan="6">{{ $id }}. {{ $c->name }}</td>
                </tr>
                @foreach ($c->permissions as $p)
                <tr class="border-b dark:border-gray-700 dark:bg-gray-800 darkhover:bg-gray-400 hover:bg-gray-400">
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-normal dark:text-white"> </a></th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-normal dark:text-white">{{ $p->name }}</th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-normal dark:text-white">{{ $p->created_at }}</th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-normal dark:text-white">{{ $p->guard_name }}</th>
                    <th class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white flex gap-2">
                        {{-- <x-button-action id="deletePermission" name="deletePermission" :icon="'delete'" color="red" fonction="deletePersmissions" :arg="$c->id" titre="" /> --}}
                        <button wire:click="deletePersmissions({{ $p->id }})" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 flex items-center justify-center" type="button">
                            <svg class="w-6 h-6 mr-2 dark:text-red-300 text-red-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                            </svg>
                            Supprimer la permission
                        </button>
                    </th>
                </tr>
                @endforeach
                @php
                $id +=1;
                @endphp
                @endforeach
                @endif
            </x-table-template>
            @if (empty($permission))
            <x-alert-message :message="'Aucune donnees pour le moment.'" />@endif
        </div>
        @if(!empty($permission))
        <div class="flex justify-center items-center">{{ $permission->links() }}</div>
        @endif
    </section>

    {{-- @dd($permission_list) --}}
    <!-- Main modal -->
    <x-modal id="modal-add-permission" :titre="'Attribution des permissions aux rôles'">
        <x-form-livewire-template :name="'AddPermission'" :fonction="'AddPermission'">
            <x-select-input :label="'Roles'" id="_roles_" name="roles_" :data="$roles" />
            <div class="w-full mt-4" wire:ignore style="margin-top: 1em!important">
                <label for="list_e" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Veuillez sélectionner des permissions</label>
                <select id="list_e" name="list_permission_roles[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required multiple wire:model='list_permission_roles'>
                    <optgroup label="permissions">
                        @foreach ($permission_list as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </optgroup>
                </select>
                @error('list_examen_patient') <span class="block mb-2 text-sm font-medium text-red-700">{{ $message }}</span> @enderror
            </div>

            <x-messages :message="session('success')" :titre="'Info'" :id="'alert-2'" :color="'green'" :hasMessage="Session::has('success')" />
            <x-messages :message="session('error')" :titre="'Erreur'" :id="'alert-2'" :color="'red'" :hasMessage="Session::has('error')" />
            <x-submit-button :titre="'Ajouter'" />
        </x-form-livewire-template>
    </x-modal>

    @script
    <script>
        $(document).ready(function() {
            $('#list_e').select2();

            $('#list_e').on('change', function(e) {
                // on relie avec le model livewire; on rajoute le false pour eviter les update pour chaque selection d'un element.
                @this.set('list_permission_roles', $(this).val(), false);
            });
        });

    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endscript
</div>
