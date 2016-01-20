<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invitación</title>
</head>
<body>
<h2>Invitación al torneo: {{ $tournament->name }} </h2>

<p>Estimado Kenshi,<br/>

    Estas invitado al torneo: {{ $tournament->name }} <BR/>

    @if ($tournament->venue != null)
        <strong>Lugar:</strong> {{ $tournament->venue }}<br/>
    @endif
    <strong>Fecha:</strong> {{ $tournament->date }}<br/>
    @if ($tournament->cost != null) <strong>Costo:</strong> {{ $tournament->cost }}<br/>@endif
    @if ($tournament->registerDateLimit != null)
        <strong>Fecha Limite de Registro:</strong> {{ $tournament->registerDateLimit }}<br/>
@endif
@if (isset($category))
    <P>Has sido preregistrado en las categoria</P>
    <ul>
            <li>{{$category}}</li>
    </ul>
@else
    Por favor pica el link de pre-registro: <br/>
    <a href='{{getenv('URL_BASE')}}invite/register/{{ $code }}'>{{getenv('URL_BASE')}}invite/register/{{ $code }}</a>
@endif

@if($password!=null)
    <p>Tus datos de conexión son:</p>
    Usuario : {{ $email  }}
    Contraseña: {{ $password }}
@endif

<p>No olvides que se tienen que cubrir las cuotas respectivas a cada categoria para aplicar al sorteo antes del dia {{ $tournament->registerDateLimit }}.</p>

<p>Gracias</p>

<p align="right">{{ $tournament->owner->name  }}</p>
</body>
</html>