<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ trans('mail.signup_confirmation') }}</title>
</head>
<body>
<h1>{{ trans('mail.tx_for_signup') }}</h1>

{{ trans('mail.please_click_link_to_confirm_account') }}
<p>
    <a href="{{url("auth/register/confirm/{$user->token}")}}">{{ url("/register/confirm/{$user->token}") }}</a>
</p>
</body>
</html>