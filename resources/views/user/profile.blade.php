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
        <h3>Balance: {{Auth::user()->balance}}</h3>
    </div>
</div>



@stop