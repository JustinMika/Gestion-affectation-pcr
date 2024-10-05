@extends('layouts.default')
@section('content')
@include('partials.breadcump', ['titre' => "Presence des agents", 'titre2' => "Presence des agents"])
@livewire('admin.agents.presence-agents')
@endsection
