## message session
```html
<x-messages :message="session('success')" :titre="'Info'" :id="'alert-2'" :color="'green'" :hasMessage="Session::has('success')" />
<x-messages :message="session('error')" :titre="'Erreur'" :id="'alert-2'" :color="'red'" :hasMessage="Session::has('error')" />
```

## fenetre modal
``` html
<x-modal id="modal-add-medicament" :titre="'Ajout des medicaments'">
    <x-form-livewire-template :name="'name'" :fonction="'AddMedicament'">
        <x-input-all :type="'text'" :name="'designation'" :id="'designation'" :placeholder="'designation'" :label="'designation'" />
        <x-input-all :type="'text'" :name="'dossage'" :id="'dossage'" :placeholder="'dossage'" :label="'dossage'" />
        <x-input-all :type="'text'" :name="'forme'" :id="'forme'" :placeholder="'forme'" :label="'forme'" />
        <x-input-all :type="'text'" :name="'conditionnement'" :id="'conditionnement'" :placeholder="'Conditionnement'" :label="'Conditionnement'" />
        <x-input-all :type="'text'" :name="'code'" :id="'code'" :placeholder="'Code'" :label="'Code'" />
        <x-submit-button :titre="'Enregistrer'" />
    </x-form-livewire-template>
</x-modal>
```
## message
```html
<x-messages :message="session('_error_')" :titre="'Info'" :id="'alert-2'" :color="'blue'" :hasMessage="Session::has('_error_')" />
```

#### Header

```html
<x-header-page>
    <x-slot name="left">
        <x-input-search-icon :id="'search-input'" :name="'search_input'" :placeholder="'Search ...'" />
    </x-slot>
    <x-slot name="right">
        <div class="flex gap-3">
            <x-button-modal :titre="'Ajouter un medicament'" :id="'btn-open-modal'" :modal="'modal-add-medicament'" />
            <x-button-link :titre="'Aprovionner le stock'" :link="route('Etat-de-besoin/creer')" :icon="'add'" />
            <x-dropdown-link :titre="'Rapport'" :data="['1'=>'Fiche de stock', 'm' => 'medicaments', 'exp' => 'Medicaments expires']" />
        </div>
    </x-slot>
</x-header-page>
```

## submit button
```html
<x-submit-button :titre="'Enregistrer'" />
```

#### Buttons
```html
<x-button-modal :titre="'Ajouter un medicament'" :id="'btn-open-modal'" :modal="'modal-add-medicament'" />
<x-button-link :titre="'Aprovionner le stock'" :link="route('Etat-de-besoin/creer')" :icon="'add'" />
<x-dropdown-link :titre="'Rapport'" :data="['1'=>'Fiche de stock', 'm' => 'medicaments', 'exp' => 'Medicaments expires']" />
```
