<div align="center">

    @if (Request::is('championships/'.$championship->id.'/pdf'))
        <h1> {{$championship->category->buildName($grades)}}</h1>
    @endif
    @foreach($championship->tree->groupBy('area') as $ptByArea)
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th class="p-10">{{ trans_choice('categories.fightingArea',1) }}</th>
                <th class="p-10"></th>
                <th class="p-10">{{trans_choice('core.competitor',1)}} 1</th>
                <th class="p-10"></th>
                <th class="p-10">{{trans_choice('core.competitor',1)}} 2</th>
                <th class="p-10"></th>
                <th class="p-10">{{trans_choice('core.competitor',1)}} 3</th>
            </tr>
            {{--@if ($championship->settings!= null && $championship->settings->preliminaryGroupSize>3)--}}
            {{--<th class="p-10">Competidor 4</th>--}}
            {{--@endif--}}
            {{--@if ($championship->settings!= null && $championship->settings->preliminaryGroupSize==5)--}}
            {{--<th class="p-10">Competidor 5</th>--}}
            {{--@endif--}}

            @foreach($ptByArea as $pt)

                <tr>
                    <td class="p-10">{{$pt->area}}</td>
                    <td class="p-10">a</td>
                    <td class="p-10">{{$pt->user1!= null ? $pt->user1->name : ''}}</td>
                    <td class="p-10">b</td>
                    <td class="p-10">{{$pt->user2!= null ? $pt->user2->name : ''}}</td>
                    <td class="p-10">c</td>
                    <td class="p-10">{{$pt->user3!= null ? $pt->user3->name : ''}}</td>

                    {{--@if ($championship->settings!= null && $championship->settings->preliminaryGroupSize>3)--}}
                    {{--<td class="p-10">{{$pt->user4!= null ? $pt->user4->name : ''}}</td>--}}
                    {{--@endif--}}
                    {{--@if ($championship->settings!= null && $championship->settings->preliminaryGroupSize==5)--}}
                    {{--<td class="p-10">{{$pt->user5!= null ? $pt->user5->name : ''}}</td>--}}
                    {{--@endif--}}
                </tr>
            @endforeach
        </table><br/>
    @endforeach
</div>
