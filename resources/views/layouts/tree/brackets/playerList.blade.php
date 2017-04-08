<?php

$brackets = array_merge_recursive($treeGen->brackets);
$brackets = array_collapse($brackets);

?>
<select name="fights[]">
    <option {{ $selected == '' ? ' selected' : '' }} ></option>
    @foreach ($brackets as $bracket)
        @if ($bracket['playerA'] != '')
            <option {{ $selected == $bracket['playerA'] ? ' selected' : '' }}  value="{{$bracket['playerA']->id ?? null }}">
                {{  $bracket['playerA']->getName() }}
            </option>
        @endif

        @if (  $bracket['playerB'] != '')

            <option {{  $selected ==   $bracket['playerB'] ? ' selected' : '' }} value="{{  $bracket['playerB']->id ?? null }}">
                {{  $bracket['playerB']->getName() }} </option>
        @endif
    @endforeach
</select>

