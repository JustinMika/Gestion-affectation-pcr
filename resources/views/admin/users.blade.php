@extends('layouts.default')
@section('content')
@include('partials.breadcump', ['titre' => "Utilisateurs", 'titre2' => "Utilisateurs"])
@livewire('administration.users')
@endsection
