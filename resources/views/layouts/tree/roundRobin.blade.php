<table class="table-bordered full-width">
    <th class="p-10" width="10%"></th>

    @foreach ( $championship->users as $user)
        <th class="p-10">{{ $user->name }}</th>
    @endforeach

    @foreach ( $championship->users as $user1)
        <tr>
            {{--<td class="p-10">{{$pt->id}}</td>--}}
            <td class="p-10">{{$user1->name}}</td>
            @foreach ( $championship->users as $user2)
                @if ($user1 == $user2)
                    <td width="10%" class="p-10 bg-grey"></td>
                @else
                    <td width="10%" class="p-10"></td>
                @endif


            @endforeach

        </tr>
    @endforeach
</table><br/>