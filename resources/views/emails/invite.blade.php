<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invitación</title>
</head>
<body>
<h2>{{ $tournament->owner->name  }} te ha invitado al torneo: {{ $tournament->name }} </h2>

<p>Estimado Kenshi,<br/>

    {{ $tournament->owner->name  }} te ha invitado al torneo: {{ $tournament->name }} <BR/>
    <strong>Lugar:</strong> {{ $tournament->venue }}<br/>
    <strong>Fecha:</strong> {{ $tournament->date }}<br/>
    <strong>Costo:</strong> {{ $tournament->cost }}<br/>
    <strong>Fecha Limite de Registro:</strong> {{ $tournament->registerDateLimit }}<br/>
    Por favor pica el link de pre-registro: <br/>
    <a href='http://localhost:8888/invite/register/{{ $code }}'>http://localhost:8888/invite/register/{{ $code }}</a>

<p>Gracias</p>
</body>
</html>