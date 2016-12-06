<?php
$directEliminationTree = $championship->tree->map(function ($item, $key) {
    $user1 = $item->user1 != null ? $item->user1->name : "Bye";
    $user2 = $item->user2 != null ? $item->user2->name : "Bye";
    return [$user1, $user2];
})->toArray();
?>
@if (Request::is('championships/'.$championship->id.'/pdf'))
    <h1> {{$championship->category->buildName($grades)}}</h1>
@endif

<div id="brackets_{{ $championship->id }}"></div>
<script>
    var minimalData_{{ $championship->id }} = {!!     json_encode([ 'teams' => $directEliminationTree ] ) !!};
</script>
