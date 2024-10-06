@extends('layouts.default')
@section('content')
    @include('partials.breadcump', ['titre' => "Gestion des lieux d'affectations", 'titre2' => "Gestion des lieux d'affectations"])
    @livewire('admin.affectations.add-lieu-affectation')
@endsection
