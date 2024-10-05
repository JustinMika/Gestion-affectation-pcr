@extends('layouts.default')
@section('content')
@include('partials.breadcump', ['titre' => "Mes presences", 'titre2' => "Mes presences"])
@livewire('agents.mes-presences')
@endsection
