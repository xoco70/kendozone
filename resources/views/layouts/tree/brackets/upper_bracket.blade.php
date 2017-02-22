<?php
$default_top1 =30;
$default_top2 =81;

$top1 = $default_top1 + ($numGroup-1) * 204;
$top2 = $default_top2 + ($numGroup-1) * 204;
?>
<div class="vertical-connector" style="top: {{ $top1 }}px; left: 168px; height: 54px;"></div>

<div class="horizontal-connector" style="top: {{ $top1 }}px; left: 150px;"></div>
<div class="horizontal-connector" style="top: {{ $top2}}px; left: 170px;"></div>
