<section class="bg-white dark:bg-gray-900">
    <div class="py-8 lg:py-12 px-4 mx-auto max-w-screen-md">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Créer un État
            de Besoins</h2>
        <form action="#" class="space-y-8" wire:submit.prevent='CreerEtatdeBesoins'>
            <div class="w-full gap-4 grid grid-cols-2">
                <x-input-all type="date" name="date_start" label="Date debut" placeholder="Date debut" id="date_start"/>
                <x-input-all type="date" name="date_fin" label="Date fin" placeholder="Date fin" id="date_fin"/>
            </div>
            <x-textarea :id="'motif'" :name="'motif'" :placeholder="'Motif'"/>
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
            });
        });

    </script>
    @endscript
</section>
