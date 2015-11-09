    {!! Form::model($tournament, ['method'=>"DELETE", "action" => ["TournamentController@update", $tournament->id]]) !!}

    @include("tournaments.form", ["submitButton" => "Actualizar Torneo"])


    {!! Form::close()!!}

    @include("errors.list")
@stop