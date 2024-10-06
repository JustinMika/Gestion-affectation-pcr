@extends('layouts.default')
@section('content')
    {{-- stat --}}
    <x-stat>
        <x-stat-component :data="$user" titre="Nombre total d'agents" icon="stat"/>
        <x-stat-component :data="$present_to_day"
                          titre="Affectations aujourd'hui" icon="stat"/>
        <x-stat-component :data="$conges" titre="Nombre total de lieux d'affectation" icon="stat"/>
        <x-stat-component :data="$conges_" titre="Dernières affectations" icon="stat"/>
    </x-stat>

    {{-- stat --}}
    <x-widget titre="Affectations selom les mois">
        <div id="patientsChart"></div>
    </x-widget>

    <script src="{{  asset("cdn/js/apexcharts.js") }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                series: [{
                    name: 'Patients'
                    , data: @json(array_values($patientsPerMonth))
                }]
                , chart: {
                    type: "area"
                    , height: "450px"
                    , fontFamily: "Inter, sans-serif"
                    , foreColor: "#4B5563"
                    , toolbar: {
                        show: 1
                    }
                }
                , xaxis: {
                    categories: @json(array_keys($patientsPerMonth))
                }
            };
            var patientsChart = new ApexCharts(document.querySelector("#patientsChart"), options);
            patientsChart.render();
        });

    </script>
@endsection
