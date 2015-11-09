@extends('app')

@section('content')

    <h1> {{ $club->name }}</h1>
    <hr/>
    <article>

        {{ $club->name }}<br/>
        {{ $club->asocId }}

    </article>
@stop