<div>
    <section class="bg-gray-50 dark:bg-gray-900 ">
        <div class="max-w-screen-xl- px-4 mx-auto lg:px-12 w-full">
            <x-header-page>
                <x-slot name="left">
                    <h4 class="text-gray-700 dark:text-white">Faites scanner votre QR-CODE</h4>
                </x-slot>
                <x-slot name="right">
                    <div class="flex gap-4 text-gray-600 dark:text-white">
                        <x-leading />
                    </div>
                </x-slot>
            </x-header-page>
            <div class="overflow-x-auto mx-auto w-full">
                <div class="mx-auto w-full" wire:ignore.self>
                    <div wire:ignore.self class="mx-auto" style="width: 500px" id="reader"></div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        Alpine.start();

        document.addEventListener('livewire:init', function() {
            console.log('loaded');

            function onScanSuccess(decodedText, decodedResult) {
                console.log(decodedResult);

                Livewire.dispatch('qrScanned', {
                    employeeId: decodedText
                });
                html5QrcodeScanner.clear();
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 40
                    , qrbox: 250
                    , disableFlip: true
                });
            html5QrcodeScanner.render(onScanSuccess);
        });

        Livewire.on('returnResponse', (event) => {
            const data = event[0];
            swal.fire({
                icon: data.icon
                , title: data.title
                , text: data.text
                , showConfirmButton: false
                , timer: 10000
                , animation: true
            }).then((value) => {
                window.location.reload();
            });
        });

    </script>
    @endpush

</div>
