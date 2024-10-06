@extends('layouts.default')
@section('content')
    @include('partials.breadcump', ['titre' => "Affectation des agents", 'titre2' => "Affectation des agents"])
    @livewire('admin.affectations.affecter-agents-pcr')
@endsection
