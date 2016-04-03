{!! Form::model($tournament, ['method'=>"DELETE", "action" => ["TournamentController@update", $tournament->id]]) !!}

@include("tournaments.form", ["submitButton" => trans('core.updateModel', ['currentModelName' => trans_choice('core.tournament',1)])])


{!! Form::close()!!}

@include("errors.list")
@stop