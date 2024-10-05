@props(['profil', 'name'])
@if ($profil)
<img class="rounded-circle " src="{{ asset("storage/".$profil) }}" alt="" />
@else
<div class="avatar avatar-m p-1">
    @php
    $n = $name ?? 'User';
    $mots = explode(" ", $n);

    if($mots){
    $n = count($mots) <= 2 ? strtoupper($mots[0][0]) : strtoupper($mots[0][0] . '' . $mots[1][0]); }else{ $n=count($mots) <=2 ? strtoupper($mots[0][0]) : strtoupper($mots[0][0] . '' . $mots[1][0]); } @endphp <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
        <span class="font-medium text-gray-600 dark:text-gray-300">{{ strtoupper($n) }}</span>
</div>
</div>
@endif
