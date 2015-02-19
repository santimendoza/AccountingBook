@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>Dashboard
            <small>
                Estadísticas del mes
            </small>
        </h1>
        <p class="label label-primary">{{Auth::user()->balance}}</p>
        <span class="label label-success">+ {{$earnings['gastostotales']}}</span>
        <span class="label label-danger">- {{$expenses['gastostotales']}}</span>
    </div>
    <div class="col-xs-12 col-sm-12">
        <h3>Saldo: {{Auth::user()->balance}}</h3>
        <h3>Gastos en el mes: {{$expenses['gastostotales']}}</h3>
        <h3>Ingresos en el mes: {{$earnings['gastostotales']}}</h3>
        <h3>Ahorros:</h3>
        @foreach(Auth::user()->savings->all() as $savingsofuser)
        <h4> {{ $savingsofuser->title }}: {{$savingsofuser->amount}}</h4>
        @endforeach
        
    </div>
</div>



@stop