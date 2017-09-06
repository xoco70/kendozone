<!-- Footer -->
<?php
?>
<div class="bg-primary my-footer p-20 full-width"
     @if($championship->isSingleEliminationType() && !$championship->hasPreliminary()) style="top: {{ $championship->fights->count() *2 *70}}px" @endif >
    &copy; {{ date("Y") }}. <a href="https://kendozone.com" class="text-white text-bold">{{ config('app.name') }}</a>
</div>
<!-- /footer -->