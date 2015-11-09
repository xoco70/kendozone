@extends('protected.admin.master')

@section('title', 'View Profile')

@section('content')

    <h1>{{ $user->first_name }}'s Profile</h1>
    <ul>
        <li>Account Type: {{ $user_role }}</li>
        <li>Email Address: {{ $user->email }}</li>
        <li>First Name: {{ $user->first_name }}</li>
        <li>Last Name: {{ $user->last_name }}</li>
    </ul>

    @if(Sentinel::check())
        <a href='{{ $user->id }}/edit' class='btn btn-primary'>Edit Profile</a>
    @endif

@endsection