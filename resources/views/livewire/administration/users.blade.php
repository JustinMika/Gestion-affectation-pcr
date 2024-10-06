<div>
    <section class="bg-gray-50 dark:bg-gray-900 ">
        <div class="max-w-screen-xl- px-4 mx-auto lg:px-12 w-full">
            <!-- Start coding here -->
            <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div
                    class="flex flex-col- items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                    <div class="w-full- md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                         fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="text" wire:model.live.debounce.300ms='search_input' id="simple-search"
                                       class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Search" required="">
                            </div>
                        </form>
                    </div>
                    <div
                        class="flex flex-col- items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                        <button id="defaultModalButton" data-modal-target="defaultModal"
                                data-modal-toggle="defaultModal"
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 flex justify-evenly items-baseline"
                                type="button">
                            <svg class="h-4 w-4 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                            </svg>
                            Ajouter un agent
                        </button>
                    </div>
                </div>
            </div>
            <x-messages :message="session('_error_')" :titre="'Info'" :id="'alert-2'" :color="'blue'"
                        :hasMessage="Session::has('_error_')"/>
            {{-- @dump($users) --}}
            <x-table :headers="['Profil','Nom','Email','Telephone','Acces','Created','Updated','Status', 'Actions']"
                     :_data="$users->items()" :data="$users"/>
        </div>
    </section>

    <x-modal :id="'defaultModal'" :titre="'Ajout des agents'" size="max-w-2xl">
        <form action="#" wire:submit.prevent='saveUsers' class="py-4">
            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div class="w-full">
                    <x-input-all :type="'text'" :name="'name'" :id="'name'" :placeholder="'Noms complet'"
                                 :label="'Noms complet'"/>
                </div>

                <div class="w-full">
                    <x-input-all :type="'email'" :name="'email'" :id="'email'" :placeholder="'Email'" :label="'Email'"/>
                </div>

                <div class="w-full">
                    <x-input-all :type="'text'" :name="'phone'" :id="'phone'" :placeholder="'Telephone'"
                                 :label="'Telephone'"/>
                </div>

                <div class="w-full grid grid-cols-2 gap-2">
                    <x-input-all :type="'password'" :name="'password'" :id="'password'" :placeholder="'Mot de passe'"
                                 :label="'Mot de passe'"/>
                    <x-input-all :type="'password'" :name="'confirm_password'" :id="'confirm_password'"
                                 :placeholder="'Confirmer le mot de passe'" :label="'Confirmer le mot de passe'"/>
                </div>

                <div class="w-full">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rôle</label>
                    <select type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Rôle" required wire:model='role_id'>
                        <option value="">--Rôle--</option>
                        @if(count($roles) > 0)
                            @foreach ($roles as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('role_id')<span for="name"
                                           class="block mb-2 text-sm font-medium text-red-700">{{ $message }}</label>@enderror
                </div>
            </div>

            <x-messages :message="session('success')" :titre="'Info'" :id="'alert-2'" :color="'green'"
                        :hasMessage="Session::has('success')"/>
            <x-messages :message="session('error')" :titre="'Erreur'" :id="'alert-2'" :color="'red'"
                        :hasMessage="Session::has('error')"/>

            <x-submit-button titre="Ajouter l'agent"/>
        </form>
    </x-modal>

    @script
    <script>
        document.addEventListener('livewire:load', function () {
            // Ce code s'exécute lorsque le composant Livewire est rendu pour la première fois
            console.log('Le composant Livewire est rendu!');
            alert("Le composant Livewire est rendu!");
        });

        document.addEventListener('livewire:update', function () {
            // Ce code s'exécute après chaque mise à jour Livewire
            console.log('Le composant Livewire est mis à jour!');
            alert("Le composant Livewire est mis à jour!");
        });

        Livewire.on('userAdded', () => {
            location.reload(); // Actualiser la page lorsque l'événement 'userAdded' est émis
        });

    </script>
    @endscript
</div>
