@extends('layouts.default')
@section('content')
    <div class="flex flex-col justify-center items-center px-6 mx-auto h-screen- h-[500px] xl:px-0 dark:bg-gray-900">
        <div class="block md:max-w-lg">
            <img src="{{ asset("images/404.svg") }}" alt="404">
        </div>
        <div class="text-center xl:max-w-4xl">
            <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">Page
                non trouvée</h1>
            <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">Oops! On dirait que vous
                avez suivi un mauvais lien. Si vous pensez qu'il s'agit d'un problème chez nous, dites-le-nous.</p>
            <a href="{{ route('Cr9ka3q4Ho16X1E6Z0EDmlHQVuCY') }}"
               class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-3 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
                Retourner à la page d'accueil
            </a>
        </div>
    </div>
@endsection
