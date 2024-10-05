@extends('layouts.default')
@section('content')
@include('partials.breadcump', ['titre' => "Gestion de demandes des conges pour des agents", 'titre2' => "Gestion de demandes des conges pour des agents"])
@livewire('admin.agents.demages-conges-agents')
@endsection
