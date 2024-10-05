<div>
    @include('partials.breadcump', ['titre' => "Profil de l'utilisateur", 'titre2' => "Mise à jour des infiormations de l'utilisateur"])

    <div class="w-10/12 mx-auto  grid md:grid-cols-2 sm:grid-cols-1 gap-4 mb-4">
        <section class="grid md:grid-cols-2 sm:grid-cols-1 mx-auto gap-4 p-8 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md w-full">
            <div>
                <div>
                    <h2 class="text-2xl font-semibold mb-6 dark:text-white">Mise a jour des informations de
                        l'utilisateur</h2>
                    <p class="mb-6 dark:text-white">Utilisez une adresse permanente où vous pouvez recevoir du
                        courrier.</p>
                </div>

                <div>
                    <div id="qrcode"></div>
                </div>
            </div>
            <div>
                <div class="flex items-center mb-6">
                    @if(!empty(Auth::user()->profil))
                    <img src="{{ asset('storage/'. Auth::user()->profil) }}" alt="Avatar" class="w-20 h-20 rounded-full mr-4">
                    @else
                    <img src="{{ asset('images/hospital_unigom.png') }}" alt="Avatar" class="w-20 h-20 rounded-full mr-4">
                    @endif
                    <x-button-modal :titre="'Change avatar'" :id="'btn-open-profil'" :modal="'btn-open-profil'" />
                </div>

                <x-form-livewire-template :name="'form_update_profil'" :fonction="'saveProfilInfo'">
                    <div class="flex space-x-4 mb-4">
                        <div class="w-1/2">
                            <x-input-all :type="'text'" :name="'nom_'" :id="'nom_'" :placeholder="'Prénom'" :label="'Prénom'" />
                        </div>
                        <div class="w-1/2">
                            <x-input-all :type="'text'" :name="'phone'" :id="'phone'" :placeholder="'Numéro de téléphone'" :label="'Numéro de téléphone'" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-input-all :type="'text'" :name="'email'" :id="'email'" :placeholder="'Adresse e-mail'" :label="'Adresse e-mail'" />
                    </div>
                    <div class="mb-4">
                        <x-input-all :type="'text'" :name="'adresse'" :id="'adresse'" :placeholder="'Adresse'" :label="'Adresse'" />
                    </div>

                    <x-messages :message="session('success')" :titre="'Info'" :id="'alert-2'" :color="'green'" :hasMessage="Session::has('success')" />
                    <x-messages :message="session('error')" :titre="'Erreur'" :id="'alert-2'" :color="'red'" :hasMessage="Session::has('error')" />
                    <x-submit-button titre="Sauvegarder" />
                </x-form-livewire-template>
            </div>
        </section>

        <section class="grid md:grid-cols-2 sm:grid-cols-1 mx-auto gap-4 p-8 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md w-full">
            <div>
                <h2 class="text-2xl font-semibold mb-6 dark:text-white">Changer le mot de passe</h2>
                <p class="mb-6 dark:text-gray-300">Mettez à jour votre mot de passe associé à votre compte.</p>
            </div>
            <x-form-livewire-template :name="'form_update_profil_updatePasswordUsers'" :fonction="'updatePasswordUsers'">
                <div class="mb-4">
                    <x-input-all :type="'password'" :name="'old_password'" :id="'old_password'" :placeholder="'Mot de passe actuel'" :label="'Mot de passe actuel'" />
                </div>
                <div class="mb-4">
                    <x-input-all :type="'password'" :name="'password'" :id="'password'" :placeholder="'Nouveau mot de passe'" :label="'Nouveau mot de passe'" />
                </div>
                <div class="mb-4">
                    <x-input-all :type="'password'" :name="'new_password'" :id="'new_password'" :placeholder="'Confirmez le mot de passe'" :label="'Confirmez le mot de passe'" />
                </div>

                <x-messages :message="session('_success_')" :titre="'Info'" :id="'alert-2'" :color="'green'" :hasMessage="Session::has('_success_')" />
                <x-messages :message="session('_error_')" :titre="'Erreur'" :id="'alert-2'" :color="'red'" :hasMessage="Session::has('_error_')" />
                <x-submit-button titre="Sauvegarder" />
            </x-form-livewire-template>
        </section>
    </div>

    <x-modal id="btn-open-profil" titre="Changement de l'avatar">
        <x-form-livewire-template :name="'ProfilPhotoUser'" :fonction="'ProfilPhotoUser'">
            <div class="mb-4">
                <x-input-all :type="'file'" :name="'profil'" :id="'profil'" :placeholder="'Votre photo de profil'" :label="'Votre photo de profil'" />
            </div>
            <x-messages :message="session('_success')" :titre="'Info'" :id="'alert-2'" :color="'green'" :hasMessage="Session::has('_success')" />
            <x-messages :message="session('_error')" :titre="'Erreur'" :id="'alert-2'" :color="'red'" :hasMessage="Session::has('_error')" />
            <x-submit-button :titre="'Sauvegarder'" />
        </x-form-livewire-template>
    </x-modal>
    @push('scripts')
        <!-- Inclure la bibliothèque QRCode.js -->
        <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    @endpush

    <script>
        var userId = {{$userId}};
        document.getElementById('qrcode').innerHTML = '';

        // Générer le QR code
        new QRCode(document.getElementById("qrcode"), {
            text: userId.toString(),  // Utiliser l'ID de l'utilisateur
            width: 128,               // Largeur du QR code
            height: 128,              // Hauteur du QR code
        });
    </script>
</div>
