@extends('protected.admin.master')

@section('title', 'Admin Dashboard')

@section('content')

    @if (session()->has('flash_message'))
            <p>{{ session()->get('flash_message') }}</p>
    @endif


    <div class="jumbotron">
        <h1>Admin Page</h1>
        <p>This page is for admins only!</p>
    </div>


@endsection