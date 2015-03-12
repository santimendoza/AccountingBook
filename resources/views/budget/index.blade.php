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
            <div id="piechart{{$categorysup->id}}">
                <h1>{{$categorysup->slug}}</h1>
                <p>Presupuestado: {{$categorysup->budget}}</p>
                <p class="text-color-red">Gastado: {{$categorysup->amount}}</p>
                <p class="text-color-green">Restante: {{$categorysup->budget - $categorysup->amount }}</p>
            </div>
            @foreach($categories[1] as $categoryinf)
            @foreach($categoryinf as $category)
            @if($categorysup->superior_cat == $categorysup->id)
            <div id="piechart{{$categoryinf->id}}">
                <h1>{{$categoryinf->slug}}</h1>
                <p>Presupuestado: {{$categoryinf->budget}}</p>
                <p class="text-color-red">Gastado: {{$categoryinf->amount}}</p>
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

