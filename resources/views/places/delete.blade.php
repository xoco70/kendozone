@include("errors.list")
    {!! Form::model($tournament, ['method'=>"DELETE", "action" => ["TournamentController@update", $tournament->id]]) !!}

    @include("tournaments.form", ["submitButton" => "Actualizar Torneo"])


    {!! Form::close()!!}


@stop