@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <div class="pull-right">
            <a href="/categories/expenses/create" class="btn btn-success">Crear categoria</a>
        </div>
        <h1>Categorías de Gastos</h1>
    </div>
    <div class="col-sm-12">
        @foreach($categories[0] as $categorysup)
        <div class="col-sm-3">
            <div class="list-group">
                <a href="/categories/expenses/{{$categorysup->id}}" class="list-group-item active">
                    {{$categorysup->slug}}<span class="badge">{{count($categories[1][$categorysup->id])}}</span>
                </a>
                @foreach($categories[1] as $categoryinf)
                @foreach($categoryinf as $category)
                @if($category->superior_cat == $categorysup->id)
                <a href="/categories/expenses/{{$category->id}}" class="list-group-item">{{$category->slug}}</a>
                @endif
                @endforeach
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

@stop