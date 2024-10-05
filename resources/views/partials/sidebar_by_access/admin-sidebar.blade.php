{{-- dashboard --}}
<li>
    <a href="{{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY") }}"
       class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
        <svg
            class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
        </svg>
        <span class="ml-3">Tableau de Bord</span>
    </a>
</li>

{{-- Gestion des employés --}}
<li class="_hidden_">
    <button type="button"
            class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
            aria-controls="gestion_pcr" data-collapse-toggle="gestion_pcr">
        <svg data-slot="icon" aria-hidden="true" fill="none" stroke-width="1.5" stroke="currentColor"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
             class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
            <path
                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"
                stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <span class="flex-1 ml-3 text-left whitespace-nowrap">Gestion des PCR</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
        </svg>
    </button>
    <ul id="gestion_pcr" class="space-y-2 py-2 hidden ">
        <li>
            <a href=" {{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/users") }}"
               class=" text-sm text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Ajouter
                un nouvel agent</a>
        </li>
        <li>
            <a href=" {{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/gestion-users") }}"
               class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Liste
                des agents</a>
        </li>
    </ul>
</li>

{{-- Gestion des Lieux --}}
<li class="_hidden_">
    <button type="button"
            class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
            aria-controls="lieu_affectations_" data-collapse-toggle="domaine_">
        <svg data-slot="icon" aria-hidden="true" fill="none" stroke-width="1.5" stroke="currentColor"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
             class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
            <path
                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"
                stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <span class="flex-1 ml-3 text-left whitespace-nowrap">Gestion des Lieux</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
        </svg>
    </button>
    <ul id="lieu_affectations_" class="space-y-2 py-2 hidden ">
        <li>
            <a href=" {{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/users") }}"
               class=" text-sm text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700">Ajouter
                un nouveau lieu d'affectation</a>
        </li>
        <li>
            <a href=" {{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/gestion-users") }}"
               class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Modifier
                ou supprimer un lieu</a>
        </li>
    </ul>
</li>

{{-- Affectation des Agents --}}
<li class="_hidden_">
    <button type="button"
            class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
            aria-controls="affectation_agents" data-collapse-toggle="domaine_">
        <svg data-slot="icon" aria-hidden="true" fill="none" stroke-width="1.5" stroke="currentColor"
             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
             class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
            <path
                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"
                stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <span class="flex-1 ml-3 text-left whitespace-nowrap">Affectation des Agents</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
        </svg>
    </button>
    <ul id="affectation_agents" class="space-y-2 py-2 hidden ">
        <li>
            <a href=" {{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/users") }}"
               class=" text-sm text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700">Affecter
                un agent à un lieu</a>
        </li>
        <li>
            <a href=" {{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/gestion-users") }}"
               class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Voir
                les affectations existantes</a>
        </li>
    </ul>
</li>

{{--Rapports--}}
<li class="_hidden_">
    <button type="button"
            class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
            aria-controls="rapport_" data-collapse-toggle="rapport_">
        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
             fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                  d="M9.586 2.586A2 2 0 0 1 11 2h2a2 2 0 0 1 2 2v.089l.473.196.063-.063a2.002 2.002 0 0 1 2.828 0l1.414 1.414a2 2 0 0 1 0 2.827l-.063.064.196.473H20a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-.089l-.196.473.063.063a2.002 2.002 0 0 1 0 2.828l-1.414 1.414a2 2 0 0 1-2.828 0l-.063-.063-.473.196V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.089l-.473-.196-.063.063a2.002 2.002 0 0 1-2.828 0l-1.414-1.414a2 2 0 0 1 0-2.827l.063-.064L4.089 15H4a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h.09l.195-.473-.063-.063a2 2 0 0 1 0-2.828l1.414-1.414a2 2 0 0 1 2.827 0l.064.063L9 4.089V4a2 2 0 0 1 .586-1.414ZM8 12a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z"
                  clip-rule="evenodd"/>
        </svg>
        <span class="flex-1 ml-3 text-left whitespace-nowrap">Rapports</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
        </svg>
    </button>
    <ul id="rapport_" class="space-y-2 py-2 hidden ">
        <li>
            <a href="{{ route('rapport.list_agents') }}"
               class=" text-sm text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Liste
                des PCR</a>
        </li>
        <li>
            <a href="{{ route('rapport.rapport_presence')  }}"
               class=" text-sm text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Rapport
                des affectations</a>
        </li>
        <li>
            <a href=" {{ route('rapport.agent_en_conges')  }}"
               class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700">Agents
                en conges</a>
        </li>
    </ul>
</li>

{{-- Administration --}}
<li class="_hidden_">
    <button type="button"
            class="flex items-center w-full p-2 text-sm text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
            aria-controls="administration" data-collapse-toggle="administration">
        <svg
            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
            viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                  d="M9.586 2.586A2 2 0 0 1 11 2h2a2 2 0 0 1 2 2v.089l.473.196.063-.063a2.002 2.002 0 0 1 2.828 0l1.414 1.414a2 2 0 0 1 0 2.827l-.063.064.196.473H20a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-.089l-.196.473.063.063a2.002 2.002 0 0 1 0 2.828l-1.414 1.414a2 2 0 0 1-2.828 0l-.063-.063-.473.196V20a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2v-.089l-.473-.196-.063.063a2.002 2.002 0 0 1-2.828 0l-1.414-1.414a2 2 0 0 1 0-2.827l.063-.064L4.089 15H4a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h.09l.195-.473-.063-.063a2 2 0 0 1 0-2.828l1.414-1.414a2 2 0 0 1 2.827 0l.064.063L9 4.089V4a2 2 0 0 1 .586-1.414ZM8 12a4 4 0 1 1 8 0 4 4 0 0 1-8 0Z"
                  clip-rule="evenodd"/>
        </svg>
        <span class="flex-1 ml-3 text-left whitespace-nowrap">Administration</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
        </svg>
    </button>
    <ul id="administration" class="space-y-2 py-2 hidden ">
        <li>
            <a href="{{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/access") }}"
               class=" text-sm text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Rôles</a>
        </li>
        <li>
            <a href="{{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/gestion-users") }}"
               class=" text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Gestion
                des comptes</a>
        </li>
        <li>
            <a href="{{ url("Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY/administration/log-users") }}"
               class=" text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700 ">Journal
                d'activité des utilisateurs</a>
        </li>
    </ul>
</li>
