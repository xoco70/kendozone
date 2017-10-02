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
<img src="{!! asset('storage'.$img) !!}" alt="kendozone_avatar">



