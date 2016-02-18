    {!! Form::model($tournament, ['method'=>"DELETE", "action" => ["TournamentController@update", $tournament->id]]) !!}
    {{--TODO Falta traducir--}}

    @include("tournaments.form", ["submitButton" => "Actualizar Torneo"])


    {!! Form::close()!!}

    @include("errors.list")
@stop