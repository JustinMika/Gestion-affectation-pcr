@extends('layouts.default')
@section('content')
@include('partials.breadcump', ['titre' => "Gestion des acces", 'titre2' => "Gestion des acces"])
@livewire('administration.access')
@endsection
