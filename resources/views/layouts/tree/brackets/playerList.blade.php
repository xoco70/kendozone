<select name="fights[]">
    <option {{ $selected == '' ? ' selected' : '' }} ></option>
    @foreach ($treeGen->championship->competitors as $competitor)
        @if ($competitor != null)
            <option {{ $selected != null && $selected->id == $competitor->id ? ' selected' : '' }}  value="{{$competitor->id ?? null }}">
                {{  $competitor->getFullName() }}
            </option>
        @endif
    @endforeach
</select>

