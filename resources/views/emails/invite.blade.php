<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invitación</title>
</head>
<body>
<h2>{{ $tournament->user->name  }} te ha invitado al torneo: {{ $tournament->name }} </h2>

<p>Estimado Kenshi,<br/>

    {{ $tournament->user->name  }} te ha invitado al torneo: {{ $tournament->name }} <BR/>
    <strong>Lugar:</strong> {{ $tournament->venue }}<br/>
    <strong>Fecha:</strong> {{ $tournament->date }}<br/>
    <strong>Costo:</strong> {{ $tournament->cost }}<br/>
    <strong>Fecha Limite de Registro:</strong> {{ $tournament->registerDateLimit }}<br/>
    Por favor pica el link de pre-registro: <br/>
    <a href='http://localhost:8888/preregister/token={{ $code }}'>link de preregistro</a>

<p>Gracias</p>
</p>
</body>
</html>