@extends('master')

@section('title', 'Home')

@section('content')

    <div class="jumbotron">
        <h1>Landing Page</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia perferendis id odit laudantium non blanditiis debitis repellat nulla accusamus cupiditate unde.</p>

        @if (!Sentinel::check())
        <p>
            <a href="{{ url('login') }}" class="btn btn-success btn-lg" role="button">Login</a> or <a href="{{ url('register') }}" class="btn btn-primary btn-lg" role="button">Register</a>
        </p>
        @endif
    </div>

@endsection