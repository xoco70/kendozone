<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invitación</title>
</head>
<body>
<h1>{{ $admin  }} te ha invitado al torneo: {{ $tournamentName }} </h1>

<p>
    We just need you to <a href='{{ url("auth/register/confirm/") }}'>confirm your email address</a> real quick!
</p>
</body>
</html>