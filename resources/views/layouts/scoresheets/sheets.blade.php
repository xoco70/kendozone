@if (sizeof($championship->fightersGroups)==0)
    {{ trans('core.still_no_scoresheet') }}
@endif
@foreach ($championship->fightersGroups as $group )

        <div class="panel panel-flat page_print">
            <div class="panel-body">
                <div class="container-fluid">
                    <?php
                    $fighters = $group->getFightersWithBye();
                    ?>
                    <h1 align="center">{{ $tournament->name }} - {{ $roundTitles[$group->round -1 ] }}</h1>

                    <hr/>
                    <br/>

                    @include('layouts.scoresheets.header', ['championship'=>$championship, 'group'=> $group])

                    {{--  Maybe we will have a problem with Cancelling the last increment --}}
                    @if (sizeof($fighters) == 2)
                        @if ($group != null && $group->fights[0]->shouldBeInFightList(true) )
                            @include('layouts.scoresheets.competitors_direct_elimination', ['fighters'=>$fighters, 'group'=> $group])
                        @endif
                    @else
                        @include('layouts.scoresheets.competitors', ['fighters'=>$fighters, 'group'=> $group])
                        @include('layouts.scoresheets.playoff', ['group'=> $group])
                    @endif
                    {{--End Points--}}
                </div>
            </div>
        </div>
@endforeach
