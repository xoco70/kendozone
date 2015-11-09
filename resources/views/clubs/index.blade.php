@extends('layouts.dashboard')

@section('content')

    <h1>Clubs</h1>
    <hr/>
    @foreach($clubs as $club)
        <article>
            <h2>
                <a href="{{url('clubs', $club->id)}}"> {{ $club->name }}</a></h2>

            <div class="body">
                {{ $club->asocId }}
            </div>
        </article>
    @endforeach
@stop