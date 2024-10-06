@extends('layouts.default')
@section('content')
    @include('partials.breadcump', ['titre' => "Liste des lieux", 'titre2' => "Liste des lieux"])
    @livewire('admin.affectations.list-lieu-affectation')
@endsection
