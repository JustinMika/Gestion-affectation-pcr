@extends('layouts.default')
@section('content')
@include('partials.breadcump', ['titre' => "Gestion des utilisateurs", 'titre2' => "Gestion des utilisateurs"])
@livewire('administration.gestion-users')
@endsection
