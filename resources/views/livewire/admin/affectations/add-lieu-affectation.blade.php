<section class="bg-white dark:bg-gray-900">
    <div class="w-full flex justify-end items-end mr-4">
        <x-button-link :titre="'Voir des lieux d\'affectations'" :icon="''" :link="'#'"/>
    </div>
    <div class="py-8 lg:py-12 px-4 mx-auto max-w-screen-md">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Créer un lieu
            d'affectation</h2>
        <form action="#" class="space-y-8" wire:submit.prevent='CreerLieuAffact'>
            <x-textarea :id="'lieu_affactation'" :name="'lieu_affactation'" :placeholder="'Lieu d\'affectation'"
                        :rows="'2'"/>
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
