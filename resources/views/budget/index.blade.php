@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <div class="pull-right">
            <a href="/budget/create" class="btn btn-success">Modificar presupuestos</a>
        </div>
        <h1>Presupuesto</h1>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2>Gastos</h2>
            @foreach($categories[0] as $categorysup)
            <div class="col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$categorysup->slug}}</h3>
                    </div>
                    <div class="panel-body">
                        <p><b>Presupuestado</b>: {{$categorysup->budget}}</p>
                        <p>
                            <b>Gastado</b>: <span class="@if($categorysup->amount > $categorysup->budget)text-color-red @endif">{{$categorysup->amount}}</span>
                        </p>
                        <p>
                            <b>Restante</b>: <span class="@if($categorysup->amount > $categorysup->budget)text-color-red @else text-color-green @endif">{{$categorysup->budget - $categorysup->amount }}</span>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2>Ahorros</h2>
            @foreach($savings as $saving)
            <div class="col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$saving->title}}</h3>
                    </div>
                    <div class="panel-body">
                        <p><b>Presupuestado</b>: {{$saving->budget}}</p>
                        <p><b>Ahorrado</b>: {{$saving->expenses}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@stop

