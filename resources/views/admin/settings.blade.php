@extends('adminlte::page')


@section('title', 'Settings')

@section('content_header')
    <h1> {{$user->name}} </h1>
@stop

@section('content')
    ID: {{$user->id}} </br>
    E-Mail: {{$user->email}} </br>
    Last update: {{$user->updated_at}} </br>
@stop
