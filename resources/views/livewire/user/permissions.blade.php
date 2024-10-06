<div>
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
                @foreach ($permission as $c)
                <tr class="border-b dark:border-gray-700 dark:bg-gray-800 darkhover:bg-gray-400 hover:bg-gray-400">
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-normal dark:text-white"> <a href="#">#{{ $c->id }}</a></th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-normal dark:text-white">{{ $c->name }}</th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-normal dark:text-white">{{ $c->created_at }}</th>
                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-normal dark:text-white">{{ $c->guard_name }}</th>
                    <th class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white flex gap-2">
                        <x-button-action id="deletePermission" name="deletePermission" :icon="'delete'" color="red" fonction="deletePermission" :arg="$c->id" titre="Supprimer" />
                    </th>
                </tr>
                @endforeach
                @endif
            </x-table-template>
            @if (empty($permission))
            <x-alert-message :message="'Aucune donnees pour le moment.'" />@endif
        </div>

        <div class="flex justify-center items-center">{{ $permission->links() }}</div>
    </section>

    <!-- Main modal -->
    <x-modal id="modal-add-permission" :titre="'Ajout des permissions'">
        <x-form-livewire-template :name="'AddPermission'" :fonction="'AddPermission'">
            <x-input-all type="text" name="permissions" label="permissions" placeholder="permissions" id="permissions" />
            <x-messages :message="session('success')" :titre="'Info'" :id="'alert-2'" :color="'green'" :hasMessage="Session::has('success')" />
            <x-messages :message="session('error')" :titre="'Erreur'" :id="'alert-2'" :color="'red'" :hasMessage="Session::has('error')" />
            <x-submit-button :titre="'Ajouter'" />
        </x-form-livewire-template>
    </x-modal>
</div>
