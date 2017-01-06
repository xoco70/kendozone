<?php
if (Auth::getUser() != null && Auth::getUser()->avatar != null) {
    $img = Auth::getUser()->avatar;
} else {
    $img = Avatar::create(Auth::getUser()->email)->toBase64();
}
?>
<img src="{!! $img !!}" alt="kendozone_avatar">
