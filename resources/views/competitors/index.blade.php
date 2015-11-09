@extends('layouts.dashboard')

@section('content')

    <h1>Competidores</h1>
    <hr/>
    @foreach($competitors as $competitor)
        <article>
            <h2>
                <a href="{{url('competitors', $competitor->id)}}"> {{ $competitor->name }}</a></h2>

            <div class="body">
                {{ $competitor->userId }}
            </div>
            <div class="body">
                {{ $competitor->shiaiCategoryId }}

            </div>
            <div class="body">
                {{ $competitor->clubId }}

            </div>

        </article>
    @endforeach
@stop