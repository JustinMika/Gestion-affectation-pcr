@extends('layouts.default')
@section('content')
    @include('partials.breadcump', ['titre' => "Liste des affectations", 'titre2' => "Liste des affectations"])
    @livewire('admin.affectations.lieu-affectation')
@endsection
