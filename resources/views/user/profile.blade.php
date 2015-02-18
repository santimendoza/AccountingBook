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
    </div>
    <div class="col-xs-12 col-sm-12">
        <h3>Saldo: {{Auth::user()->balance}}</h3>
        <h3>Gastos en el mes: {{$expenses['gastostotales']}}</h3>
        <h3>Ingresos en el mes: {{$earnings['gastostotales']}}</h3>
    </div>
</div>



@stop