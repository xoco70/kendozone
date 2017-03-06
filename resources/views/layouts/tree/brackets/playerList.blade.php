<?php

?>
<select name="fights[]">
    <option {{ $selected == '' ? ' selected' : '' }} ></option>
    @foreach (array_merge($treeGen->brackets[1]) as $bracket)
        @if ($bracket['playerA'] != '')
            <option {{ $selected == $bracket['playerA'] ? ' selected' : '' }}  value= {{$bracket['playerA']->id ?? 0 }} >
                {{  $bracket['playerA']->name  ?? "Bye"}}
            </option>
        @endif

        @if (  $bracket['playerB'] != '')

            <option {{  $selected ==   $bracket['playerB'] ? ' selected' : '' }} value= {{  $bracket['playerB']->id ?? 0 }}>
                {{  $bracket['playerB']->name ?? "Bye"}} </option>
        @endif
    @endforeach
</select>

