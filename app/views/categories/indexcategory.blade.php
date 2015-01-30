@extends('templates.master')
@section('header')
@parent
@stop
@section('content')

<div id="content" class="col-xs-12 col-sm-6 col-sm-offset-3">
    <div class="page-header">
        <h1>Lista de categorías</h1>
    </div>
    <div class="col-sm-12">
        {{dd($categories)}}
        @foreach($categories[0] as $categorysup)
        <div class="list-group">
            <a href="#" class="list-group-item active">
                {{$categorysup->slug}}
            </a>
            @foreach($categories[1] as $categoryinf)
            @if($categoryinf->superior_cat == $categorysup->id)
            <a href="#" class="list-group-item">{{$categoryinf->slug}}</a>
            @endif
            @endforeach
        </div>
        @endforeach
    </div>
</div>

@stop