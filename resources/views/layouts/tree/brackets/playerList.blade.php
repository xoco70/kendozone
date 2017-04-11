<select name="fights[]">
    <option {{ $selected == '' ? ' selected' : '' }} ></option>
    @if ($treeGen->championship->category->isTeam())
        @foreach ($treeGen->championship->teams as $team)
            @if ($team != null)
                <option {{ $selected != null && $selected->id == $team->id ? ' selected' : '' }}  value="{{$team->id ?? null }}">
                    {{  $team->name }}
                </option>
            @endif
        @endforeach
    @else
        @foreach ($treeGen->championship->competitors as $competitor)
            @if ($competitor != null)
                <option {{ $selected != null && $selected->id == $competitor->id ? ' selected' : '' }}  value="{{$competitor->id ?? null }}">
                    {{  $competitor->getFullName() }}
                </option>
            @endif
        @endforeach
    @endif


</select>

