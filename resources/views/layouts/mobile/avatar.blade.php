<?php
$user = Auth::user();
if (
    isset($user) &&
    $user != null &&
    $user->avatar != null) {
    $img = $user->avatar;
} else {
    $img = Avatar::create($user->email)->toBase64();
}
?>

<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <img src="{!! $img !!}" alt="kendozone_avatar">
</a>
@include('layouts.menus.top.user')
