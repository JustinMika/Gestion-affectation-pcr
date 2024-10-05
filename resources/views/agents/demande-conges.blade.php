@extends('layouts.default')
@section('content')
@include('partials.breadcump', ['titre' => "Mes demandes des conges", 'titre2' => "Mes demandes des conges"])
@livewire('agents.demande-conges')
@endsection
