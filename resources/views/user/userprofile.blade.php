@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>{{ $user->name }} {{ $user->lastname }}
            <small>
                {{ $user->username }}
            </small>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-12">
        <h3>Saldo: {{$user->balance}}</h3>
        <h3>Ahorros:</h3>
        @foreach($user->savings->all() as $savingsofuser)
        <h4> {{ $savingsofuser->title }}: {{$savingsofuser->amount}}</h4>
        @endforeach

    </div>
</div>

@stop