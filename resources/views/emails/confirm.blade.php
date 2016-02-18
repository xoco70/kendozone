<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ trans('mail.signup_confirmation') }}</title>
</head>
<body>
<h1>{{ trans('mail.tx_for_signup') }}</h1>

<p>
    {{--//TODO Frase sin traducir--}}
    We just need you to <a href='{{ url("auth/register/confirm/{$user->token}") }}'>confirm your email address</a> real quick!
</p>
</body>
</html>