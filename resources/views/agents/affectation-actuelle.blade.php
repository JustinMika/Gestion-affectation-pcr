@extends('layouts.default')
@section('content')
    @include('partials.breadcump', ['titre' => "Affectation actuelle", 'titre2' => "Affectation actuelle:: le ".date("d-m-Y")])
    <section class="bg-gray-50 dark:bg-gray-900 ">
        <div class="max-w-screen-xl px-4 mx-auto lg:px-12 w-1/2 mx-auto">
            <x-messages :message="session('_error_')" :titre="'Info'" :id="'alert-2'" :color="'blue'"
                        :hasMessage="Session::has('_error_')"/>
            {{-- table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">No</th>
                        <th scope="col" class="px-4 py-3">Lieu d'affectation</th>
                        <th scope="col" class="px-4 py-3">Date</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($affectation ?? []) > 0)
                        @foreach ($affectation as $c)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-100/10">
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace- dark:text-white">1</td>
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace- dark:text-white">{{ $c->lieuAffectation->lieu }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace- dark:text-white">{{ date('d-m-Y', strtotime($c->created_at)) }}</td>
                            </tr>
                        @endforeach
                    @else
                        <div id="alert-border-1"
                             class="flex items-center p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800"
                             role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <div class="ms-3 text-sm font-medium">
                                Vous n'etes pas encore affecter. Veuillez contacter votre administrateur pour plus
                                d'informations.
                            </div>
                            <button type="button"
                                    class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                                    data-dismiss-target="#alert-border-1" aria-label="Close">
                                <span class="sr-only">Dismiss</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
