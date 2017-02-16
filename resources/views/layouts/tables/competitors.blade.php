avatar.blade.php<?php
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
<img src="{!! $img !!}" alt="kendozone_avatar">



