<section class="bg-white dark:bg-gray-900">
    <div class="w-full flex justify-end items-end mr-4">
        <x-button-link :titre="'Voir des lieux d\'affectations'" :icon="''" :link="'#'"/>
    </div>
    <div class="py-8 lg:py-12 px-4 mx-auto max-w-screen-md">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Affecter les
            gens dans leurs milieux lieu
            d'affectation</h2>
        <form action="#" class="space-y-8" wire:submit.prevent='saveAffectation'>
            <div class="w-full">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agents
                    PCR</label>
                <select type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Agents PCR" required wire:model='agent_pcr'>
                    <option value="">--Agents PCR--</option>
                    @if(count($agents_pcr) > 0)
                        @foreach ($agents_pcr as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('role_id')<span for="name"
                                       class="block mb-2 text-sm font-medium text-red-700">{{ $message }}</span>@enderror
            </div>

            <div class="w-full">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lieu
                    d'affectation</label>
                <select type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Rôle" required wire:model='lieu_'>
                    <option value="">--Lieu d'affectation--</option>
                    @if(count($lieu_affect) > 0)
                        @foreach ($lieu_affect as $r)
                            <option value="{{ $r->id }}">{{ $r->lieu }}</option>
                        @endforeach
                    @endif
                </select>
                @error('role_id')<span for="name"
                                       class="block mb-2 text-sm font-medium text-red-700">{{ $message }}</span>@enderror
            </div>
            <x-submit-button :titre="'Enregistrer'"/>
        </form>
    </div>

    @script
    <script>
        $wire.on('create', (event) => {
            const data = event[0];
            swal.fire({
                icon: data.icon
                , title: data.title
                , text: data.text
                , showConfirmButton: false
                , timer: 2000
                , animation: true
            }).then(e => {
                window.location.reload();
            });
        });

    </script>
    @endscript
</section>
