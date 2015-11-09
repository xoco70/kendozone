@extends('app')

@section('content')

    <h1> {{ $competitor->name }}</h1>
    <hr/>
    <article>

        {{ $competitor->shiaiCategoryId }}<br/>
        {{ $competitor->clubId }}

</article>
@stop