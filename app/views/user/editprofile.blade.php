@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>Editar perfil</h1>
    </div>
    <div class="col-xs-12 col-sm-12">
        {{ Form::open(array('action' => 'UserController@update', 'method' => 'post')) }}
        <div class="form-group">
            {{ Form::label('name', 'Nombre:', array('class' => 'awesome')) }}
            {{ Form::text('name' , Auth::user()->name, array('class' => 'form-control', 'required')) }}
        </div>
        @if($errors->signup->first('name') != null)
        <div class="alert alert-danger" role="alert">
            {{ $errors->signup->first('name')}}
        </div>
        @endif
        <div class="form-group">
            {{ Form::label('lastname', 'Apellido:', array('class' => 'awesome')) }}
            {{ Form::text('lastname' , Auth::user()->lastname, array('class' => 'form-control', 'required')) }}
        </div>
        @if($errors->signup->first('lastname') != null)
        <div class="alert alert-danger" role="alert">
            {{ $errors->signup->first('lastname')}}
        </div>
        @endif
        <div class="form-group">
            {{ Form::label('email', 'Email:', array('class' => 'awesome')) }}
            {{ Form::email('email', Auth::user()->email, array('class' => 'form-control', 'required')) }}
        </div>
        @if($errors->signup->first('email') != null)
        <div class="alert alert-danger" role="alert">
            {{ $errors->signup->first('email')}}
        </div>
        @endif
        <div class="form-group">
            {{ Form::label('username', 'Usuario:', array('class' => 'awesome')) }}
            {{ Form::text('username' , Auth::user()->username, array('class' => 'form-control', 'required')) }}
        </div>
        @if($errors->signup->first('username') != null)
        <div class="alert alert-danger" role="alert">
            {{ $errors->signup->first('username')}}
        </div>
        @endif
        <div class="form-group">
            {{ Form::label('password', 'Contraseña:', array('class' => 'awesome')) }}
            {{ Form::password('password', array('class' => 'form-control', 'required')) }}
        </div>
        @if($errors->signup->first('password') != null)
        <div class="alert alert-danger" role="alert">
            {{ $errors->signup->first('password')}}
        </div>
        @endif
        <div class="form-group">
            {{ Form::submit('Registrarse', array('class' => 'form-control btn btn-success', 'required')) }}
        </div>
        {{ Form::close() }}
    </div>
</div>

@stop