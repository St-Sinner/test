@extends('adminlte::page')

@section('title', 'Edit User #{{ $user->id }}')

@section('content_header')
    <h1>Edit User #{{ $user->id }}</h1>
@stop
@section('content')

    <div class="card-body">
        <a href="{{ url('/user') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
        <br />
        <br />

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ url('/user/' . $user->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            @include ('user.form', ['formMode' => 'edit'])

        </form>

    </div>
@endsection
