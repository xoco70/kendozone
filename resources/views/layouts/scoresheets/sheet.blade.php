<h1 align="center">{{ $tournament->name }}</h1>

<hr/>
<br/>
<?php
//    $groups = $championship->fightersGroups;
//    $group = $groups->get(0);
if ($championship->category->isTeam()) {
    $fighters = $group->teams;
} else {
    $fighters = $group->competitors;
}

?>


{{--        <p align="center">{{ $tournamentGroup->round }}</p>--}}

{{--{{  Form::model($sheet, ["action" => [$sheet == null ?--}}
{{--"ScoreSheetController@store" :--}}
{{--"ScoreSheetController@update",--}}
{{--$championship->slug], 'class' => 'class="form-horizontal'] ) }}--}}


@include('layouts.scoresheets.header', ['championship'=>$championship, 'group'=> $group])



@include('layouts.scoresheets.competitors', ['fighters'=>$fighters, 'group'=> $group])

{{--End Points--}}
<hr/>

@include('layouts.scoresheets.playoff', ['group'=> $group])