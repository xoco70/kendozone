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
            @include('layouts.dashboard.openTournaments')
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="row">
            @include('layouts.dashboard.numbers')
        </div>
    </div>

</div>