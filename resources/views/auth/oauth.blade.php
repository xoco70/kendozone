@extends('layouts.dashboard')
@section('content')
    @if (Auth::check() && Auth::user()->isSuperAdmin())
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    @endif
@stop
@section("scripts_footer")
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>
    {!! Html::script('js/oauth.js') !!}
@stop


