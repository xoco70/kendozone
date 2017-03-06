<?php
use App\Team;
use Xoco70\KendoTournaments\TreeGen\DirectEliminationTreeGen;

$directEliminationTree = $championship->rounds->map(function ($item, $key) use ($championship) {

    if ($championship->category->isTeam()) {
        $byeFighter = new Team([null, 'Bye']);
        $fighter1 = $item->teams->get(0) != null ? $item->teams->get(0) : $byeFighter;
        $fighter2 = $item->teams->get(1) != null ? $item->teams->get(1) : $byeFighter;
    } else {
        $byeFighter = new User([null, 'Bye']);
        $fighter1 = $item->competitors->get(0) != null ? $item->competitors->get(0)->user->name : $byeFighter;
        $fighter2 = $item->competitors->get(1) != null ? $item->competitors->get(1)->user->name : $byeFighter;
    }
    return [$fighter1, $fighter2];
})->toArray();
$directEliminationTree = array_flatten($directEliminationTree);
$treeGen = new DirectEliminationTreeGen($directEliminationTree, "", 1);
?>
@if (Request::is('championships/'.$championship->id.'/pdf'))
    <h1> {{$championship->buildName()}}</h1>
@endif
{!! Form::model(null, ["action" => ["TreeController@update", $championship->id]]) !!}

    {{  $treeGen->printRoundTitles() }}
    <div id="brackets-wrapper">

        @foreach ($treeGen->brackets as $roundNumber => $round)
            @foreach ($round as $matchNumber => $match)

                <div class="match-wrapper"
                     style="top:  {{ $match['matchWrapperTop'] }}px; left:  {{ $match['matchWrapperLeft']  }}px; width: {{   $treeGen->matchWrapperWidth  }}px;">
                    <input type="text"
                           class="score"> @include('layouts.tree.brackets.playerList', ['selected' => $match['playerA']])
                    <div class="match-divider"></div>
                    <input type="text"
                           class="score"> @include('layouts.tree.brackets.playerList', ['selected' => $match['playerB']])
                </div>

                @if ($roundNumber != $treeGen->noRounds)


                    <div class="vertical-connector"
                         style="top: {{  $match['vConnectorTop']  }}px; left: {{  $match['vConnectorLeft']  }}px; height: {{  $match['vConnectorHeight']  }}px;"></div>
                    <div class="horizontal-connector"
                         style="top: {{  $match['hConnectorTop']  }}px; left: {{  $match['hConnectorLeft']  }}px;"></div>
                    <div class="horizontal-connector"
                         style="top: {{  $match['hConnector2Top']  }}px; left: {{  $match['hConnector2Left']  }}px;"></div>
                @endif
            @endforeach
        @endforeach
    </div>
    <button type="submit" class="btn bg-success btn-xs align-bottom-right m-20">
        {{ trans('core.updateModel', ['currentModelName' => trans_choice('core.tree',1)]) }}
    </button>

{!! Form::close() !!}
