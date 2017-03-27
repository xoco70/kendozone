<?php
$brackets = array_merge($treeGen->brackets[1]);

?>
<select name="fights[]">
    <option {{ $selected == '' ? ' selected' : '' }} ></option>
    @foreach ($brackets as $bracket)


        @if ($bracket['playerA'] != '')
            <option {{ $selected == $bracket['playerA'] ? ' selected' : '' }}  value= {{$bracket['playerA']->id ?? null }} >
                {{  $bracket['playerA']  ?? "Bye"}}
            </option>
        @endif

        @if (  $bracket['playerB'] != '')

            <option {{  $selected ==   $bracket['playerB'] ? ' selected' : '' }} value= {{  $bracket['playerB']->id ?? null }}>
                {{  $bracket['playerB'] ?? "Bye"}} </option>
        @endif
    @endforeach
</select>

