@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
    @hasrole('admin')
        <h2>Admin</h2>
    @else
        <h2>asoiudasuoid</h2>
    @endhasrole
@stop

@section('content')
    <p>You are logged in!</p>
@stop