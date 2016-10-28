<?php
$tournamentsCreatedQuery = Auth::user()->tournaments();
$tournamentsCreated = $tournamentsCreatedQuery->get();
$tournamentsParticipatedQuery = Auth::user()->myTournaments();
$tournamentsParticipated = $tournamentsParticipatedQuery->get();

?>
<div class="row">
    <div class="col-md-6">
        <div class="row ml-5 mr-10">
            @include('layouts.dashboard.tournamentsCreated')

        </div>
        <div class="row ml-5 mr-10">
            @if (sizeof($tournamentsParticipated) != 0)
                @include('layouts.dashboard.tournamentsRegistered')
            @else
                @include('layouts.dashboard.openInvites')
            @endif
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="row">
            @include('layouts.dashboard.numbers')
        </div>
    </div>

</div>