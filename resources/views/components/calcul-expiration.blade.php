@props(['futureDate'])

@php
// Convertissez les chaînes de caractères en objets DateTime
$dateActuelleObj = new DateTime(date("Y-m-d"));
$dateFutureObj = new DateTime(date("Y-m-d", strtotime($futureDate)));

// Obtenez la différence entre les deux dates
$diff = $dateActuelleObj->diff($dateFutureObj);

// Calculez la durée restante en mois
$dureeMoisRestants = ($diff->y * 12) + $diff->m;

// on recupere les annees
$nombreAnnee = $diff->y;

// Récupérez le nombre de mois
$nombreMois = $diff->m;

// Récupérez le nombre de jours
$nombreJours = $diff->d;
@endphp

@if ($dureeMoisRestants <= 6)
    @if(!empty($nombreMois) && !empty($nombreJours))
        <p class="text-red-700 font-bold text-wrap">{{"Il reste {$nombreMois} mois et {$nombreJours} jours"}}</p>
    @elseif(!empty($nombreMois) && empty($nombreJours))
        <p class="text-red-700 font-bold text-wrap">{{"Il reste {$nombreMois} mois"}}</p>
    @elseif(empty($nombreMois) && !empty($nombreJours))
        @if($nombreJours <= 1)
            <p class="text-red-700 font-bold text-wrap">{{"Il reste {$nombreJours} jour"}}</p>
        @else
            <p class="text-red-700 font-bold text-wrap">{{"Il reste {$nombreJours} jours"}}</p>
        @endif
    @else
        <p class="text-red-700 font-bold text-wrap">{{"Il reste {$nombreJours} jours"}}</p>
    @endif
@else
    @if(!empty($nombreAnnee) && !empty($nombreMois) && !empty($nombreJours))
        <p class="text-green-700 font-bold">{{  "Il reste {$nombreAnnee} ans, {$nombreMois} mois et {$nombreJours} jours" }}</p>
    @else
        @if(empty($nombreAnnee) && !empty($nombreMois) && !empty($nombreJours))
            <p class="text-green-700 font-extrabold">{{  "Il reste {$nombreMois} mois et {$nombreJours} jours" }}</p>
        @elseif(!empty($nombreAnnee) && empty($nombreMois) && !empty($nombreJours))
            <p class="text-green-700 font-extrabold">{{  "Il reste {$nombreAnnee} ans et {$nombreJours} jours" }}</p>
        @elseif(!empty($nombreAnnee) && !empty($nombreMois) && empty($nombreJours))
            <p class="text-green-700 font-extrabold">{{  "Il reste {$nombreAnnee} ans et {$nombreMois} mois" }}</p>
        @elseif(!empty($nombreAnnee) && empty($nombreMois) && empty($nombreJours))
            <p class="text-green-700 font-extrabold">{{  "Il reste {$nombreAnnee} année" }}</p>
        @endif
    @endif
@endif
