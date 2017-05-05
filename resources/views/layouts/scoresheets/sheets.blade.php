@if (sizeof($championship->fightersGroups)==0)
    {{ trans('core.still_no_scoresheet') }}
@endif
@for ( $i=sizeof($championship->fightersGroups()->get())-1; $i >= 0; $i-- )

    <div class="panel panel-flat page_print">
        <div class="panel-body">
            <div class="container-fluid">
                <?php
                $group = $championship->fightersGroups->get($i);
                $fighters = $group->getFighters();
                ?>
                <h1 align="center">{{ $tournament->name }} - {{ $roundTitles[$group->round -1 ] }}</h1>

                <hr/>
                <br/>

                @include('layouts.scoresheets.header', ['championship'=>$championship, 'group'=> $group])


                @if (sizeof($fighters) == 2)
                    @for ($j=0;$j<4;$j++)
                        <?php
                        $group = $championship->fightersGroups->get($i);
                        if ($group != null) {
                            $fighters = $group->getFighters();

                            if ($j != 3) { // Cancel the last increment
                                $i--;
                            }

                        }
                        ?>
                        @if ($group != null)
                            @include('layouts.scoresheets.competitors_direct_elimination', ['fighters'=>$fighters, 'group'=> $group])
                        @endif
                    @endfor
                    <hr/>
                @else
                    @include('layouts.scoresheets.competitors', ['fighters'=>$fighters, 'group'=> $group])
                    <hr/>
                    @include('layouts.scoresheets.playoff', ['group'=> $group])
                @endif
                {{--End Points--}}
            </div>
        </div>
    </div>
@endfor
