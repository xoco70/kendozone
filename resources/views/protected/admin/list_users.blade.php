@extends('protected.admin.master')

@section('title', 'List Users')

@section('content')

<h2>Registered Users</h2>
    <p>Here you would normally search for users but since this is just a demo, I'm listing all of them.</p>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
              <th>id</th>
              <th>Email</th>
              <th>First Name</th>
              <th>Last Name</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="profiles/{{ $user->id }}">{{ $user->email }}</a> <br>
                @if ($user->inRole($admin))
                <span class="label label-success">{{ 'Admin' }}</span>
                @endif
                </td>
                <td>{{ $user->first_name}}</td>
                <td>{{ $user->last_name}}</td>
             </tr>
            @endforeach

        </tbody>
    </table>

@stop