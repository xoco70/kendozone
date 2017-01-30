<table class="table-bordered full-width">
    <th class="p-10" width="10%"></th>

    <?php
    if ($championship->category->isTeam) {
        $users = $championship->teams;
    } else {
        $users = $championship->users;
    }
    ?>
    @foreach ( $users as $user)
        <th class="p-10">{{ $user->name }}</th>
    @endforeach
    <th class="p-10" width="10%">W</th>
    <th class="p-10" width="10%">L</th>
    <th class="p-10" width="10%">P</th>

    @foreach ( $users as $user1)
        <tr>
            <td class="p-10">{{$user1->name}}</td>
            @foreach ( $users as $user2)
                @if ($user1 == $user2)
                    <td width="10%" class="p-10 bg-grey"></td>
                @else
                    <td width="10%" class="p-10"></td>
                @endif
            @endforeach
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    @endforeach
</table><br/>