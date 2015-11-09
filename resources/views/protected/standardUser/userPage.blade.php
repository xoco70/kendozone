@extends('master')

@section('title', 'Registered Users')

@section('content')

    @if (session()->has('flash_message'))
            <p>{{ session()->get('flash_message') }}</p>
    @endif

    @if (Sentinel::check())
        <p>{{ "Welcome, " . Sentinel::getUser()->first_name }}</p>
    @endif

    <p>This is for standard users only!</p>

@endsection