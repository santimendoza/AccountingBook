@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <div class="pull-right">
            <a href="/earnings/create" class="btn btn-success">Agregar ingreso</a>
        </div>
        <h1>Lista de ingresos</h1>
    </div>
    <div class="col-sm-12">
        @foreach($earnings as $earning)
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>ID</td>
                <td>Amount</td>
                <td>Description</td>
            </tr>
            <tr>
                <td>{{$earning->id}}</td>
                <td>{{$earning->amount}}</td>
                <td>{{$earning->description}}</td>
            </tr>
        </table> 
        @endforeach
    </div>
</div>

@stop