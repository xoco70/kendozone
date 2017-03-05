<?php

?>
<select name="fights">
    <option {{ $selected == '' ? ' selected' : '' }} ></option>
    @foreach (array_merge($treeGen->brackets[1]) as $bracket)
        @if ($bracket['playerA'] != '')
            <option {{ $selected == $bracket['playerA'] ? ' selected' : '' }}  value= {{$bracket['playerA'] }} >
                {{  $bracket['playerA']  }}
            </option>
        @endif

        @if (  $bracket['playerB'] != '')

            <option {{  $selected ==   $bracket['playerB'] ? ' selected' : '' }} value= {{  $bracket['playerB'] }}>
                {{  $bracket['playerB'] }} </option>
        @endif
    @endforeach
</select>

