<div class="panel panel-flat">
    <div class="panel-body">
        <div class="container-fluid">

            <div class="page_print">
                <h1 align="center">{{ $tournament->name }}</h1>

                <hr/>
                <br/>
                <?php
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
            </div>
        </div>
    </div>
</div>