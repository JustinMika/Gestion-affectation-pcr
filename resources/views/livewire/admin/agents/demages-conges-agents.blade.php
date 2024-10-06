<div>
    <section class="bg-gray-50 dark:bg-gray-900 ">
        <div class="max-w-screen-xl- px-4 mx-auto lg:px-12 w-full">
            <x-header-page>
                <x-slot name="left">
                    <x-input-search-icon :id="'search-input'" :name="'search_input'" :placeholder="'Search ...'" />
                </x-slot>
                <x-slot name="right">
                    <div class="flex gap-4 text-gray-600 dark:text-white">
                        <span class="mr-2">{{ count($data) }} demandes</span>
                        <x-leading/>
                    </div>
                </x-slot>
            </x-header-page>

            <x-messages :message="session('_error_')" :titre="'Info'" :id="'alert-2'" :color="'blue'" :hasMessage="Session::has('_error_')" />
            {{-- table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">No</th>
                            <th scope="col" class="px-4 py-3">Agents</th>
                            <th scope="col" class="px-4 py-3">Motif</th>
                            <th scope="col" class="px-4 py-3">date de debut</th>
                            <th scope="col" class="px-4 py-3">date de fin</th>
                            <th scope="col" class="px-4 py-3">Date d'enregistrement</th>
                            <th scope="col" class="px-4 py-3">Etat</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data ?? []) > 0)
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($data as $c)
                        {{-- @dd($c->employee) --}}
                        <tr class="border-b dark:border-gray-700 hover:bg-gray-100/10">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace- dark:text-white">{{ $i }}</th>
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace- dark:text-white">{{ $c->employee->name }}</th>
                            <td class="px-4 py-3">{{ $c->reason }}</td>
                            <td class="px-4 py-3">{{ $c->start_date }}</td>
                            <td class="px-4 py-3">{{ $c->end_date  }}</td>
                            <td class="px-4 py-3">{{ $c->created_at }}</td>
                            <td class="px-4 py-3">{{ $c->status }}</td>
                            <td class="px-4 py-3 flex items-center justify-end gap-3">
                                <button type="button" title="Activer/Desactiver" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-xl text-sm px-2.5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" wire:click='Approuver({{ $c->id }})' wire:loading.attr="disabled" wire:target='ChangeActiveUser'><svg wire:loading wire:target='ResetPassWord' aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-white fill-blue-600 mr-3" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                    </svg> Approuver
                                </button>
                                <button type="button" wire:loading.attr="disabled" wire:click='Rejetter({{ $c->id }})' wire:target='ResetPassWord' title="Reinitialiser le mot de passe" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-xl text-sm px-2.5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                    <svg wire:loading wire:target='ResetPassWord' aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-white fill-blue-600 mr-3" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                    </svg> Rejetter
                                </button>
                            </td>
                        </tr>
                        @php
                        $i += 1;
                        @endphp
                        @endforeach
                        @else
                        <div id="alert-border-1" class="flex items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800" role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <div class="ms-3 text-sm font-medium">
                                Aucune donnees.
                            </div>
                            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-border-1" aria-label="Close">
                                <span class="sr-only">Dismiss</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Main modal -->
    <x-modal id="modal-add-elmts" titre="Edition de l'etat de besoin">
        <x-form-livewire-template :name="'name'" :fonction="'updateEtatBesoin'">
            <x-textarea :id="'libelle'" :name="'libelle'" :placeholder="'Libelle/Description'" />
            <x-input-number name="quantite" label="Quantite" placeholder="Quantite" id="quantite" :value="0" />
            <x-input-number name="cout_unitaire" label="Cout unitaire" placeholder="cout unitaire" id="Cout_unitaire" :value="0" />
            <x-submit-button :titre="'Editer'" />
        </x-form-livewire-template>
    </x-modal>

    @script
    <script>
        $wire.on('confirmDelete', (e) => {
            Swal.fire({
                // title: "Information",
                text: "Voulez-vous vraiment supprimer l'enregistrement ?"
                , icon: 'info'
                , animation: true
                , backdrop: true
                , showCancelButton: true
                , confirmButtonColor: "#3085d6"
                , cancelButtonColor: "#d33"
                , confirmButtonText: "Oui"
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.dispatch('delete-event-database', {
                        IdElement: e.emltId
                    });
                }
            });
        });

        $wire.on('returnResponse', (event) => {
            const data = event[0];
            swal.fire({
                icon: data.icon
                , title: data.title
                , text: data.text
                , showConfirmButton: false
                , timer: 4000
                , animation: true
            });

            setTimeout(() => {
                $wire.dispatch('relead-data');
            }, 1000);
        });

    </script>
    @endscript
</div>
