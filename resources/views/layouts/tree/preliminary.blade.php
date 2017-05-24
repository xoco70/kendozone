<div align="center">
    @if (Request::is('championships/'.$championship->id.'/tree/pdf'))
        <h1> {{$championship->buildName()}}</h1>
    @endif
    @foreach($championship->groupsByRound(1)->get()->groupBy('area') as $groupsByArea)
        <table class="table-bordered" cellpadding="5" cellspacing="0">
            <tr>
                <th class="p-10">{{ trans_choice('categories.fightingArea',1) }}</th>
                <th class="p-10"></th>
                <th class="p-10">{{trans_choice('core.competitor',1)}} 1</th>
                <th class="p-10"></th>
                <th class="p-10">{{trans_choice('core.competitor',1)}} 2</th>
                <th class="p-10"></th>
                <th class="p-10">{{trans_choice('core.competitor',1)}} 3</th>
                @if ($championship->settings!= null && $championship->settings->preliminaryGroupSize > 3)
                    <th class="p-10"></th>
                    <th class="p-10">{{trans_choice('core.competitor',1)}} 4</th>
                @endif
                @if ($championship->settings!= null && $championship->settings->preliminaryGroupSize > 4)
                    <th class="p-10"></th>
                    <th class="p-10">{{trans_choice('core.competitor',1)}} 5</th>
                @endif
            </tr>

            @foreach($groupsByArea as $group)
                <?php
                $names = $group->fighters()->map->name;
                $letter = 'a';
                ?>
                <tr>
                    <td class="p-10">{{$group->area}}</td>
                    @foreach ($names as $name)
                        <td class="p-10">{{ $letter++ }}</td>
                        <td class="p-10">{{ $name }}</td>
                    @endforeach
                </tr>
            @endforeach

        </table><br/>
    @endforeach
</div>
