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
    <div class="col-sm-12">
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
            @foreach($categories[1] as $categoryinf)
            @foreach($categoryinf as $category)
            @if($categorysup->superior_cat == $categorysup->id)
            <div id="piechart{{$categoryinf->id}}">
                <h1>{{$categoryinf->slug}}</h1>
                <p>Presupuestado: {{$categoryinf->budget}}</p>
                <p>Gastado: <span class="text-color-red">{{$categoryinf->amount}}</span></p>
                <p class="text-color-green">Restante: {{$categoryinf->budget - $categoryinf->amount }}</p>
            </div>
            @endif
            @endforeach
            @endforeach

        </div>
        @endforeach
    </div>
</div>

@stop

