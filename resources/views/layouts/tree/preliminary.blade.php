<table class="table-bordered">
    {{--<th class="p-10">ID</th>--}}
    <th class="p-10">{{ trans_choice('categories.fightingArea',1) }}</th>
{{--    @if ($pt->user1->federation!=null)<th class="p-10"></th> @endif--}}
    <th class="p-10"></th>
    <th class="p-10">{{trans_choice('core.competitor',1)}} 1</th>
    {{--<th class="p-10"></th>--}}
    <th class="p-10"></th>
    <th class="p-10">{{trans_choice('core.competitor',1)}} 2</th>
    {{--<th class="p-10"></th>--}}
    <th class="p-10"></th>
    <th class="p-10">{{trans_choice('core.competitor',1)}} 3</th>

    @if ($championship->settings!= null && $championship->settings->preliminaryGroupSize>3)
        <th class="p-10">Competidor 4</th>
    @endif
    @if ($championship->settings!= null && $championship->settings->preliminaryGroupSize==5)
        <th class="p-10">Competidor 5</th>
    @endif
    @foreach($ptByArea as $pt)
        <tr>
            <td class="p-10">{{$pt->area}}</td>
            {{--<th class="p-10">MXN</th>--}}
            <th class="p-10">a</th>
            <td class="p-10">{{$pt->user1!= null ? $pt->user1->name : ''}}</td>
            {{--<th class="p-10">AAA</th>--}}
            <th class="p-10">b</th>
            <td class="p-10">{{$pt->user2!= null ? $pt->user2->name : ''}}</td>
            {{--<th class="p-10">BBB</th>--}}
            <th class="p-10">c</th>
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