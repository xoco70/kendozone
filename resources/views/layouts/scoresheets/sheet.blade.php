<div class="panel panel-flat page_print">
    <div class="panel-body">
        <div class="container-fluid">
            <?php


            use Xoco70\KendoTournaments\TreeGen\TreeGen;
            if ($championship->category->isTeam()) {
                $fighters = $group->teamsWithNull();
            } else {
//                $fighters = $group->competitors;
                $fighters = $group->competitorsWithNull();
            }


            if (sizeof($fighters) == 0) {
                $treeGen = new TreeGen($championship, null, null);
                $fighters = $treeGen->createByeGroup(2);
            }


            ?>
            <h1 align="center">{{ $tournament->name }} - {{ $roundTitles[$group->round -1 ] }}</h1>

            <hr/>
            <br/>

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