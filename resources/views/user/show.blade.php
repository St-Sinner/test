@extends('adminlte::page')

@section('title', 'User {{ $user->id }}')

@section('content_header')
    <h1>User {{ $user->id }}</h1>
@stop
@section('content')
    <div class="card-body">

        <a href="{{ url('/user') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
        <a href="{{ url('/user/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

        <form method="POST" action="{{ url('user' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
        </form>
        <br/>
        <br/>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                <tr>
                    <th>ID</th><td>{{ $user->id }}</td>
                </tr>
                <tr><th> {{ trans('user.name') }} </th><td> {{ $user->name }} </td></tr><tr><th> {{ trans('users.email') }} </th><td> {{ $user->email }} </td></tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection
