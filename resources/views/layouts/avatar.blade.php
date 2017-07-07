<?php
$user = Auth::user();
//dd(App\User::find(1)->avatar);
if (
    isset($user) &&
    $user != null &&
    $user->avatar != null) {
    $img = $user->avatar;
} else {
    $img = Avatar::create($user->email)->toBase64();
}
//dd(Auth::user())
?>
<img src="{!! $img !!}" alt="kendozone_avatar">



