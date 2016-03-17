{!! Form::model($tournament, ['method'=>"DELETE", "action" => ["TournamentController@update", $tournament->id]]) !!}

@include("tournaments.form", ["submitButton" => trans('crud.updateModel', ['currentModelName' => trans_choice('crud.tournament',1)])])


{!! Form::close()!!}

@include("errors.list")
@stop